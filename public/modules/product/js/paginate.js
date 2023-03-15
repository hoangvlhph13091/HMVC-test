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
                $("#paginateDivWarp").html(paginateData??'')
                $(".listDataTable").html(listDataTable??'')

            }
        })
}
