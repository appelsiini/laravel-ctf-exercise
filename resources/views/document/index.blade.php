@extends('layouts.app')

@section('content')
    <div class="flex items-center flex-col">
        <div class="md:w-2/3 md:mx-auto">

            <div class="flex flex-col break-words bg-white rounded">

                <div class="font-semibold bg-grey-lightest text-grey-darkest py-3 mb-0 flex justify-between">
                    <h1>Documents</h1>
                    <a href="/documents/create">
                        <button class="bg-pink px-6 py-4 text-white font-bold">Upload</button>
                    </a>
                </div>

                <div class="flex flex-col w-full">
                    @if (!empty($documents))
                        <div class="flex flex-col">
                            @foreach ($documents as $doc)
                                <div class="text-charcoal w-full flex flex-col">
                                    <span class="p-2">Original name: {{ $doc->original_name}}</span>
                                    <span class="p-2">Uploaded: {{ $doc->created_at}}</span>
                                    <div class="p-2">
                                        <a href="/uploads/{{ $doc->filename }}">
                                            <button class="bg-ultrablue px-6 py-4 text-white font-bold">View</button>
                                        </a>
                                        <button class="bg-pink px-6 py-4 text-white font-bold">Delete</button>
                                    </div>
                                    <hr class="border-1">
                                </div>
                            @endforeach
                        </div>
                    @else
                        <span>There are no documents uploaded to the system yet, click upload button above to upload a new one.</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
