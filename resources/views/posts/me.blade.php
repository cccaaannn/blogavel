@extends('layouts.app')

@section('title', __('generic.my_posts'))

@section('layout_content')
    <div class="flex flex-col w-full h-full gap-2">

        <div class="flex justify-between items-center w-full">
            <h1 class="text-4xl font-bold">{{ __('generic.my_posts') }}</h1>

            <div>
                <a href="/posts/create" class="button">{{ __('generic.create_post_button') }}</a>
            </div>
        </div>

        <nav class="text-sm">
            <ol class="list-reset flex text-gray-500">
                <li><a href="/" class="text-blue-700 md:dark:text-blue-500 hover:underline">{{ __('generic.home') }}</a>
                </li>
                <li><span class="mx-2">/</span></li>
                <li>{{ __('generic.my_posts') }}</li>
            </ol>
        </nav>

        <div class="flex flex-col gap-4 w-full">
            @foreach ($posts as $post)
                <div class="card min-h-56 flex flex-col justify-between gap-2">
                    <div class="flex flex-col flex-grow">
                        <div class="flex justify-between items-start flex-wrap gap-2">
                            <div class="flex gap-3 items-start">
                                <div
                                    class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                                    @if ($post->user->avatar)
                                        <img src="{{ Storage::disk('minio')->url('public/avatars/' . $post->user->avatar) }}"
                                            alt="User Avatar" class="rounded-full">
                                    @else
                                        <span
                                            class="font-medium text-gray-600 dark:text-gray-300 text-lg">{{ $post->user->name[0] }}</span>
                                    @endif

                                </div>
                                <div class="flex flex-col">
                                    <h2 class="text-2xl font-bold text-wrap break-all">{{ $post->title }}</h2>

                                    <div class="flex items-center gap-2 -mt-1">
                                        <p class="text-sm text-gray-500">{{ $post->user->name }}</p>
                                        -
                                        <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>

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
                        </div>

                        <hr class="my-2">

                        <div class="bg-slate-900 flex-grow rounded">
                            <textarea type="text" name="content" id="readonly-editor" class="hidden">{{ $post->content }}</textarea>
                        </div>
                    </div>

                    <a href="/posts/{{ $post->id }}"
                        class="text-blue-700 md:dark:text-blue-500 hover:underline">{{ __('generic.read_more') }}</a>
                </div>
            @endforeach

            <div>
                <div class="w-fit mb-2">
                    <form method="GET" action="{{ url('posts/me') }}">
                        <select name="page_size" id="page_size" onchange="this.form.submit()" id="countries" class="select">
                            <option value="5" {{ $pageSize == 5 ? 'selected' : '' }}>5</option>
                            <option value="10" {{ $pageSize == 10 ? 'selected' : '' }}>10</option>
                            <option value="30" {{ $pageSize == 30 ? 'selected' : '' }}>30</option>
                            <option value="50" {{ $pageSize == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ $pageSize == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </form>
                </div>

                {{ $posts->appends(['page_size' => $pageSize])->links() }}
            </div>
        </div>
    </div>
@endsection
