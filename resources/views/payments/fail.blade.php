@extends('includes.layout')

@section('title', 'Joinify')

@section('content')
    <div class="flex items-center justify-center bg-red-50 py-20">
        <div class="text-center p-8 bg-white rounded-2xl shadow-xl">
            <div class="text-red-500 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm2-11a1 1 0 10-2 0v2a1 1 0 002 0V7zm0 6a1 1 0 10-2 0v2a1 1 0 002 0v-2z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-red-700 mb-2">Payment Failed!</h1>
            <p class="text-gray-600 mb-6">Something went wrong. Please try again.</p>
            <a href="/" class="px-6 py-2 bg-red-500 text-white rounded-xl hover:bg-red-600">Go Home</a>
        </div>
    </div>
@endsection