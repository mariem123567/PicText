@extends('layout')
@section('main')

<div class="flex flex-col items-center justify-start min-h-screen bg-white p-4 pt-20">
    <h1 class="text-3xl font-semibold text-gray-800 mb-4">Please Verify Your Email</h1>
    <p class="text-lg text-gray-600 mb-6">Didn't get the email?</p>
    
    <form action="{{ route('verification.send') }}" method="post" class="w-full max-w-sm">
      @csrf
      <button type="submit" class="w-full py-2.5 px-4 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-opacity-75 transition duration-300">
        Send Again
      </button>
    </form>
  </div>
  
  
  
@endsection  