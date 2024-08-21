<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    //DELETE OR UPDATE OR VIEW IT'S MODIFY THAT MEANS ALL
   public function modify(User $user,Post $post):bool{
     
    return $user->id=== $post->user_id;
   }
}
