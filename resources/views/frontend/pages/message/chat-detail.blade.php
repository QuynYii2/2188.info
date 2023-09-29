<div class="row" id="chat-detail">
    <div class="col-sm-4 col-lg-3">
        <div class="card">
            <div class="card-header"><b>Connected User</b></div>
            <div class="card-body" id="user_list">

            </div>
        </div>
    </div>
    <div class="col-sm-4 col-lg-6">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col col-md-6" id="chat_header"><b>Chat Area</b></div>
                    <div class="col col-md-6" id="close_chat_area"></div>
                </div>
            </div>
            <div class="card-body" id="chat_area">

            </div>
        </div>
    </div>
    <div class="col-sm-4 col-lg-3">
        <div class="card" style="height:255px; overflow-y: scroll;">
            <div class="card-header">
                <input type="text" class="form-control" placeholder="Search User..." autocomplete="off"
                       id="search_people" onkeyup="search_user('{{ Auth::id() }}', this.value);"/>
            </div>
            <div class="card-body">
                <div id="search_people_area" class="mt-3"></div>
            </div>
        </div>
        <br/>
        <div class="card" style="height:255px; overflow-y: scroll;">
            <div class="card-header"><b>Notification</b></div>
            <div class="card-body">
                <ul class="list-group" id="notification_area">

                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    var userToken = `{{ auth()->user()->token }}`;
    var userID = `{{ auth()->user()->id }}`;
    var urlImage = `{{ asset('images/chat/') }}`;
    var urlImageUser = `{{ asset('storage/avatar/') }}`;
</script>
<script src="{{ asset('js/frontend/pages/messege/chat-detail.js') }}"></script>