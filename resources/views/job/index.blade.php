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
                    <h1>Jobs</h1>
                </div>

                <div class="w-full p-6">
                    <p class="text-lg">Here are all the open jobs at Best Laravel Jobs!</p>
                </div>

                <div class="w-full p-6 flex flex-row flex-wrap justify-center">
                    <job-list/>
                </div>
            </div>
        </div>
    </div>
@endsection
