@extends('category::layouts.master')

@section('title')
{!! config('category.name') !!}
@endsection


@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <a href="{{ route('category.createForm') }}"
                        class="pointer-events-auto ml-8 rounded-md bg-blue-600 py-2 px-3 text-[0.8125rem] font-semibold leading-5 text-white hover:bg-blue-500">
                            <button>Create new Category</button>
                        </a>
                    </div>
                    <br>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <div id="nested_list">
                            <ul id="myUL">
                                {!! Modules\Category\Http\Controllers\CategoryController::tree_view($categories) !!}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="exampleModalCenterBody">
            <form action="" id="cate_modal_form" >
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                      Title
                    </label>
                    @if ($errors->has('title'))
                      <span class="text-red-600">{{ $errors->first('title') }}</span>
                    @endif
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="title"
                    name="name"
                    type="text"
                    placeholder="Title">
                </div>
                <div class="mb-4">
                    <input hidden type="text" name="parent_id" id="parent_id" >
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="Content">
                      Content
                    </label>
                    <textarea
                    id="Content"
                    name="comment"
                    rows="3"
                    class="mt-1 block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:py-1.5 sm:text-sm sm:leading-6" placeholder="insert content here"></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="cate_modal_form_submit_btn">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
    <script src="{{ Module::asset('Category:js/constant.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="{{ Module::asset('Category:js/viewTree.js') }}"></script>
    <script src="{{ Module::asset('Category:js/modalForm.js') }}"></script>
@endsection

@section('css')

<link rel="stylesheet" href="{{ Module::asset('Category:css/viewtree.css') }}">

@endsection
