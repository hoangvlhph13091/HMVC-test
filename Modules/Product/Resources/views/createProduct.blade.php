@extends('post::layouts.master')

@section('title')
{!! config('post.name') !!}
@endsection


@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post">
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
                          name="title"
                          type="text"
                          placeholder="Title">
                        </div>
                        <div class="mb-6">
                          <label class="block text-gray-700 text-sm font-bold mb-2" for="Content">
                            Content
                          </label>
                          <textarea
                          id="Content"
                          name="content"
                          rows="3"
                          class="mt-1 block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:py-1.5 sm:text-sm sm:leading-6" placeholder="insert content here"></textarea>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                            <button type="submit"
                            class="inline-flex justify-center rounded-md bg-blue-600 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ Module::asset('Product:js/test.js') }}"></script>
@endsection
