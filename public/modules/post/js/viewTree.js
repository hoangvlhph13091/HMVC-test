$(window).on("load", function () {

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
                $(this).toggleClass('hide')
            }
        })
    })

});
