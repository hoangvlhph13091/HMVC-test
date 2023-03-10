$('body').on('click', '.switchButton', function(e){
    const id = $(this).data('id')
    const action = $(this).data('action')
    $(this).data('action', action == 'delete' ? 'restore' : 'delete');
    $('#modalDiv').show();
    $('.noNoButton').data('id', id)
    $('.sureVkl').data('id', id)
    $('.sureVkl').data('action', action)
})
$('body').on('click', '.noNoButton', function(e){
    const id = $(this).data('id');
    $('.switchButton').each(function(){
        if ($(this).data('id') == id && $(this).is(':checked')) {
            $(this).prop( "checked", false )
        } else if($(this).data('id') == id && $(this).not(':checked')) {
            $(this).prop( "checked", true )
        }
    })
    $('#modalDiv').hide();

})
$('body').on('click', '.sureVkl', function(e){
    const id = $(this).data('id');
    const action = $(this).data('action');
    const url = window.location.href
    $.ajax({
        url: url+'/'+action+'/'+id,
        success(){
            $('#modalDiv').hide();
        }
    })

})
