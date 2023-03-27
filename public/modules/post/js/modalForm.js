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
                    $('#exampleModalLongTitle').html("add "+response.post.title+"'s Child");
                    $('#parent_id').val(id);
                    $('#Content').val('');
                    $('#title').val('');
                }else if(action === 'edit') {
                    $('#exampleModalLongTitle').html("editting "+response.post.title);
                    $('#parent_id').val(id);
                    $('#Content').val(response.post.content);
                    $('#title').val(response.post.title);
                }
            }
        })
    } else {
        console.log(id);
    }

})
