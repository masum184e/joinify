@extends('includes.layout')

@section('title', 'Payment Successful')
@section('sub-title', 'Joinify')

@section('content')
    <section class="py-12 md:pt-32 md:pb-20">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden p-6 md:p-8">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 mb-6">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>

                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Payment Successful!</h1>
                    <p class="text-lg text-gray-600 mb-8">Thank you for joining the {{ $club }}!</p>

                    <div class="bg-gray-50 rounded-lg p-6 text-left mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Membership Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Name</p>
                                <p class="text-base text-gray-900">{{ $name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Email</p>
                                <p class="text-base text-gray-900">{{ $email }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Student ID</p>
                                <p class="text-base text-gray-900">{{ $student_id }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Department</p>
                                <p class="text-base text-gray-900">{{ $department }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Transaction ID</p>
                                <p class="text-base text-gray-900">{{ $transaction_id }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Amount Paid</p>
                                <p class="text-base text-gray-900">{{ number_format($amount, 2) }} BDT</p>
                            </div>
                        </div>
                    </div>

                    <p class="text-gray-600 mb-6">
                        We've sent a confirmation email to your registered email address with all the details.
                    </p>

                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="/clubs/{{$club_id}}"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            Return to Home
                        </a>
                        <a href="/clubs/{{ $club_id }}/events"
                            class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            View Upcoming Events
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection