$('body').on('click', '.switchButton', function(e){
    const id = $(this).data('id')
    const action = $(this).data('action')
    $(this).data('action', action == 'delete' ? 'restore' : 'delete');
    $('#modalDiv').css('visibility', 'visible');
    $('.noNoButton').data('id', id)
    $('.sureVkl').data('id', id)
    $('.sureVkl').data('action', action)
})
$('body').on('click', '.noNoButton', function(e){
    const id = $(this).data('id');
    $('.switchButton').each(function(){
        if ($(this).data('id') == id && $(this).is(':checked')) {
            $(this).prop( "checked", false )
        } else if($(this).data('id') == id && $(this).not(':checked')) {
            $(this).prop( "checked", true )
        }
    })
    $('#modalDiv').hide();

})
$('body').on('click', '.sureVkl', function(e){
    const id = $(this).data('id');
    const action = $(this).data('action');
    const url = window.location.href;
    const page = $('.active_paginate_link').data('page');
    $.ajax({
        type: 'patch',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
            id: id,
            action: action,
            },
        url: url+'?page='+page,
        success: function(response){
            let paginateData = $(response).find("#paginateDivWarp").html()
            let listDataTable = $(response).find(".listDataTable").html()
            $("#paginateDivWarp").html(paginateData)
            $(".listDataTable").html(listDataTable)
            $('#modalDiv').hide();
        }
    })

})
