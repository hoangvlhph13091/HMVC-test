$("body").on('click', '.sortbutton',function(event){
    event.preventDefault();
    let sort = $(this).data('sort');
    const value = $(this).data('name');
    sortData(sort, value);
});
function sortData(sort, value){
        const sortType = sort
        const valueType = value
        const url = window.location.href
        $.ajax({
            type: 'GET',
            url: url+'?sortBy='+valueType+'&order='+sortType,
            success: function(response){
                let listDataTable = $(response).find(".listDataTable").html()
                $(".listDataTable").html(listDataTable)
                $('.sortbutton').data('sort', sort == 'asc' ? 'desc' : 'asc')
            }
        })
}
