@extends('post::layouts.master')

@section('title')
{!! config('product.name') !!}
@endsection

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <a href="{{ route('createForm') }}"
                        class="pointer-events-auto ml-8 rounded-md bg-blue-600 py-2 px-3 text-[0.8125rem] font-semibold leading-5 text-white hover:bg-blue-500">
                            <button>Create new Post</button>
                        </a>
                    </div>
                    <br>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="listDataTable w-full text-sm text-left text-gray-500 dark:text-gray-400 table-fixed">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Product Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 break-all">
                                        <div class="flex items-center">
                                            Content
                                            <a href="#" class="sortbutton" data-sort="desc" data-name="content"><svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1" aria-hidden="true" fill="currentColor"
                                                viewBox="0 0 320 512">
                                                <path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex items-center">
                                            Price
                                            <a href="#" class="sortbutton" data-sort="desc" data-name="price" >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1" aria-hidden="true" fill="currentColor"
                                                viewBox="0 0 320 512">
                                                <path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex items-center">
                                            Post
                                            <a href="#" class="sortbutton" data-sort="desc" data-name="postID"><svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1" aria-hidden="true" fill="currentColor"
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
                            <tbody>
                                @foreach ( $products as $prod )
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            {{ $prod->name }}
                                        </th>
                                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white truncate	">
                                            {{ $prod->content }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $prod->price }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $prod->post->title }}
                                        </td>
                                        <td class="px-6 py-4 ">
                                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                        </td>
                                        <td class="px-6 py-4 ">
                                            <input
                                            class=" switchButton mt-[0.3rem] mr-2 h-3.5 w-8 appearance-none rounded-[0.4375rem] bg-[rgba(0,0,0,0.25)] outline-none before:pointer-events-none before:absolute before:h-3.5 before:w-3.5 before:rounded-full before:bg-transparent before:content-[''] after:absolute after:z-[2] after:-mt-[0.1875rem] after:h-5 after:w-5 after:rounded-full after:border-none after:bg-white after:shadow-[0_0px_3px_0_rgb(0_0_0_/_7%),_0_2px_2px_0_rgb(0_0_0_/_4%)] after:transition-[background-color_0.2s,transform_0.2s] after:content-[''] checked:bg-primary checked:after:absolute checked:after:z-[2] checked:after:-mt-[3px] checked:after:ml-[1.0625rem] checked:after:h-5 checked:after:w-5 checked:after:rounded-full checked:after:border-none checked:after:bg-primary checked:after:shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] checked:after:transition-[background-color_0.2s,transform_0.2s] checked:after:content-[''] hover:cursor-pointer focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[3px_-1px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-5 focus:after:w-5 focus:after:rounded-full focus:after:content-[''] checked:focus:border-primary checked:focus:bg-primary checked:focus:before:ml-[1.0625rem] checked:focus:before:scale-100 checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s]"
                                            type="checkbox"
                                            data-id="{{ $prod->id }}"
                                            data-action='{{ $prod->deleted_at == null ? 'delete' : 'restore' }}'
                                            role="switch"
                                            id="flexSwitchCheckDefault"
                                            @if ($prod->deleted_at != null)
                                                checked
                                            @endif />
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <br>
                        {!! $products->links() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ Module::asset('Product:js/paginate.js') }}"></script>
    <script src="{{ Module::asset('Product:js/sort.js') }}"></script>
    <script src="{{ Module::asset('Product:js/switchState.js') }}"></script>
@endsection
