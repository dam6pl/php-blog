<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return \view('admin.users', ['users' => User::all()]);
    }

    public function delete($id)
    {
        User::destroy($id);

        return \redirect('admin/users');
    }
}
