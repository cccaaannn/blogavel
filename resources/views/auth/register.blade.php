@extends('layouts.app')

@section('title', __('generic.register'))

@section('layout_content')
    <div class="flex h-full justify-center items-center">
        <div class="flex flex-col max-w-72 gap-4">

            <h1 class="text-4xl font-bold">{{ __('generic.register') }}</h1>

            <form action="/auth/register" method="POST" class="card flex flex-col gap-4 w-full">
                @csrf

                <div class="flex flex-col gap-1">
                    <label for="name">{{ __('generic.name') }}</label>
                    <input type="text" name="name" id="name" class="text-field" required>
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="email">{{ __('generic.email') }}</label>
                    <input type="email" name="email" id="email" class="text-field" required>
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="password">{{ __('generic.password') }}</label>
                    <input type="password" name="password" id="password" class="text-field" required>
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="password_confirmation">{{ __('generic.confirm_password') }}</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="text-field"
                        required>
                    @error('password_confirmation')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="self-end">
                    <button type="submit" class="button">{{ __('generic.register') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
