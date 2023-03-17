@extends('post::layouts.master')

@section('title')
{!! config('post.name') !!}
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
                        <div id="nested_list">
                            <ul id="myUL">
                                {!! Modules\Post\Http\Controllers\PostController::tree_view($posts) !!}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(window).on("load", function () {
            $(".btn-action").click(function(e){
                e.preventDefault();
            })
            $('.caret').on('click', function () {
                let id = $(this).attr('id');
                $(".nested").each(function () {
                    if($(this).attr('id') == id) {
                        $(this).toggle("active");
                    }
                })
                $(this).toggleClass("caret-down");
            })

            $('li').hover(function(){
                let id = $(this).attr('id');
                $('.btn-action').each(function () {
                    if ($(this).attr('id') == id) {
                        $(this).toggle('hide')
                    }
                })
            })

        });

    </script>
@endsection

@section('css')

<link rel="stylesheet" href="{{ Module::asset('Post:css/viewtree.css') }}">

@endsection
