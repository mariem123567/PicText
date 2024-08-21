<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{env('APP_NAME')}}</title>
      @vite(['resources/css/app.css','resources/js/app.js'])<!--without refreshing but also need to npm i-->
    <!-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Loopple/loopple-public-assets@main/motion-tailwind/motion-tailwind.css" rel="stylesheet"> -->
</head>
<body>
<header>
<nav class="bg-white border-gray-200 dark:bg-gray-900">
@if(Auth::guard('admin')->guest() && Auth::guard('web')->guest())
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4 ">
@endif
@if(Auth::guard('admin')->check() || Auth::guard('web')->check())
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between  p-6 ">
  <a href="" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
      
      <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white"  style="font-size: 20px;">{{env('APP_NAME')}}</span>
    
  </a> 
 
   
   
   <!--dropdown menu button-->
  <div x-data="{open: false}" class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
      <button @click="open=!open" type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
        <span class="sr-only">Open user menu</span>
         <img class="w-12 h-12 rounded-full" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="user photo">
      </button>
      <!-- Dropdown menu -->
      <div x-show="open" @click.outside="open=false" class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
        <div class="px-4 py-3">
      @endif
        @if(Auth::guard('admin')->check())
          <span class="block text-sm text-gray-900 dark:text-white">{{auth()->guard('admin')->name}}</span>
        @endif
        @if(Auth::guard('web')->check())
          <span class="block text-sm text-gray-900 dark:text-white">{{auth()->user()->name}}</span>
          <span class="block text-sm text-gray-500 truncate dark:text-gray-400">{{auth()->user()->email}}</span>
        @endif
        @if(Auth::guard('admin')->check() || Auth::guard('web')->check())
        </div>
        <ul class="py-2" aria-labelledby="user-menu-button">
        @endif
        @if(Auth::guard('web')->check())
          <li>
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
          </li>
        @endif
        @if(Auth::guard('admin')->check())
          <li>
            <a href="{{ route('adminDashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
          </li>
        @endif
        @if( Auth::guard('admin')->check() || Auth::guard('web')->check())
          
          <li>
          <form method="post" action="{{route('logout')}}">
          @csrf
            <button class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Log out</button>
            </form>
          </li>
        </ul>
      </div>
      @endif
     
      <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-user" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>
  </div>
  <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
    <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
      @if(Auth::guard('admin')->check() || Auth::guard('web')->check())
      <li>
        <a href="{{ route('posts.index') }}" class="block py-2 px-3 text-white bg-purple-600 md:bg-transparent md:text-purple-700 md:p-0 md:dark:text-purple-500" style="margin-right: 930px;font-size: 25px;" aria-current="page">Home</a>
      </li>
      @endif
     
      @if(Auth::guard('admin')->guest() && Auth::guard('web')->guest())
      <li>
        <a href="{{ route('register') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Register</a>
      </li>
      <li>
        <a href="{{ route('login') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Login</a>
      </li>
      
      @endif
    </ul>
  </div>
  </div>
</nav>
</header>
    <main>
        @yield('main')
    </main>
</body>
</html>