@extends('area::layouts.master')

@section('title')
{!! config('area.name') !!}
@endsection

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="inline-flex rounded-md shadow-sm" role="group">
                        <a href="{{ route('area.addForm') }}">
                            <button type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-l-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                                <svg aria-hidden="true" class="w-4 h-4 mr-2 fill-current" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path></svg>
                                Thêm Khu Vực
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
                                        Khu Vực
                                    </th>
                                    <th scope="col" class="px-6 py-3 break-all">
                                        Ghi Chú
                                    </th>
                                    <th scope="col" colspan="2" class="px-6 py-3">
                                        <div class="flex items-center">

                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tblLocations">
                               @if (isset($areas))
                                    @foreach ( $areas as $index => $area )
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                                {{ $index + 1 }}
                                            </td>
                                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                                {{ $area->book_area_name }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white truncate	">
                                                {{ $area->book_area_note }}
                                            </td>
                                            <td class="px-6 py-4 ">
                                                <a href="{{ route('area.editForm',['id' => $area->id]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                            </td>
                                            <td class="px-6 py-4 ">
                                                <a href="{{ route('area.del',['id' => $area->id]) }}" onclick="return confirm('Xóa Khu Vực??')" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Del</a>
                                            </td>
                                        </tr>
                                    @endforeach
                               @else

                               @endif
                            </tbody>
                        </table>
                        <br>
                        @if (isset($areas))
                            {!! $areas->links() !!}
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
