@extends('layout')
@section('main')   
        <div class="container flex flex-col mx-auto bg-white rounded-lg pt-12 my-5">
           <div class="flex justify-center w-full h-full my-auto xl:gap-14 lg:justify-normal md:gap-5 draggable">
      <div class="flex items-center justify-center w-full lg:p-12">
        <div class="flex items-center xl:p-10">
        <form class="flex flex-col w-full h-full pb-6 text-center bg-white rounded-3xl" method="post" action="{{route('password.request')}}">
        @csrf
            <h3 class="mb-3 text-4xl font-extrabold text-dark-grey-900">Request a password reset email</h3>

            <!--session messages-->
        @if(session('status'))
        <div>
           <p class="text-green-500"> {{ session('status') }} </p>
      
        </div>
        @endif
            <p class="mb-4 text-grey-700">Enter your email</p>
                   @error('failed')
                   <p class="text-red-500 text-sm">{{$message}}</p>
                   @enderror
            <div class="flex items-center mb-3">
             
            </div>
            <label for="email" class="mb-2 text-sm text-start text-grey-900">Email</label>
            <input id="email" type="text"name="email" value="{{old('email')}}" placeholder="mail@gmail.com" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 
            @error('email') border border-red-500 @enderror"/>
                   @error('email')
                   <p class="text-red-500 text-sm">{{$message}}</p>
                  @enderror
           
                   <div class="flex flex-row justify-between mb-8">
             </label>
                   </div>
            <input type="submit" value="submit" class="flex space-x-2 mt-3 inline-flex items-center px-2 py-2 text-sm font-medium text-center text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 max-w-fit">
                  


            
           
          </form>
        </div>
      </div>
    </div>
        </div>
        <div class="flex flex-wrap -mx-3 my-5">
            <div class="w-full max-w-full sm:w-3/4 mx-auto text-center">
                <p class="text-sm text-slate-500 py-1">
                    Tailwind CSS Component from <a href="https://www.loopple.com/theme/motion-landing-library?ref=tailwindcomponents" class="text-slate-700 hover:text-slate-900" target="_blank">Motion Landing Library</a> by <a href="https://www.loopple.com" class="text-slate-700 hover:text-slate-900" target="_blank">Loopple Builder</a>.
                </p>
            </div>
        </div>
@endsection