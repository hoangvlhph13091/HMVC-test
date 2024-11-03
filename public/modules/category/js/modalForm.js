$(".btn-action").click(function(e){
    e.preventDefault();
    const id = $(this).attr('id');
    const action = $(this).data('action');
    if(action !== 'del'){
        $.ajax({
            type: 'POST',
            url: postCollection,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
            },
            success: function(response){
                if(action === 'add') {
                    $('#exampleModalLongTitle').html("add "+response.category.name+"'s Child");
                    $('#parent_id').val(id).change();
                    $('#Content').val('');
                    $('#title').val('');
                    $('#cate_modal_form_submit_btn').attr('data-action', 'add').change();
                }else if(action === 'edit') {
                    $('#exampleModalLongTitle').html("editting "+response.category.name);
                    $('#parent_id').val(response.category.parent_id);
                    $('#Content').val(response.category.comment);
                    $('#title').val(response.category.name);
                    $('#cate_modal_form_submit_btn').attr('data-action', 'edit').change();
                    $('#cate_modal_form_submit_btn').attr('data-id', id).change();
                }
            }
        })
    } else {
        if (confirm('Delete category??')) {
            $.ajax({
                type: 'POST',
                url: categoryDel + '/' + id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response){
                    const curenturl = window.location.href;
                    window.location.replace(curenturl);
                }
            })
        } else {
            return;
        }

    }

})

$('#cate_modal_form_submit_btn').click(function(e){
    e.preventDefault();
    const form = $('#cate_modal_form')[0];
    const data = new FormData(form);
    const curenturl = window.location.href;
    let post_url = '';
    if ($(this).data('action') == 'add') {
        post_url = categoryAdd;
    } else {
        post_url = categoryEdit + '/' + $(this).data('id');
    }

    $.ajax({
        type: 'POST',
        enctype: "multipart/form-data",
        url: post_url,
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        success: function(){
            window.location.replace(curenturl);
        }
    })
})
