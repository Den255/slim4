$('#addcat').on('click', function(e){
    e.preventDefault(); // prevent the default click action
    $.ajax({
        url: '/home/add-cat',
        type: 'Get',
        success: function (data, textStatus, request) {
            $('#ok').removeClass('hide-alert');
        },
        error: function (response) {
            $('#fail').removeClass('hide-alert');
        },
    });
});
$('#close-fail').on('click', function(e){
    $('#fail').addClass('hide-alert');
});
$('#close-ok').on('click', function(e){
    $('#ok').addClass('hide-alert');
});
$('#success').on('click', function(e){
    $('#ok').removeClass('hide-alert');
});