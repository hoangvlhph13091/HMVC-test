$("body").on('click', '.paginateLink',function(event){
    event.preventDefault();
    let url = $(this).attr('href');
    getData(url);
});
function getData(url){
        let requetsUrl = url
        let sort = $('.active_sort').data('sort') == 'asc' ? 'desc' : 'asc';
        let value = $('.active_sort').data('name');
        let id = $('.active_sort').attr('id');
        if (sort == undefined || value == undefined || id == undefined) {
            sort = 'asc';
            value = '';
            id = '';
        }
        $.ajax({
            type: 'GET',
            url: requetsUrl+'&sortBy='+value+'&order='+sort,
            success: function(response){
                let paginateData = $(response).find("#paginateDivWarp").html()
                let listDataTable = $(response).find(".listDataTable").html()
                $("#paginateDivWarp").html(paginateData??'')
                $(".listDataTable").html(listDataTable??'')
                $('.sortbutton').removeClass('active_sort').change();
                if (id != '') {
                    $('#'+id).attr('data-sort', sort).change();
                    $('#'+id).addClass('active_sort').change();
                }
            }
        })
}
