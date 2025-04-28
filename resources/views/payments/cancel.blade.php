@extends('includes.layout')

@section('title', 'Joinify')

@section('content')
<div class="flex items-center justify-center bg-yellow-50 py-20">
    <div class="text-center p-8 bg-white rounded-2xl shadow-xl">
        <div class="text-yellow-500 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-2-8a2 2 0 114 0 2 2 0 01-4 0z" clip-rule="evenodd" />
            </svg>
        </div>
        <h1 class="text-2xl font-bold text-yellow-700 mb-2">Payment Cancelled!</h1>
        <p class="text-gray-600 mb-6">You have cancelled the transaction.</p>
        <a href="/" class="px-6 py-2 bg-yellow-500 text-white rounded-xl hover:bg-yellow-600">Go Home</a>
    </div>
</div>
@endsection

