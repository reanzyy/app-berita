<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Posts') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-12">
        <div class="grid grid-cols-12 gap-4">

            <div class="col-span-8 px-7">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="max-w-sm rounded overflow-hidden shadow-lg">
                        <div class="relative">
                            <img class="w-full" src="gambar.jpg" alt="Gambar">
                            <button
                                class="absolute top-0 right-0 m-2 bg-blue-500 text-white px-4 py-2 rounded-full">Button</button>
                        </div>
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">Judul Card</div>
                            <p class="text-gray-700 text-base">Deskripsi card.</p>
                        </div>
                    </div>

                    @foreach ($posts as $post)
                        <div class="py-3 text-gray-900">
                            <a href="/post/{{ $post->id }}/detail">
                                <div
                                    class=" items-center border shadow bg-white rounded-lg md:flex-row md:max-w-xl hover:bg-gray-50">
                                    <div class="relative">
                                        <button id="dropdownDividerButton" data-dropdown-toggle="dropdownDivider"
                                            class="text-black absolute top-0 right-0 m-2 p-2"type="button"><i
                                                class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <!-- Dropdown menu -->
                                        <div id="dropdownDivider"
                                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                                            <ul class="py-2 text-sm text-gray-700"
                                                aria-labelledby="dropdownDividerButton">
                                                <li>
                                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Edit</a>
                                                </li>
                                                <li>
                                                    <a href="#"
                                                        class="block px-4 py-2 hover:bg-gray-100">Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"
                                        src="{{ asset('images/' . $post->image) }}" alt="">
                                    <div class="flex flex-col justify-between p-4 leading-normal">
                                        <h5 class="text-2xl font-bold tracking-tight">
                                            {{ $post->title }}</h1>
                                        </h5>
                                        <div class="font-semibold text-gray-500">{{ $post->writer->name }}</div>
                                        <div class="mb-2 text-xs text-gray-500">
                                            {{ date_format($post->created_at, 'd M Y H:i') }}
                                        </div>
                                        <p class="font-normal">
                                            {{ Str::substr($post->news_content, 0, 165) }}....
                                        </p>
                                        <p class="mb-3 font-normal">
                                            <span
                                                class="bg-gray-200 border border-gray-800 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{{ $post->categories->category }}
                                            </span>
                                        </p>
                                        <p class="text-sm">
                                            {{ $post->comments->count() }}
                                            <i class="fa-solid fa-comment-dots"></i>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-span-4 px-7">
                <div class="bg-white text-gray-900 lg:py-5 lg:px-4 border shadow rounded-lg">
                    <h2 class="mb-2 text-lg font-semibold text-gray-900">Category</h2>
                    <ul class="max-w-md space-y-1 text-gray-800 list-inside ">
                        @foreach ($categories as $category)
                            <li class="flex items-center">
                                {{ $category->category }}
                                {{ '(' . $posts->where('category_id', '=', $category->id)->count() . ')' }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>
