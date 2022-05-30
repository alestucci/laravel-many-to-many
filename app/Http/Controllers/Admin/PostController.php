<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$posts = Post::paginate(30);

        $posts = Post::where('id', '>', 0);

        if ($request->s) {
            $posts->where('title', 'LIKE', "%$request->s%");
        }

        if ($request->category) {
            $posts->where('category_id', $request->category);
        }

        if ($request->author) {
            $posts->where('user_id', $request->author);
        }

        $posts = $posts->paginate(20);

        $categories = Category::all();
        $users = User::all();


        return view('admin.posts.index', [
            'posts' => $posts,
            'categories' => $categories,
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = \App\Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'user_is' => 'required|exists:App\User,id',
            'title' => 'required|max:100',
            'slug' => 'required|unique:posts|max:100',
            'category_id' => 'required|exists:App\Category,id',
            'content' => 'required'
        ]);

        $formData = $request->all() + [
            'user_id' => Auth::id(),
        ];

        $newPost = Post::create($formData);

        return redirect()->route('admin.posts.show', $newPost->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (Auth::id() !== $post->user_id) abort(403);
        $categories = \App\Category::all();
        return view('admin.posts.edit', [
            'post' => $post,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if (Auth::id() !== $post->user_id) abort(403);

        $request->validate([
            'title' => 'required|max:100',
            'slug' => [
                'required',
                Rule::unique('posts')->ignore($post),
                'max:100',
            ],
            'category_id' => 'required|exists:App\Category,id',
            'content' => 'required'
        ]);

        $post->update($request->all());

        return redirect()->route('admin.posts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back();
    }

    public function myindex()
    {
        $posts = Post::where('user_id', Auth::id())->paginate(30);

        return view('admin.posts.index', compact('posts'));
    }
}
