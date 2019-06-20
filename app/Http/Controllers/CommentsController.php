<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index()
    {
        return \view('admin.comments', ['comments' => Comment::all()]);
    }

    public function delete($id)
    {
        Comment::destroy($id);

        return \redirect('admin/comments');
    }
}
