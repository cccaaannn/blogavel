@extends('layouts.app')

@section('title', __('generic.edit_post'))

@section('layout_content')
    <div class="flex flex-col w-full h-full gap-2">

        <h1 class="text-4xl font-bold">{{ __('generic.edit_post') }}</h1>

        <nav class="text-sm">
            <ol class="list-reset flex text-gray-500">
                <li><a href="/posts/me"
                        class="text-blue-700 md:dark:text-blue-500 hover:underline">{{ __('generic.my_posts') }}</a></li>
                <li><span class="mx-2">/</span></li>
                <li><a href="/posts/{{ $post->id }}"
                        class="text-blue-700 md:dark:text-blue-500 hover:underline">{{ $post->title }}</a></li>
                <li><span class="mx-2">/</span></li>
                <li>{{ __('generic.update') }}</li>
            </ol>
        </nav>

        <form action="/posts/{{ $post->id }}" method="POST" class="card flex flex-col gap-4 w-full">
            @csrf
            @method('PUT')

            <div class="flex flex-col gap-1">
                <label for="title">{{ __('generic.title') }}</label>
                <input type="text" name="title" id="title" class="text-field" required value="{{ $post->title }}">
                @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label for="content">{{ __('generic.content') }}</label>
                <textarea type="text" name="content" id="editor" class="hidden" required>{{ $post->content }}</textarea>
                @error('content')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="self-end">
                <button type="submit" class="button">{{ __('generic.save') }}</button>
            </div>
        </form>
    </div>
@endsection
