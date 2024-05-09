<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostManageController extends Controller
{
    public function index()
    {
//        $posts = auth()->user()->posts;

        $validator = \Validator::make(request()->all(), [
            'kword' => ['nullable', 'string', 'max:100'],
        ]);

        abort_if($validator->fails(), 422);

        $data = $validator->validated();

        $query = Post::query()
            ->where('user_id', auth()->user()->id);

        // キーワード検索
        if ($val = data_get($data, 'kword')) {
            $query->where(function ($query) use ($val) {
                $query->where('title', 'LIKE', '%'.$val.'%')
                    ->orWhere('body', 'LIKE', '%'.$val.'%');
            });
        }

        $posts = $query->get();

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

    public function update(Post $post, Request $request)
    {
        if (auth()->user()->isNot($post->user)) {
            abort(403);
        }

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'max:10000'],
            'status' => ['required', 'integer', 'in:0,1'],
        ]);

        $post->update($data);

        return to_route('posts.edit', $post)
            ->with('status', 'ブログを更新しました');
    }

    public function destroy(Post $post)
    {
        if (auth()->user()->isNot($post->user)) {
            abort(403);
        }

        $post->delete();

        return to_route('posts.index')
            ->with('status', 'ブログを削除しました');
    }
}
