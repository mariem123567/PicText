<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('simple-search');

        // Search for the user by their username
        $user = User::where('name', $searchTerm)->first();

        // If user exists, redirect to their posts
        if ($user) {
            return redirect()->route('posts.user', $user);
        }

        // If user does not exist, return back with an error message
        return redirect()->back()->with('error', 'User not found.');
    }
} 

