<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comments_content' => 'required',
        ]);

        // Memanggil postingan berdasarkan ID

        $user_id = Auth::user()->id;

        $comment = new Comment;
        $comment->post_id = $request->post_id;
        $comment->user_id = $user_id;
        $comment->comments_content = $request->comments_content;
        $comment->save();

        return back();
    }

    public function edit(string $id)
    {
        $comment = Comment::find($id);

        return view('pages.comments.edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'comments_content' => 'required',
        ]);

        // Memanggil postingan berdasarkan ID

        $comment = Comment::find($id);

        $comment->comments_content = $request->comments_content;
        $comment->save();

        return redirect(route('posts.detail', $comment->post_id));
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();

        return redirect(route('posts.detail', $comment->post_id));
    }
}
