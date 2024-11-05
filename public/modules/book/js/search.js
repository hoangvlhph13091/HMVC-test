$('#search').keyup(function(){
    let searchValue = $(this).val();
    const url = window.location.href;
    $.ajax({
        type:"get",
        url: url+"?searchValue="+searchValue,
        success: function(response){
            let paginateData = $(response).find("#paginateDivWarp").html()
            let listDataTable = $(response).find(".listDataTable").html()
            console.log(paginateData);
            $("#paginateDivWarp").html(paginateData??'')
            $(".listDataTable").html(listDataTable??'')
        }
    })
})
