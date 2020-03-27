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
function post_request(url,modal,form){
    tinyMCE.triggerSave();
    var data =  $('#'+form).serializeArray();
    console.log(data);
    $.ajax({
        url: url,
        type: 'post',
        data: data,
        success: function (data, textStatus, request) {
            if(data["status"]=="OK"){
                $('#ok').removeClass('hide-alert');
                $('#ok-text').html(data["msg"]);
                if(modal == 'cat-modal'){
                    $("#menu").append('<li class="nav-item"><a class="nav-link active" href="/home/cat/'+data["slug"]+'">'+data["name"]+'</a></li>');
                }
                if(modal == 'post-modal'){
                    $("#table-posts").append('<tr><th scope="row">1</th><td></td><td></td><td><div class="btn-group btn-group-sm" role="group" aria-label="Basic example"><button type="button" class="btn btn-secondary" onclick="get_request("/")">Edit</button><button type="button" class="btn btn-secondary" onclick="get_request("/")">Delete</button></div></td></tr>');
                    
                }
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
    $('#'+modal).modal('hide')
}


$('#close-fail').on('click', function(e){
    $('#fail').addClass('hide-alert');
});
$('#close-ok').on('click', function(e){
    $('#ok').addClass('hide-alert');
});
tinymce.init({
    selector: '#postcontent',
    height: 600,
    plugins : 'link'
});
$(document).on('focusin', function(e) {
    if ($(e.target).closest(".tox-dialog").length) {
        e.stopImmediatePropagation();
    }
});