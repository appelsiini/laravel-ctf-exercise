@extends('layouts.app')

@section('content')
    <div class="flex items-center">
        <div class="md:w-1/2 md:mx-auto">

            <div class="flex flex-col break-words bg-white rounded">

                <div class="font-semibold bg-grey-lightest text-grey-darkest py-3 px-6 mb-0">
                    <h1>{{ $company->name }}</h1>
                    <div class="flex flex-row my-2">
                        <i class="fas fa-globe-americas"></i>
                        <span class="pl-2">{{ $company->location }}</span>
                    </div>
                </div>

                <div class="w-full p-6">
                    <div class="flex flex-row items-center px-6">
                        <i class="far fa-envelope text-2xl mr-2"></i>
                        <h2>Send Company A Message</h2>
                    </div>
                    <div>
                        <div class="w-full">
                            <form class="bg-white rounded p-6 pb-8" method="post" action="/messages">
                                @csrf
                                <div class="mb-4">
                                    <label
                                            class="block text-grey-darker text-sm font-bold mb-2 text-charcoal"
                                            for="sender">
                                        Sender
                                    </label>
                                    <input
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                                            id="sender" name="sender" type="text" placeholder="Write your email here">
                                </div>
                                <div class="mb-4">
                                    <label
                                            class="block text-grey-darker text-sm font-bold mb-2 text-charcoal"
                                            for="title">
                                        Title
                                    </label>
                                    <input
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                                            id="title" name="title" type="text" placeholder="Title of your message">
                                </div>
                                <div class="mb-4">
                                    <label
                                            class="block text-grey-darker text-sm font-bold mb-2 text-charcoal"
                                            for="body">
                                        Message
                                    </label>
                                    <textarea
                                            class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3 leading-tight focus:outline-none focus:shadow-outline"
                                            id="body" name="body" type="text" placeholder="Write your message here">
                                    </textarea>
                                    <input type="hidden" name="company_id" value="{{ $company->id }}">
                                </div>
                                <div class="flex items-center justify-between">
                                    <button
                                            type="submit"
                                            class="bg-ink hover:shadow-lg text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                            type="button">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="w-full p-6">
                        <h2>Open Positions ({{ $company->jobs->count() }})</h2>
                        @foreach ($company->jobs as $job)
                            <div class="flex flex-col w-full my-4">
                                <h3>{{ $job->title }}</h3>
                                <span>{{ substr($job->description, 0, 150) }}...</span>
                                <span class="mt-1 font-bold text-sm">Listed: {{ (new DateTime($job->created_at))->format('Y-m-d') }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
@endsection
