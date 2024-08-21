<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;





class PostController extends Controller implements HasMiddleware
{
    public static function middleware():array{

        return[
            new Middleware(['auth','verified'],except:['index','show']),
            //or  new Middleware('auth',only:['store']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $posts=Post::latest()->paginate(6);
        return view('posts.index',['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
         //validate
         $request->validate([
            'title'=>['required','max:192'],
            'body'=>['required'],
            'image'=>['nullable','file','max:120000','mimes:webp,png,jpg']

        ]);

        // store image
        $path=null;
           if ($request->hasFile('image')) {
            $path=Storage::disk('public')->put('posts_image', $request->image);   //(where we want to save it,the image esm el input) disk() is for defining the desk /the drive/ the place. disks r in config filesystem so we will get our image under storage app public
           }
       
        
        //create a post
       $post=Auth::user()->posts()->create([
            'title'=>$request->title,
            'body'=>$request->body,
            'image'=>$path
       ]); //posts is the function in the user model

    //    send email
          Mail::to(Auth::user())->send(new WelcomeMail(Auth::user(),$post));
       
       //redirect to dashboard
        return back()->with('success', 'Your post was created');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show',['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        Gate::authorize('modify',$post); //the function from postPolicy the user must br authorized that means owns the post.the user will be passed automatically by laravel
        return view('posts.edit',['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //authorizing the action its not yours or you are not logged in
        Gate::authorize('modify',$post);
          //validate
          $request->validate([
            'title'=>['required','max:192'],
            'body'=>['required'],
            'image'=>['nullable','file','max:3000','mimes:webp,png,jpg']

        ]);
         // store image
        $path=$post->image??null; //?? means if its deffault image ;maybe like if not
         if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
          $path=Storage::disk('public')->put('posts_image', $request->image);   //(where we want to save it,the image esm el input) disk() is for defining the desk /the drive/ the place. disks r in config filesystem so we will get our image under storage app public
         }
        //update a post
       $post->update([
        'title'=>$request->title,
        'body'=>$request->body,
        'image'=>$path
       ]);
       //redirect to dashboard
        return redirect()->route('dashboard')->with('success', 'Your post was updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //authorizing the action its not yours or you are not logged in
        Gate::authorize('modify',$post);
        // delete post image if exists
        if ($post->image) {

           Storage::disk('public')->delete($post->image);
        }
        //delete post
        $post->delete();
        //redirect to the dashboard
        return back()->with('delete','your post was deleted successfully');
    }
}
