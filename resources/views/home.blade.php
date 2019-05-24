@extends('layouts.app')

@section('content')
    <div class="flex items-center">
        <div class="md:w-1/2 md:mx-auto">

            @if (session('status'))
                <div
                        class="text-sm border border-t-8 rounded text-green-darker border-green-dark bg-green-lightest px-3 py-4 mb-4"
                        role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="flex flex-col break-words bg-white">

                <div class="font-semibold text-charcoal py-3 px-6 mb-0">
                    <h1>Dashboard</h1>
                </div>

                <div class="w-full p-6">
                    <p class="font-bold">
                        Welcome back {{ $user->name }}!
                    </p>
                </div>

                @if($company)
                    <div class="w-full p-6">
                        @if($company->messages()->count())
                            <p class="text-grey-darkest">
                                Below you see a list of messages ({{ $company->messages->count() }}) your Company has
                                received from potentially interested developers!
                            </p>
                            @foreach($company->messages as $msg)
                                <div class="flex flex-col my-4 p-4">
                                    <span><b>Sender:</b> {{ $msg->sender }}</span>
                                    {{-- Echoing unescaped contnet into the template exposes an XSS vulnerability for the parameters below --}}
                                    <span class="my-2"><b>Title:</b> {!! $msg->title !!}</span>
                                    <span><b>Message:</b> {!! $msg->body !!}</span>
                                </div>
                            @endforeach
                        @else
                            <p class="text-grey-darkest">
                                Your Company has received no messages yet.
                            </p>
                        @endif
                    </div>
                @else
                    <div class="w-full p-6">
                        <p class="text-grey-darkest">
                            You are not currently connected to a company profile.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
