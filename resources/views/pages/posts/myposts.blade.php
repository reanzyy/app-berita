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
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg lg:my-5">
                    <div class="relative">
                        <button id="dropdownDividerButton" data-dropdown-toggle="dropdownDivider"
                            class="text-black absolute top-0 right-0 m-2 p-2"type="button"><i
                                class="fa-solid fa-ellipsis-vertical"></i>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdownDivider"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow border w-44">
                            <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDividerButton">
                                <li>
                                    <a href="{{ route('posts.edit', $post->id) }}"
                                        class="block px-4 py-2 hover:bg-gray-100">Edit</a>
                                </li>
                                <li>
                                    {{-- <a href="{{ route('posts.edit', $post->id) }}" class="">Delete</a> --}}
                                    <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                                        class="flex w-full px-4 py-2 hover:bg-gray-100" type="button">
                                        Delete
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @include('pages.posts.delete')
                    <a href="/post/{{ $post->id }}/detail">
                        <div class="p-6 text-gray-900">
                            <h1 class="text-2xl font-bold">{{ $post->title }}</h1>
                            <div class="font-semibold text-gray-500">{{ $post->name }}</div>
                            <div class="text-xs text-gray-500">
                                {{ date_format(DateTime::createFromFormat('Y-m-d H:i:s', $post->created_at), 'd M Y H:i') }}
                            </div>
                            <img src="" alt="">
                            <div class="leading-tight mt-3">{!! Str::substr($post->news_content, 0, 305) !!}....</div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
