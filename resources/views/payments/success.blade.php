@extends('includes.layout')

@section('title', 'Joinify')

@section('content')
    <div class="flex items-center justify-center bg-green-50 py-20">
        <div class="text-center p-8 bg-white rounded-2xl shadow-xl">
            <div class="text-green-500 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586l-3.293-3.293a1 1 0 00-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-green-700 mb-2">Payment Successful!</h1>
            <p class="text-gray-600 mb-6">Thank you for your purchase.</p>
            <a href="/" class="px-6 py-2 bg-green-500 text-white rounded-xl hover:bg-green-600">Go Home</a>
        </div>
    </div>
@endsection