@extends('layout')
@section('main')

<h1 class="text-4xl font-extrabold mt-8 mb-8 text-gray-900 dark:text-white">{{$user->name}} has {{ $posts->total() }} posts</h1><!--if we want the number of the posts in every one page we should use count() instead-->

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @foreach($posts as $post)
    <div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="#">
            <!--photo-->
            <img class="rounded-t-lg" src="{{asset('storage/'.$post->image)}}" alt="" />
        </a>
        <div class="p-5">
            <a href="#">
                <!--title-->
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$post->title}}</h5>
            </a>
            <!--author and date-->
            <div class="text-xs font-light mb-4">
                <span>Posted {{$post->created_at->diffForHumans()}} by </span>
                <a href="{{route('posts.user', $post->user)}}" class="text-blue-500 font-medium">{{$post->user->name}}</a>
            </div> 
            <!--body-->
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ Str::words($post->body,20) }}</p>
            <a href="{{route('posts.show',$post)}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"> <!--bg-blue-700 rounded-lg hover:bg-blue-800-->
                Read more
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
        </div>
    </div>
    @endforeach
</div>

<div>
    {{ $posts->links() }}
</div>



@endsection