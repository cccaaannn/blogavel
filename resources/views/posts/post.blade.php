@extends('layouts.app')

@section('title', __('generic.post'))

@section('layout_open_graph_description')
    <meta property="og:description" content="{{ $post->title }}">
    <meta name="twitter:description" content="{{ $post->title }}">
@endsection

@section('layout_content')
    <div class="flex flex-col w-full h-full gap-2">

        <div class="flex flex-col">
            <div class="flex justify-between items-start flex-wrap">
                <div class="flex flex-col">
                    <h2 class="text-4xl font-bold text-wrap break-all">{{ $post->title }}</h2>

                    <div class="flex items-center gap-2 -mt-1">
                        <p class="text-sm text-gray-500">{{ $post->user->name }}</p>
                        -
                        <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                    </div>
                </div>

                @if (auth()->check() && auth()->user()->id === $post->user_id)
                    <div class="flex gap-2 py-2">
                        <a href="/posts/{{ $post->id }}/edit" class="button">
                            <i class="fas fa-edit"></i> {{ __('generic.update') }}
                        </a>

                        <form action="/posts/{{ $post->id }}" method="POST" class="flex">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="button">
                                <i class="fas fa-trash-alt"></i> {{ __('generic.delete') }}
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>

        <nav class="text-sm">
            <ol class="list-reset flex text-gray-500">
                <li><a href="/posts"
                        class="text-blue-700 md:dark:text-blue-500 hover:underline">{{ __('generic.posts') }}</a></li>
                <li><span class="mx-2">/</span></li>
                <li>{{ $post->title }}</li>
            </ol>
        </nav>

        <textarea type="text" name="content" id="readonly-editor" class="hidden" required>{{ $post->content }}</textarea>
    </div>
@endsection
