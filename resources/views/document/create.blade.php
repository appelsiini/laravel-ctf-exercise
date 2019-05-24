@extends('layouts.app')

@section('content')
    <div class="flex items-center flex-col">
        <div class="alert w-full flex flex-row bg-yellow justify-center p-8">
            <i class="fas fa-exclamation-triangle text-pink"></i>
            <span class="mx-4">This page is still under development, please use with caution.</span>
            <i class="fas fa-exclamation-triangle text-pink"></i>
        </div>

        <div class="md:w-2/3 md:mx-auto">

            <div class="flex flex-col break-words bg-white rounded">

                <div class="font-semibold bg-grey-lightest text-grey-darkest py-3 px-6 mb-0">
                    <h1>Create New Document</h1>
                </div>

                <form action="/documents" enctype="multipart/form-data" method="post" class="flex flex-col w-1/2 mx-auto items-center py-4">
                    <input id="file" size="200000" type="file" name="file" class="my-4">
                    <button type="submit" class="p-4 border-2">Submit Document</button>
                </form>
            </div>
        </div>
    </div>
@endsection
