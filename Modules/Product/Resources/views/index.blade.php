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
                        <table class="listDataTable w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Product Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex items-center">
                                            Content
                                            <a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1" aria-hidden="true" fill="currentColor"
                                                viewBox="0 0 320 512">
                                                <path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex items-center">
                                            Price
                                            <a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1" aria-hidden="true" fill="currentColor"
                                                viewBox="0 0 320 512">
                                                <path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex items-center">
                                            Post
                                            <a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1" aria-hidden="true" fill="currentColor"
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
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $prod->name }}
                                        </th>
                                        <td class="px-6 py-4">
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
                                            <a href="#" class="font-medium text-red-600 dark:text-blue-500 hover:underline">Delete</a>
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
    <script>
        $("body").on('click', '.paginateLink',function(event){
            event.preventDefault();
            let url = $(this).attr('href');
            getData(url);
        });
        function getData(url){
                let requetsUrl = url
                $.ajax({
                    type: 'GET',
                    url: requetsUrl,
                    success: function(response){
                        let paginateData = $(response).find("#paginateDivWarp").html()
                        let listDataTable = $(response).find(".listDataTable").html()
                        $("#paginateDivWarp").html(paginateData)
                        $(".listDataTable").html(listDataTable)

                    }
                })
        }
    </script>
@endsection
