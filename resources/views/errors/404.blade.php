@extends('includes.layout')

@section('title', 'Joinify')
@section('sub-title', '404 Not Found')

@section('content')
    <div class="flex items-center justify-center bg-gray-100 px-6 pt-32 pb-20">
        <div class="text-center max-w-md">
            <h1 class="text-6xl font-bold text-red-500 mb-6">404</h1>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Oops! Page not found.</h2>
            <p class="text-gray-500 mb-6">The page you're looking for doesn’t exist or has been moved.</p>
            <a href="{{ url('/') }}"
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition">
                ← Back to Home
            </a>
        </div>
    </div>
@endsection