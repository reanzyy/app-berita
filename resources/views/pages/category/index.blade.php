<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-1 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-5 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"
                href="{{ route('categories.create') }}">Create Category</a>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                <table class="w-full text-sm text-left text-gray-500 shadow">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Category
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4">
                                    {{ $loop->iteration }}
                                </td>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $category->category }}
                                </th>
                                <td class="px-6 py-4">
                                    <a href="{{ route('categories.edit', $category->id) }}"
                                        class="font-medium text-blue-600 hover:underline">Edit</a>
                                    <button data-modal-target="delete{{ $category->id }}"
                                        data-modal-toggle="delete{{ $category->id }}"
                                        class="font-medium text-blue-600 hover:underline" type="button">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @include('pages.category.delete')
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>


</x-app-layout>
