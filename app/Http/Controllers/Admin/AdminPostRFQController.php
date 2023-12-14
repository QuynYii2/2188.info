<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PostRFQStatus;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PostRFQ;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPostRFQController extends Controller
{
    public function index()
    {
        $posts = PostRFQ::where('status', '!=', PostRFQStatus::DELETED)
            ->orderBy('id', 'desc')
            ->get();
        return view('admin.post-rfq.list', compact('posts'));
    }

    public function detail($id)
    {
        $post = PostRFQ::find($id);
        if (!$post || $post->status == PostRFQStatus::DELETED) {
            return back();
        }
        $code_1 = $post->code_1;
        $code_2 = $post->code_2;
        $code_3 = $post->code_3;

        $category_1 = Category::whereIn('id', [$code_1])->get();
        $category_2 = Category::whereIn('id', [$code_2])->get();
        $category_3 = Category::whereIn('id', [$code_3])->get();

        $user = User::find($post->create_by);

        return view('admin.post-rfq.detail', compact('post', 'category_1', 'category_2', 'category_3', 'user'));
    }

    public function update($id, Request $request)
    {
        try {
            $post = PostRFQ::find($id);
            if (!$post || $post->status == PostRFQStatus::DELETED) {
                return back();
            }
            $status = $request->input('status');
            $post->status = $status;
            $post->save();
            alert()->success('Success', 'Post update successfully.');
            return redirect(route('admin.post.rfq.show'));
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, please try again!');
            return back();
        }
    }

    public function delete($id)
    {
        try {
            $post = PostRFQ::find($id);
            if (!$post || $post->status == PostRFQStatus::DELETED) {
                return back();
            }
            $post->status = PostRFQStatus::DELETED;
            $post->save();
            alert()->success('Success', 'Post delete successfully.');
            return redirect(route('admin.post.rfq.show'));
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, please try again!');
            return back();
        }
    }
}
