@extends('layout')
@section('main')
<!--<iframe title="train" width="1000" height="1000" src="https://app.powerbi.com/view?r=eyJrIjoiN2E3YTM1Y2YtOTNjOC00YWZiLTgxNGUtOGE3MjgzYjA5NzYyIiwidCI6ImRiZDY2NjRkLTRlYjktNDZlYi05OWQ4LTVjNDNiYTE1M2M2MSIsImMiOjl9" frameborder="0" allowFullScreen="true"></iframe>-->
    <!--create post form-->
    <h1 class="text-xl font-extrabold mt-3 text-gray-900 dark:text-white">welcome {{auth()->user()->name}}, you have {{$posts->total()}} posts</h1>
<section class="bg-white dark:bg-gray-900">
  <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
      <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new post</h2>
      <!--session messages-->
      @if(session('success'))
        <div>
           <p class="text-green-500"> {{ session('success') }} </p>
      
        </div>
        @elseif(session('delete'))
        <div>
           <p class="text-green-500"> {{ session('delete') }} </p>
      
        </div>
        @endif
      <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
      @csrf
          <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
            <!--post title-->
              <div class="sm:col-span-2">
                  <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Post Title</label>
                  <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Title">
                  @error('title')
                  <p class="text-red-500 text-sm">{{$message}}</p>
                  @enderror
              </div>

               <!--post body-->
              <div class="sm:col-span-2">
                  <label for="body" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Post content</label>
                  <textarea name="body" id="body" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Content"></textarea>
                  @error('body')
                  <p class="text-red-500 text-sm">{{$message}}</p>
                  @enderror
              </div>
            <!--post image-->
              <div class="sm:col-span-2">
              <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Add Photo</label>
              <input type="file" name="image" id="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
              @error('image')
              <p class="text-red-500 text-sm">{{$message}}</p>
              @enderror
              </div>

          </div>
           <!--submit button-->
          <button type="submit" class=" flex space-x-2 mt-3 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
              Add
          </button>
      </form>
  </div>
</section>



   <!-- User's posts -->
   <h1 class="text-4xl font-extrabold text-center mt-8 mb-8 text-gray-900 dark:text-white">Your Latest Posts</h1>

<!-- Post Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @foreach($posts as $post)
        <div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <!-- Photo -->
                <img class="rounded-t-lg" src="{{ asset('storage/'.$post->image) }}" alt="" />
            </a>
            <div class="p-5">
                <a href="#">
                    <!-- Title -->
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $post->title }}</h5>
                </a>
                <!-- Author and Date -->
                <div class="text-xs font-light mb-4">
                    <span>Posted {{ $post->created_at->diffForHumans() }} by </span>
                    <a href="{{ route('posts.user', $post->user) }}" class="text-blue-500 font-medium">{{ $post->user->name }}</a>
                </div>
                <!-- Body -->
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ Str::words($post->body, 20) }}</p>
                <a href="{{ route('posts.show', $post) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Read more
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>

                <!-- Update and Delete Buttons -->
                <div class="flex space-x-2 mt-3">
                    <!-- Update a Post -->
                    <a href="{{ route('posts.edit', $post) }}" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Update
                    </a>

                    <!-- Delete a Post -->
                    <button data-modal-target="deleteModal-{{ $post->id }}" data-modal-toggle="deleteModal-{{ $post->id }}" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                        Delete
                    </button>

                    <!-- Modal Overlay -->
                    <div id="modalOverlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40"></div>


                    <!-- Confirmation Modal -->
                    <div id="deleteModal-{{ $post->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                            <!-- Modal content -->
                            <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="deleteModal-{{ $post->id }}">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                <p class="mb-4 text-gray-500 dark:text-gray-300">Are you sure you want to delete this post?</p>
                                <div class="flex justify-center items-center space-x-4">
                                    <!-- Cancel Button -->
                                    <button data-modal-toggle="deleteModal-{{ $post->id }}" type="button" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                        No, cancel
                                    </button>
                                    <!-- Confirm Button -->
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                                            Yes, I'm sure
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Pagination -->
<div>
    {{ $posts->links() }}
</div>

<!-- JavaScript for Modal Handling -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Get the modal overlay element
    const modalOverlay = document.getElementById('modalOverlay');

    // Toggle modal and overlay visibility
    document.querySelectorAll('[data-modal-toggle]').forEach(button => {
        button.addEventListener('click', function() {
            const modalId = this.getAttribute('data-modal-target');
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.toggle('hidden');
                modalOverlay.classList.toggle('hidden'); // Toggle overlay visibility
            }
        });
    });

    // Close the modal and overlay when clicking outside the modal
    window.addEventListener('click', function(event) {
        if (event.target === modalOverlay) {
            modalOverlay.classList.add('hidden');
            document.querySelectorAll('.modal').forEach(modal => {
                modal.classList.add('hidden');
            });
        }
    });
});
</script>



@endsection









