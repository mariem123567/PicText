@extends('layout')
@section('main')
<div class="grid grid-cols-2 gap-6">
<div class="card">
    <!--title-->
    <h2 class="font-bold text-xl">{{$post->title}}</h2>

    <!--author and date-->
    
    <div class="text-xs font-light mb-4">
        <span>Posted {{$post->created_at->diffForHumans()}} by </span>
        <a href="{{route('posts.user', $post->user)}}" class="text-blue-500 font-medium">{{$post->user->name}}</a><!--we did this due to the user function in post model-->
    </div>
    <!--body-->
    <div class="text-sm">
    <span>{{$post->body}}</span>
    <!--<a href="{{route('posts.show',$post)}}" class="text-blue-500 ml-2">Read more &rarr;</a>-->
    </div>
    <!--photo-->
    <div>
        <img src="{{asset('storage/'.$post->image)}}"/>
    </div>
</div>


</div>

@endsection