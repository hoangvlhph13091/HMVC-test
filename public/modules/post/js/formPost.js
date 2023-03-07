$(document).ready(function(){
    $('#form').submit(function(e){
        e.preventDefault();

        const form = $('#form')[0];
        const data = new FormData(form);
        const url = window.location.href;
        const backurl = $('#back_link').attr('href');
        $.ajax({
            type: 'POST',
            enctype: "multipart/form-data",
            url: url,
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success: function(){
                window.location.replace(backurl);
            }
        })
    })
})
