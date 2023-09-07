<?php

namespace App\Http\Controllers;

use App\Enums\AccountStatus;
use App\Enums\ChatRequestStatus;
use App\Enums\MessageStatus;
use App\Models\Chat;
use App\Models\ChatRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class SocketController extends Controller implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    //
    function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);

        $querystring = $conn->httpRequest->getUri()->getQuery();

        parse_str($querystring, $queryarray);

        if (isset($queryarray['token'])) {
            User::where('token', $queryarray['token'])->update(['connection_id' => $conn->resourceId, 'state' => AccountStatus::ONLINE]);

            $user_id = User::select('id')->where('token', $queryarray['token'])->get();

            $data['id'] = $user_id[0]->id;

            $data['state'] = AccountStatus::ONLINE;

            foreach ($this->clients as $client) {
                if ($client->resourceId != $conn->resourceId) {
                    $client->send(json_encode($data));
                }
            }

        }
    }

    function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);

        $querystring = $conn->httpRequest->getUri()->getQuery();

        parse_str($querystring, $queryarray);

        if (isset($queryarray['token'])) {
            User::where('token', $queryarray['token'])->update(['connection_id' => 0, 'state' => AccountStatus::OFFLINE]);

            $user_id = User::select('id', 'updated_at')->where('token', $queryarray['token'])->get();

            $data['id'] = $user_id[0]->id;

            $data['state'] = AccountStatus::OFFLINE;

            $updated_at = $user_id[0]->updated_at;

            if (date('Y-m-d') == date('Y-m-d', strtotime($updated_at))) //Same Date, so display only Time
            {
                $data['last_seen'] = 'Last Seen at ' . date('H:i');
            } else {
                $data['last_seen'] = 'Last Seen at ' . date('d/m/Y H:i');
            }

            foreach ($this->clients as $client) {
                if ($client->resourceId != $conn->resourceId) {
                    $client->send(json_encode($data));
                }
            }
        }
    }

    function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()} \n";

        $conn->close();
    }

    function onMessage(ConnectionInterface $conn, $msg)
    {
        if (preg_match('~[^\x20-\x7E\t\r\n]~', $msg) > 0) {
            //receiver image in binary string message

            $image_name = time() . '.jpg';

            file_put_contents(public_path('images/chat/') . $image_name, $msg);

            $send_data['image'] = $image_name;

            foreach ($this->clients as $client) {
                if ($client->resourceId == $conn->resourceId) {
                    $client->send(json_encode($send_data));
                }
            }
        }


        $data = json_decode($msg);

        if (isset($data->type)) {
            if ($data->type == 'request_load_unconnected_user') {
                $user_data = User::select('id', 'name', 'state', 'image')
                    ->where('id', '!=', $data->from_user_id)
                    ->orderBy('name', 'ASC')
                    ->get();

                $sub_data = array();

                foreach ($user_data as $row) {
                    $sub_data[] = array(
                        'name' => $row['name'],
                        'id' => $row['id'],
                        'state' => $row['state'],
                        'image' => $row['image']
                    );
                }

                $sender_connection_id = User::select('connection_id')->where('id', $data->from_user_id)->get();

                $send_data['data'] = $sub_data;

                $send_data['response_load_unconnected_user'] = true;

                foreach ($this->clients as $client) {
                    if ($client->resourceId == $sender_connection_id[0]->connection_id) {
                        $client->send(json_encode($send_data));
                    }
                }
            }

            if ($data->type == 'request_search_user') {
                $user_data = User::select('id', 'name', 'state', 'image')
                    ->where('id', '!=', $data->from_user_id)
                    ->where('name', 'like', '%' . $data->search_query . '%')
                    ->orderBy('name', 'ASC')
                    ->get();

                $sub_data = array();

                foreach ($user_data as $row) {

                    $chat_request = ChatRequest::select('id')
                        ->where(function ($query) use ($data, $row) {
                            $query->where('from_user_id', $data->from_user_id)->where('to_user_id', $row->id);
                        })
                        ->orWhere(function ($query) use ($data, $row) {
                            $query->where('from_user_id', $row->id)->where('to_user_id', $data->from_user_id);
                        })->get();

                    /*
                    SELECT id FROM chat_request
                    WHERE (from_user_id = $data->from_user_id AND to_user_id = $row->id)
                    OR (from_user_id = $row->id AND to_user_id = $data->from_user_id)
                    */

                    if ($chat_request->count() == 0) {
                        $sub_data[] = array(
                            'name' => $row['name'],
                            'id' => $row['id'],
                            'status' => $row['status'],
                            'image' => $row['image']
                        );
                    }


                }

                $sender_connection_id = User::select('connection_id')->where('id', $data->from_user_id)->get();

                $send_data['data'] = $sub_data;

                $send_data['response_search_user'] = true;

                foreach ($this->clients as $client) {
                    if ($client->resourceId == $sender_connection_id[0]->connection_id) {
                        $client->send(json_encode($send_data));
                    }
                }
            }

            if ($data->type == 'request_chat_user') {
                $chat_request = new ChatRequest;

                $chat_request->from_user_id = $data->from_user_id;

                $chat_request->to_user_id = $data->to_user_id;

                $chat_request->status = ChatRequestStatus::APPROVED;

                $chat_request->save();

                $sender_connection_id = User::select('connection_id')->where('id', $data->from_user_id)->get();

                $receiver_connection_id = User::select('connection_id')->where('id', $data->to_user_id)->get();

                foreach ($this->clients as $client) {
                    if ($client->resourceId == $sender_connection_id[0]->connection_id) {
                        $send_data['response_from_user_chat_request'] = true;

                        $client->send(json_encode($send_data));
                    }

                    if ($client->resourceId == $receiver_connection_id[0]->connection_id) {
                        $send_data['user_id'] = $data->to_user_id;

                        $send_data['response_to_user_chat_request'] = true;

                        $client->send(json_encode($send_data));
                    }
                }
            }

            if ($data->type == 'request_load_unread_notification') {
                $notification_data = ChatRequest::select('id', 'from_user_id', 'to_user_id', 'status')
                    ->where('status', '!=', ChatRequestStatus::APPROVED)
                    ->where(function ($query) use ($data) {
                        $query->where('from_user_id', $data->user_id)->orWhere('to_user_id', $data->user_id);
                    })->orderBy('id', 'desc')->get();

                /*
                SELECT id, from_user_id, to_user_id, status FROM chat_requests
                WHERE status != 'Approve'
                AND (from_user_id = $data->user_id OR to_user_id = $data->user_id)
                ORDER BY id ASC
                */

                $sub_data = array();

                foreach ($notification_data as $row) {
                    $user_id = '';

                    $notification_type = '';

                    if ($row->from_user_id == $data->user_id) {
                        $user_id = $row->to_user_id;

                        $notification_type = 'Send Request';
                    } else {
                        $user_id = $row->from_user_id;

                        $notification_type = 'Receive Request';
                    }

                    $user_data = User::select('name', 'image')->where('id', $user_id)->first();

                    $sub_data[] = array(
                        'id' => $row->id,
                        'from_user_id' => $row->from_user_id,
                        'to_user_id' => $row->to_user_id,
                        'name' => $user_data->name,
                        'notification_type' => $notification_type,
                        'status' => $row->status,
                        'image' => $user_data->image
                    );
                }

                $sender_connection_id = User::select('connection_id')->where('id', $data->user_id)->get();

                foreach ($this->clients as $client) {
                    if ($client->resourceId == $sender_connection_id[0]->connection_id) {
                        $send_data['response_load_notification'] = true;

                        $send_data['data'] = $sub_data;

                        $client->send(json_encode($send_data));
                    }
                }
            }

            if ($data->type == 'request_process_chat_request') {
                ChatRequest::where('id', $data->chat_request_id)->update(['status' => $data->action]);

                $sender_connection_id = User::select('connection_id')->where('id', $data->from_user_id)->get();

                $receiver_connection_id = User::select('connection_id')->where('id', $data->to_user_id)->get();

                foreach ($this->clients as $client) {
                    $send_data['response_process_chat_request'] = true;

                    if ($client->resourceId == $sender_connection_id[0]->connection_id) {
                        $send_data['user_id'] = $data->from_user_id;
                    }

                    if ($client->resourceId == $receiver_connection_id[0]->connection_id) {
                        $send_data['user_id'] = $data->to_user_id;
                    }

                    $client->send(json_encode($send_data));
                }
            }

            if ($data->type == 'request_connected_chat_user') {
                $condition_1 = ['from_user_id' => $data->from_user_id, 'to_user_id' => $data->from_user_id];

                $user_id_data = ChatRequest::select('from_user_id', 'to_user_id')
                    ->orWhere($condition_1)
                    ->where('status', ChatRequestStatus::APPROVED)
                    ->get();

                $sub_data = array();

                foreach ($user_id_data as $user_id_row) {
                    $user_id = '';

                    if ($user_id_row->from_user_id != $data->from_user_id) {
                        $user_id = $user_id_row->from_user_id;
                    } else {
                        $user_id = $user_id_row->to_user_id;
                    }

                    $user_data = User::select('id', 'name', 'image', 'state', 'updated_at')->where('id', $user_id)->first();

                    if (date('Y-m-d') == date('Y-m-d', strtotime($user_data->updated_at))) {
                        $last_seen = 'Last Seen At ' . date('H:i', strtotime(Carbon::parse($user_data->updated_at)->addHours(7)));
                    } else {
                        $last_seen = 'Last Seen At ' . date('d/m/Y H:i', strtotime(Carbon::parse($user_data->updated_at)->addHours(7)));
                    }

                    $sub_data[] = array(
                        'id' => $user_data->id,
                        'name' => $user_data->name,
                        'image' => $user_data->image,
                        'state' => $user_data->state,
                        'last_seen' => $last_seen
                    );


                }

                $sender_connection_id = User::select('connection_id')->where('id', $data->from_user_id)->get();

                foreach ($this->clients as $client) {
                    if ($client->resourceId == $sender_connection_id[0]->connection_id) {
                        $send_data['response_connected_chat_user'] = true;

                        $send_data['data'] = $sub_data;

                        $client->send(json_encode($send_data));
                    }
                }
            }

            if ($data->type == 'request_send_message') {
                //save chat message in mysql

                $chat = new Chat;

                $chat->from_user_id = $data->from_user_id;

                $chat->to_user_id = $data->to_user_id;

                $chat->chat_message = $data->message;

                $chat->message_status = MessageStatus::UNSEEN;

                $chat->save();

                $chat_message_id = $chat->id;

                $receiver_connection_id = User::select('connection_id')->where('id', $data->to_user_id)->get();

                $sender_connection_id = User::select('connection_id')->where('id', $data->from_user_id)->get();

                foreach ($this->clients as $client) {
                    if ($client->resourceId == $receiver_connection_id[0]->connection_id || $client->resourceId == $sender_connection_id[0]->connection_id) {
                        $send_data['chat_message_id'] = $chat_message_id;

                        $send_data['message'] = $data->message;

                        $send_data['from_user_id'] = $data->from_user_id;

                        $send_data['to_user_id'] = $data->to_user_id;

                        if ($client->resourceId == $receiver_connection_id[0]->connection_id) {
                            Chat::where('id', $chat_message_id)->update(['message_status' => MessageStatus::SEEN]);

                            $send_data['message_status'] = MessageStatus::SEEN;
                        } else {
                            $send_data['message_status'] = MessageStatus::UNSEEN;
                        }

                        $client->send(json_encode($send_data));
                    }
                }
            }

            if ($data->type == 'request_chat_history') {
                $chat_data = Chat::select('id', 'from_user_id', 'to_user_id', 'chat_message', 'message_status')
                    ->where(function ($query) use ($data) {
                        $query->where('from_user_id', $data->from_user_id)->where('to_user_id', $data->to_user_id);
                    })
                    ->orWhere(function ($query) use ($data) {
                        $query->where('from_user_id', $data->to_user_id)->where('to_user_id', $data->from_user_id);
                    })->orderBy('id', 'ASC')->get();
                /*
                SELECT id, from_user_id, to_user_id, chat_message, message status
                FROM chats
                WHERE (from_user_id = $data->from_user_id AND to_user_id = $data->to_user_id)
                OR (from_user_id = $data->to_user_id AND to_user_id = $data->from_user_id)
                ORDER BY id ASC
                */

                $send_data['chat_history'] = $chat_data;

                $receiver_connection_id = User::select('connection_id')->where('id', $data->from_user_id)->get();

                foreach ($this->clients as $client) {
                    if ($client->resourceId == $receiver_connection_id[0]->connection_id) {
                        $client->send(json_encode($send_data));
                    }
                }

            }

            if ($data->type == 'update_chat_status') {
                //update chat status

                Chat::where('id', $data->chat_message_id)->update(['message_status' => $data->chat_message_status]);

                $sender_connection_id = User::select('connection_id')->where('id', $data->from_user_id)->get();

                foreach ($this->clients as $client) {
                    if ($client->resourceId == $sender_connection_id[0]->connection_id) {
                        $send_data['update_message_status'] = $data->chat_message_status;

                        $send_data['chat_message_id'] = $data->chat_message_id;

                        $client->send(json_encode($send_data));
                    }
                }
            }

            if ($data->type == 'check_unread_message') {
                $chat_data = Chat::select('id', 'from_user_id', 'to_user_id')->where('message_status', '!=', MessageStatus::SEEN)->where('from_user_id', $data->to_user_id)->get();

                /*
                SELECT id, from_user_id, to_user_id FROM chats
                WHERE message_status != 'Read'
                AND from_user_id = $data->to_user_id
                */

                $sender_connection_id = User::select('connection_id')->where('id', $data->from_user_id)->get(); //send number of unread message

                $receiver_connection_id = User::select('connection_id')->where('id', $data->to_user_id)->get(); //send message read status

                foreach ($chat_data as $row) {
                    Chat::where('id', $row->id)->update(['message_status' => MessageStatus::SEEN]);

                    foreach ($this->clients as $client) {
                        if ($client->resourceId == $sender_connection_id[0]->connection_id) {
                            $send_data['count_unread_message'] = 1;

                            $send_data['chat_message_id'] = $row->id;

                            $send_data['from_user_id'] = $row->from_user_id;
                        }

                        if ($client->resourceId == $receiver_connection_id[0]->connection_id) {
                            $send_data['update_message_status'] = MessageStatus::SEEN;

                            $send_data['chat_message_id'] = $row->id;

                            $send_data['unread_msg'] = 1;

                            $send_data['from_user_id'] = $row->from_user_id;
                        }

                        $client->send(json_encode($send_data));
                    }
                }
            }
        }
    }
}
