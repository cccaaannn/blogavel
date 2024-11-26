@extends('layouts.app')

@section('title', __('generic.home'))

@section('layout_content')
    <div class="absolute inset-0 flex flex-col justify-center items-center text-center">
        <div>
            <h1 class="text-4xl font-semibold">{{ __('generic.welcome_home') }}</h1>
        </div>

        @auth
            <div>
                <h2 class="text-2xl">{{ __('generic.hello_user', ['name' => Auth::user()->name]) }}</h2>
            </div>
        @endauth
    </div>
@endsection
