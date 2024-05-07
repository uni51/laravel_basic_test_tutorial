<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostManageController extends Controller
{
    public function index()
    {
        $posts = auth()->user()->posts;

        return view('members.posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'max:10000'],
            'status' => ['required', 'integer', 'in:0,1'],
        ]);

        $post = auth()->user()->posts()->create($data);

        return to_route('posts.edit', $post)
            ->with('status', 'ブログを登録しました');
    }

    public function edit(Post $post)
    {
        if (auth()->user()->isNot($post->user)) {
            abort(403);
        }

        $data = old() ?: $post;

        return view('members.posts.edit', compact('post', 'data'));
    }
}
