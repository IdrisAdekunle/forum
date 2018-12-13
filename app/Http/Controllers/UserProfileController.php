<?php

namespace App\Http\Controllers;


use App\Thread;
use App\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index(User $user)
    {
        $threads=Thread::where('user_id',$user->id)->latest()->get();



        return view('profile.index',compact('threads','user'));

    }
}
