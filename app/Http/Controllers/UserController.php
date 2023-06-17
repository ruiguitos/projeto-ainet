<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserPost;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Throwable;

class UserController extends Controller
{
    public function showClientes()
    {
        $users = User::where('user_type', 'C')->get();

        return view('clients.index', compact('users'));

    }

}
