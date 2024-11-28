@extends('layouts.app')

@section('title', __('generic.login'))

@section('layout_content')
    <div class="flex h-full justify-center items-center">
        <div class="flex flex-col max-w-72 gap-4">

            <h1 class="text-4xl font-bold">{{ __('generic.login') }}</h1>

            <form action="/auth/login" method="POST" class="card flex flex-col gap-4 w-full">
                @csrf

                <div class="flex flex-col gap-1">
                    <label for="name">{{ __('generic.name') }}</label>
                    <input type="text" name="name" id="name" class="text-field" required>
                </div>

                <div class="flex flex-col gap-1">
                    <label for="password">{{ __('generic.password') }}</label>
                    <input type="password" name="password" id="password" class="text-field" required>
                </div>

                @if ($errors->any())
                    <div class="text-red-500 text-sm">
                        {{ $errors->first('name') }}
                    </div>
                @endif

                <div class="self-end">
                    <button type="submit" class="button">{{ __('generic.login') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
