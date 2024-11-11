$(document).ready(function(){
    $('#form').submit(function(e){
        e.preventDefault();
        $('.err_text').text('');
        const form = $('#form')[0];
        const data = new FormData(form);
        const curenturl = window.location.href;
        const backurl = $('#back_link').attr('href');
        $.ajax({
            type: 'POST',
            enctype: "multipart/form-data",
            url: curenturl,
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success: function(){
                window.location.replace(backurl);
            },
            error: function(response){
                let errors = response.responseJSON.errors;
                console.log(errors);
                $.each( errors, function( key, value ) {
                    console.log(key);
                    console.log(value[0]);
                    $('#'+key+'_err').text(value[0])
                })
            }
        })
    })
})
