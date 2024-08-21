<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
class DashboardController extends Controller
{
    public function show() {

        $posts= Auth::user()->posts()->latest()->paginate(6); //we call the post method as a property that means without()but when we will use the latest funnction we must add ()
        return view('users.dashboard',['posts'=> $posts]);
    }

    public function userPosts(User $user){
           $userPosts=$user->posts()->latest()->paginate(6);

        return view('users.posts',['posts'=>$userPosts, 'user'=>$user]);
    } 
}
