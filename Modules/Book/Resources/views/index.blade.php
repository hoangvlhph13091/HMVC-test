@extends('book::layouts.master')

@section('title')
{!! config('book.name') !!}
@endsection

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="inline-flex rounded-md shadow-sm" role="group">
                        <a href="{{ route('book.addForm') }}">
                            <button type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-l-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                                <svg aria-hidden="true" class="w-4 h-4 mr-2 fill-current" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path></svg>
                                Create new Post
                            </button>
                        </a>

                    </div>
                    <input
                            id="search"
                            name="search"
                            type="search"
                            style="right: 0"
                            placeholder="search">
                    <br>
                    <br>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table  class="listDataTable w-full text-sm text-left text-gray-500 dark:text-gray-400 table-fixed">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No.
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Product Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 break-all">
                                        <div class="flex items-center">
                                            Content
                                            <a href="#" class="sortbutton" id="content_sort" data-sort="desc" data-name="content"><svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1" aria-hidden="true" fill="currentColor"
                                                viewBox="0 0 320 512">
                                                <path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex items-center">
                                            Price
                                            <a href="#" class="sortbutton" id="price_sort" data-sort="desc" data-name="price" >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1" aria-hidden="true" fill="currentColor"
                                                viewBox="0 0 320 512">
                                                <path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </th>
                                    <th scope="col" colspan="2" class="px-6 py-3">
                                        <div class="flex items-center">
                                            Action
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tblLocations">
                               @if (isset($books))
                                    @foreach ( $books as $index => $book )
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                                {{ $index + 1 }}
                                            </td>
                                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                                {{ $book->name }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white truncate	">
                                                {{ $book->content }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $book->price }}
                                            </td>
                                            <td class="px-6 py-4 ">
                                                <a href="{{ route('book.editForm',['id' => $book->id]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                            </td>
                                            <td class="px-6 py-4 ">
                                                <a href="{{ route('book.del',['id' => $book->id]) }}" onclick="return confirm('ayyy')" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Del</a>
                                            </td>
                                        </tr>
                                    @endforeach
                               @else

                               @endif
                            </tbody>
                        </table>
                        <br>
                        @if (isset($books))
                            {!! $books->links() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ Module::asset('Book:js/switchState.js') }}"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/themes/smoothness/jquery-ui.css" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/jquery-ui.min.js"></script>
    <script src="{{ Module::asset('Book:js/paginate.js') }}"></script>
    <script src="{{ Module::asset('Book:js/sort.js') }}"></script>
    <script src="{{ Module::asset('Book:js/search.js') }}"></script>
@endsection
