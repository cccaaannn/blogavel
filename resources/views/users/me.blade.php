@extends('layouts.app')

@section('title', __('generic.profile'))

@section('layout_content')
    <div class="flex flex-col w-full h-full gap-2">

        <nav class="text-sm">
            <ol class="list-reset flex text-gray-500">
                <li><a href="/" class="text-blue-700 md:dark:text-blue-500 hover:underline">{{ __('generic.home') }}</a>
                </li>
                <li><span class="mx-2">/</span></li>
                <li>{{ __('generic.profile') }}</li>
            </ol>
        </nav>

        <h3 class="block text-2xl font-medium text-gray-900 dark:text-white">
            {{ __('generic.upload_avatar') }}
        </h3>

        <div class="flex flex-col gap-8 max-w-96">
            <form action="/users/avatar" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
                @csrf

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex items-center gap-4">
                    <input class="file-input" id="avatar_input" name="avatar" type="file">

                    @error('title')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror

                    <button type="submit" class="button">{{ __('generic.upload') }}</button>
                </div>
            </form>

            <div class="flex items-center justify-between">
                @if (Auth::user()->avatar)
                    <div
                        class="relative inline-flex items-center justify-center w-24 h-24 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                        <img src="{{ Storage::disk('minio')->url('public/avatars/' . Auth::user()->avatar) }}"
                            alt="User Avatar" class="rounded-full">
                    </div>

                    <form action="/users/avatar" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="button">{{ __('generic.delete') }}</button>
                    </form>
                @endif
            </div>

            <div class="md:w-auto w-full">
                <form action="/auth/logout" method="POST">
                    @csrf
                    <button type="submit" class="button">
                        {{ __('generic.logout') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
