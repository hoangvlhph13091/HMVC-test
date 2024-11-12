$("body").on('click', '.sortbutton',function(event){
    event.preventDefault();
    let sort = $(this).data('sort');
    const value = $(this).data('name');
    let id = $(this).attr('id');
    let page = $('.active_paginate_link').attr('data-page');

    if (page == '' || page == undefined) {
        page = 1;
    }
    sortData(sort, value, id, page);
});
function sortData(sort, value, id, page){
        const sortType = sort
        const valueType = value
        const url = window.location.href
        $.ajax({
            type: 'GET',
            url: url+'?page='+page+'&sortBy='+valueType+'&order='+sortType,
            success: function(response){
                let listDataTable = $(response).find(".listDataTable").html()
                $(".listDataTable").html(listDataTable)
                $('#'+id).attr('data-sort', sort == 'asc' ? 'desc' : 'asc').change();
                $('.sortbutton').removeClass('active_sort').change();
                $('#'+id).addClass('active_sort').change();
            }
        })
}
