<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Posts') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-1 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 lg:mb-5 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"
                href="{{ route('posts.create') }}">Create Post</a>
            @foreach ($myposts as $post)
                <a href="/post/{{ $post->id }}/detail">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg lg:my-5">
                        <div class="p-6 text-gray-900">
                            <h1 class="text-2xl font-bold">{{ $post->title }}</h1>
                            <div class="font-semibold text-gray-500">{{ $post->name }}</div>
                            <div class="text-xs text-gray-500">
                                {{ date_format(DateTime::createFromFormat('Y-m-d H:i:s', $post->created_at), 'd M Y H:i') }}
                            </div>
                            <img src="" alt="">
                            <div class="leading-tight mt-3">{{ Str::substr($post->news_content, 0, 305) }}....</div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
