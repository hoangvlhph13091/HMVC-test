@extends('post::layouts.master')

@section('title')
{!! config('Product.name') !!}
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
                              Name
                            </label>
                            @if ($errors->has('name'))
                              <span class="text-red-600">{{ $errors->first('name') }}</span>
                            @endif
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="name"
                            name="name"
                            type="text"
                            placeholder="Name">
                          </div>
                          <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                              Price
                            </label>
                            @if ($errors->has('title'))
                              <span class="text-red-600">{{ $errors->first('title') }}</span>
                            @endif
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="price"
                            name="price"
                            type="number"
                            placeholder="Price">
                          </div>
                          <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                              Post ID
                            </label>
                            <div id="tag_warp">
                                <p  id="tag_target_list"></p>
                                <input type="text" class="tag_target"  name="" placeholder="click_me" id="tag_target">
                            </div>
                            <div id="actuall_input">

                            </div>
                            <div id="nested_list_warp" class="hide">
                                <ul id="myUL">
                                    {!! Modules\Post\Http\Controllers\PostController::tree_view_selection($posts) !!}
                                </ul>
                            </div>
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
<script src="{{ Module::asset('Post:js/viewTree.js') }}"></script>
<script>
    $('#tag_target').click(function () {
        $('#nested_list_warp').toggle('hide');
    })
    $('input[id^="check_box"]').each(function(){
       $(this).click(function () {
            if($(this).is(':checked')) {
                $('#tag_target_list').append(`<span class="tag_bagde" data-id="${$(this).data('id')}" >${$(this).data('value')} <span class="tag_close" data-id="${$(this).data('id')}" >x</span> </span>`)
                $('#actuall_input').append(`<input type="text" hidden name="tag[]" id="tag_no_${$(this).data('id')}" value="${$(this).data('id')}">`)
            }
            else if($(this).not(':checked')) {
                $(`span[data-id^="${$(this).data('id')}"]`).remove()
                $(`input[id^="tag_no_${$(this).data('id')}"]`).remove()
            }
       })
    })
    $(document).on("click", "span.tag_close" , function() {
            $(this).parent().remove();
            $(`input[id^="tag_no_${$(this).data('id')}"]`).remove()
            $(`input[data-id^="${$(this).data('id')}"]`).prop('checked', false);
    });

</script>
@endsection

@section('css')

<link rel="stylesheet" href="{{ Module::asset('Post:css/viewtree.css') }}">

@endsection
