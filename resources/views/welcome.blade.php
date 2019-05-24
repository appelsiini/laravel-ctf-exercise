@extends('layouts.app')

@section('content')
    <div class="flex items-center">
        <div class="md:w-1/2 md:mx-auto">

            <div>
                <h1 class="text-charcoal text-center tracking-wide text-5xl mb-6">
                    {{ config('app.name') }}
                </h1>
            </div>

            <div>
                <h2 class="text-charcoal tracking-wide text-3xl mb-6 my-20">
                    Latest News
                </h2>
                <h2 class="text-charcoal tracking-wide text-xl mb-6">
                    We had great time at Laracon Madrid last week!
                </h2>
            </div

        </div>
    </div>
@endsection
