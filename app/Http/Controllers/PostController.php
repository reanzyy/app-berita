<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        $posts = Post::orderBy('posts.id', 'desc')
            ->get();

        return view('pages.posts.index', compact('posts', 'categories'));
    }

    public function myposts()
    {
        $myposts = DB::table('posts')
            ->select('posts.*', 'users.name')
            ->join('users', 'posts.author', '=', 'users.id')
            ->where('author', Auth::user()->id)
            ->orderBy('posts.id', 'desc')
            ->get();

        return view('pages.posts.myposts', compact('myposts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = DB::table('categories')
            ->get();

        return view('pages.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|max:255',
            'news_content' => 'required|min:10',
            'category_id' => 'required',
            'image' => 'image',
        ]);

        $id = Auth::user()->id;
        $posts = new Post;

        if ($request->hasFile('image')) {
            $image = time() . '.' . $request->image->extension();
            $request->image->move(public_path("images"), $image);
            $posts->image = $image;
        }

        $posts->author = $id;
        $posts->title = $request->title;
        $posts->news_content = $request->news_content;
        $posts->category_id = $request->category_id;
        $posts->save();
        // $posts->image = $request->image;

        return redirect('/my-posts');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::where('posts.id', $id)
            ->with('writer')
            ->get();

        $comments = DB::table('comments')
            ->select('comments.*', 'users.name')
            ->join('posts', 'comments.post_id', '=', 'posts.id')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->where('comments.post_id', $id)
            ->orderBy('comments.id', 'asc')
            ->get();

        return view('pages.posts.show', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id)
            ->first();

        $categories = Category::all();

        return view('pages.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'news_content' => 'required|min:10',
            'category_id' => 'required',
            'image' => 'image',
        ]);

        $posts = Post::find($id);

        if ($request->hasFile('image')) {
            $image = time() . '.' . $request->image->extension();
            $request->image->move(public_path("images"), $image);
            $posts->image = $image;
        }

        $posts->title = $request->title;
        $posts->news_content = $request->news_content;
        $posts->category_id = $request->category_id;
        $posts->save();

        return redirect('/my-posts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id)->first();
        $post->delete();

        return redirect('/my-posts');
    }
}