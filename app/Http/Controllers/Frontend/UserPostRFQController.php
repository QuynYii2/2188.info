<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\CategoryStatus;
use App\Enums\PostRFQStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PostRFQController;
use App\Models\Category;
use App\Models\PostRFQ;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPostRFQController extends Controller
{
    public function index()
    {
        $posts = PostRFQ::where('status', '!=', PostRFQStatus::DELETED)
            ->where('create_by', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->get();
        return view('frontend.pages.post-rfq.list', compact('posts'));
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

        $arrayCode1 = explode(',', $code_1);
        $arrayCode2 = explode(',', $code_2);
        $arrayCode3 = explode(',', $code_3);

        $category_1 = Category::whereIn('id', $arrayCode1)->get();
        $category_2 = Category::whereIn('id', $arrayCode2)->get();
        $category_3 = Category::whereIn('id', $arrayCode3)->get();

        $user = User::find($post->create_by);

        $categories_no_parent = Category::where([
            ['status', CategoryStatus::ACTIVE],
            ['parent_id', null]
        ])->get();
        return view('frontend.pages.post-rfq.detail', compact('post', 'categories_no_parent', 'category_1', 'category_2', 'category_3', 'user'));
    }

    public function update($id, Request $request)
    {
        try {
            $post = PostRFQ::find($id);
            if (!$post || $post->status == PostRFQStatus::DELETED) {
                return back();
            }

            $post = (new PostRFQController())->save($request, $post);

            $success = $post->save();
            alert()->success('Success', 'Post update successfully.');
            return redirect(route('user.post.rfq.show'));
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
            return redirect(route('user.post.rfq.show'));
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, please try again!');
            return back();
        }
    }
}
