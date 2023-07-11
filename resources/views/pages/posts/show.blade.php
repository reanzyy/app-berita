<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Posts') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($post as $item)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg lg:mt-5">
                    <div class="p-6 text-gray-900">
                        <h1 class="text-2xl font-bold">{{ $item->title }}</h1>
                        <p class="font-semibold text-gray-500">{{ $item->writer->name }}</p>
                        <div class="text-xs text-gray-500">
                            {{ date_format(DateTime::createFromFormat('Y-m-d H:i:s', $item->created_at), 'd M Y H:i') }}
                        </div>
                        <div class="flex justify-center items-center">
                            <img class="my-5 rounded-md h-auto w-10/12" src="{{ asset('images/' . $item->image) }}"
                                alt="">
                        </div>
                        <p class="leading-tight mt-3">{{ $item->news_content }}</p>
                    </div>
                </div>
                </a>
            @endforeach
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg lg:mt-5">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold my-3 hover:underline"><span class="hover:text-slate-500">#</span>
                        Comments</h1>
                    @auth
                        <form action="{{ route('comment.store') }}" method="post">
                            @csrf
                            @method('post')

                            @foreach ($post as $item)
                                <input type="hidden" value="{{ $item->id }}" name="post_id">
                            @endforeach
                            <div class="mb-3">
                                <textarea name="comments_content"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>
                            </div>
                            <x-primary-button type="submit">Add Comment</x-primary-button>
                        </form>
                    @else
                        <div class="mb-3">
                            <textarea name="comment_content"
                                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>
                        </div>
                        <x-primary-button><a href="/register">Add Comment</a></x-primary-button>
                    @endauth

                    @foreach ($comments as $comment)
                        <div class="my-5">
                            <div class="font-semibold text-gray-500">{{ $comment->name }}</div>
                            <div class="text-xs text-gray-500">
                                {{ date_format(DateTime::createFromFormat('Y-m-d H:i:s', $comment->created_at), 'd M Y H:i') }}
                            </div>
                            <div class="">{{ $comment->comments_content }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
