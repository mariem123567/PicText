@extends('layout')
@section('main')   
{{-- <section class="bg-white dark:bg-gray-900">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <div class="w-full bg-gray-50 rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                Reset your password
              </h1>
        <form class="space-y-4 md:space-y-6" method="post" action="{{route('password.update')}}">
        @csrf

        <input type="hidden" name="token" value="{{$token}}">

            <p class="mb-4 text-grey-700">Enter your email and password</p>
            <div class="flex items-center mb-3">
              
            </div>
                 
            <div>
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
              <input id="email" type="text" name="email" value="{{old('email')}}" placeholder="mail@gmail.com" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500  
               @error('email') border border-red-500 @enderror"/>
              @error('email')
             <p class="text-red-500 text-sm">{{$message}}</p>
              @enderror
            </div>

            <div>
              <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
              <input id="password" type="password" name="password" placeholder="Enter a password" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
               @error('password') border border-red-500 @enderror"/>
                   @error('password')
                   <p class="text-red-500 text-sm">{{$message}}</p>
                   @enderror
            </div>
            
            <div>
              <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
              <input id="password" type="password" name="password_confirmation" placeholder="confirm password" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
               @error('password') border border-red-500 @enderror"/>
            </div>
            
          
            <div class="flex flex-row justify-between mb-8">
             
            </div>
           
            <input type="submit" value="reset password" class="w-full text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
          
          </form>
        </div>
    </div>
</div>
</s--}}
<section class="bg-white dark:bg-gray-900 min-h-screen flex items-center justify-center">
  <div class="w-full max-w-lg p-8 space-y-6">
    <h1 class="text-center text-3xl font-bold text-gray-900 dark:text-white">
      Reset your password
    </h1>
    <p class="text-center text-gray-700 dark:text-gray-400">
      Enter your email and new password below.
    </p>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
      @csrf
      <input type="hidden" name="token" value="{{ $token }}">

      <!-- Email Input -->
      <div>
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
        <input type="text" id="email" name="email" value="{{ old('email') }}" placeholder="mail@example.com" class="w-full p-3 rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500 
          @error('email') border border-red-500 @enderror"/>
          @error('email')
          <p class="text-red-500 text-sm">{{$message}}</p>
          @enderror
      </div>

      <!-- Password Input -->
      <div>
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
        <input id="password" type="password" name="password" placeholder="Enter a new password" class="w-full p-3 rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500 
           @error('password') border border-red-500 @enderror"/>
           @error('password')
           <p class="text-red-500 text-sm">{{$message}}</p>
           @enderror
      </div>

      <!-- Password Confirmation Input -->
      <div>
        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
        <input id="password" type="password" name="password_confirmation" placeholder="Confirm your password" class="w-full p-3 rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500
        @error('password') border border-red-500 @enderror"/>
      </div>

      <!-- Submit Button -->
      <button type="submit" class="w-full py-3 text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm transition duration-300">
        Reset Password
      </button>
    </form>
  </div>
</section>
@endsection