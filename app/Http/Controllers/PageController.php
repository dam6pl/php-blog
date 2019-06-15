<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return \view('blog.index', ['posts' => Post::all()->reverse()]);
    }

    public function adminPosts()
    {
        return \view('admin.posts', ['posts' => Post::all()]);
    }

    public function contactForm(Request $request)
    {
        $messageInfo = 'Dane wiadomości: ' . PHP_EOL
            . 'Data: ' . date('d.m.y, H:m:s') . PHP_EOL
            . "Imię: {$request->post('name')}" . PHP_EOL
            . "Email: {$request->post('email')}" . PHP_EOL
            . "Numer telefonu: {$request->post('phone')}" . PHP_EOL
            . "Wiadomość: {$request->post('message')}" . PHP_EOL . PHP_EOL;

        return @file_put_contents(
            base_path() . '/mails/' . $request->post('email') . '.txt',
            $messageInfo,
            FILE_APPEND
        ) ? 'true' : 'false';
    }
}
