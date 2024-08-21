@extends('layout')
@section('main')
<section class="bg-white dark:bg-gray-900">
<a href="{{ route('dashboard') }}">&larr;Go back to your dashboard</a>
  <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
      <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Update your post</h2>

        <!--session messages-->
        @if(session('success'))
        <div>
           <p class="text-green-500"> {{ session('success') }} </p>
      
        </div>
        
        @endif

        
        <form action="{{ route('posts.update',$post) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')


         <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
         <!--post title-->
         <div class="sm:col-span-2">
                  <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Post Title</label>
                  <input type="text" name="title" id="title" value="{{$post->title}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                  @error('title')
                  <p class="text-red-500 text-sm">{{$message}}</p>
                  @enderror
        </div>


                <!--post body-->
        <div class="sm:col-span-2">
                  <label for="body" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Post content</label>
                  <textarea name="body" id="body" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">{{$post->body}}</textarea>
                  @error('body')
                  <p class="text-red-500 text-sm">{{$message}}</p>
                  @enderror
        </div>


         <!--photo-->
            @if($post->image)
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Post photo</label>
                <img src="{{asset('storage/'.$post->image)}}"/>
            </div>
            @endif
            <!--new photo-->
            <div class="sm:col-span-2">
             <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">change photo</label>
             <input type="file" name="image" id="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"/>
             @error('image')
              <p class="text-red-500 text-sm">{{$message}}</p>
             @enderror
         </div>

         
        
       <!--submit button-->
       <button type="submit" class="flex space-x-2 mt-3 inline-flex items-center px-2 py-2 text-sm font-medium text-center text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 max-w-fit">
       Update
       </button>


        </form>
     </div>
</section>
@endsection