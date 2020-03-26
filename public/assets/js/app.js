function get_request(url){
    $.ajax({
        url: url,
        type: 'Get',
        success: function (data, textStatus, request) {
            if(data["status"]=="OK"){
                $('#ok').removeClass('hide-alert');
                $('#ok-text').html(data["msg"]);
                $('#btn-'+data["table-name"]).attr("disabled",true);
                $('#btn-'+data["table-name"]).html(data["msg"]);
            }else{
                $('#fail').removeClass('hide-alert');
                $('#fail-text').html(data["msg"]);
            }
        },
        error: function (response) {
            $('#fail').removeClass('hide-alert');
            $('#fail-text').html(data["msg"]);
        },
    });
}
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