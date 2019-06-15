<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function single($id)
    {
        return view(
            'blog.post',
            [
                'post'     => Post::where('id', $id)->first(),
                'comments' => Comment::where('post_id', $id)->get()
            ]
        );
    }

    public function insertComment(Request $request, $id)
    {
        Comment::create([
            'post_id' => $id,
            'author'  => $request->post('name'),
            'content' => $request->post('message')
        ]);

        return $this->single($id);
    }

    public function delete($id)
    {
        Post::destroy($id);

        return \redirect('admin/posts');
    }

    public function edit($id)
    {
        return \view('admin.post', ['post' => Post::where('id', $id)->first()]);
    }

    public function update(Request $request, $id)
    {
        if ((int)$id === 0) {
            $post = Post::create([
                'author_id' => \auth()->user()->id,
                'title'     => $request->post('title'),
                'content'   => $request->post('content'),
                'image_url' => $request->post('image'),
            ]);

            $id = $post->id;
        } else {
            $post = Post::find($id);
            $post->title = $request->post('title');
            $post->content = $request->post('content');
            $post->image_url = $request->post('image');
            $post->save();
        }

        return \redirect("admin/posts/{$id}");
    }
}
