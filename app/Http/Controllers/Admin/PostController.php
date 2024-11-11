<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostFormRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
       $posts = Post::orderBy("created_at", "DESC")->paginate(5);
       return view('admin.posts.index', [
           "posts" => $posts,
       ]);
    }

    public function create()
    {
        return view('admin.posts.create', []);
    }

    public function store(PostFormRequest $request)
    {
        $post = Post::create($request->validated());

        return redirect(route("admin.posts.index"));

    }

    public function show(string $id)
    {

    }

    public function edit(string $id)
    {
        $post = Post::findOrFail($id);

        return view('admin.posts.create', [
            "post" => $post
        ]);
    }

    public function update(PostFormRequest $request, string $id)
    {
        $post = Post::findOrFail($id);

        $data = $request->validated();

        if($request->has("thumbnail")) {
            $thumbnail = str_replace("public/posts", "", $request->file("thumbnail")->store("public/posts"));
            $data["thumbnail"] = $thumbnail;
        }

        $post->update($data);

        return redirect(route("admin.posts.index"));

    }

    public function destroy(string $id)
    {
        Post::destroy($id);
        return redirect(route("admin.posts.index"));
    }
}
