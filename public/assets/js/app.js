function get_request(url,element){
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
function post_request(url,element){
    $.ajax({
        url: url,
        type: 'post',
        data: {
            name : $("#cat-name").val(),
            slug : $("#slug").val(),
        },
        success: function (data, textStatus, request) {
            if(data["status"]=="OK"){
                $('#ok').removeClass('hide-alert');
                $('#ok-text').html(data["msg"]);
                $('#btn-'+data["table-name"]).attr("disabled",true);
                $('#btn-'+data["table-name"]).html(data["msg"]);
                $("#menu").append('<li class="nav-item"><a class="nav-link active" href="/home/cat/'+data["slug"]+'">'+data["name"]+'</a></li>');
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
    $(element).modal('hide')
}


$('#close-fail').on('click', function(e){
    $('#fail').addClass('hide-alert');
});
$('#close-ok').on('click', function(e){
    $('#ok').addClass('hide-alert');
});