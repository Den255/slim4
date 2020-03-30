function get_request(url,element){
    //console.log("ssss");
    $.ajax({
        url: url,
        type: 'Get',
        success: function (data, textStatus, request) {
            if(data["status"]=="OK"){
                $('#ok').removeClass('hide-alert');
                $('#ok-text').html(data["msg"]);
                $('#btn-'+data["table-name"]).attr("disabled",true);
                $('#btn-'+data["table-name"]).html(data["msg"]);
                if(element!=null){
                    $(element).remove();
                }
            }else{
                $('#fail').removeClass('hide-alert');
                $('#fail-text').html(data["msg"]);
            }
            if(data["posts"]!=null){
                $('#table-posts').empty();
                data["posts"].forEach(update_posts);
            }
            if(element!=null){
                $(element).remove();
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
    $.ajax({
        url: url,
        type: 'post',
        data: data,
        success: function (data, textStatus, request) {
            if(data["status"]=="OK"){
                $('#ok').removeClass('hide-alert');
                $('#ok-text').html(data["msg"]);
                if(modal == 'cat-modal'){
                    $("#menu").append('<button type="button" class="btn btn-outline-primary" onclick="get_request("/home/cat/'+data["slug"]+'")">'+data["name"]+'</button>');
                    $("#cat").append('<option value="'+data["cat_id"]+'">'+data["name"]+'</option>');
                    
                }
                if(modal == 'post-modal'){
                    $("#table-posts").append(
                        '<tr id="post-'+data["post_id"]+'">\
                            <th scope="row">1</th>\
                            <td>/'+data["cat_slug"]+'/'+data["slug"]+'</td>\
                            <td>'+data["title"]+'</td>\
                            <td>\
                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">\
                                    <button type="button" class="btn btn-secondary" onclick="get_request()">Edit</button>\
                                    <button type="button" class="btn btn-secondary" onclick="get_request(\'/home/delete/post-'+data["post_id"]+'\',\'#post-'+data["post_id"]+'\')">Delete</button>\
                                </div>\
                            </td>\
                        </tr>');
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

function update_posts(data,index){
    $("#table-posts").append(
        '<tr id="post-'+data["id"]+'">\
            <th scope="row">1</th>\
            <td>/'+data["cat_slug"]+'/'+data["slug"]+'</td>\
            <td>'+data["title"]+'</td>\
            <td>\
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">\
                    <button type="button" class="btn btn-secondary" onclick="get_request()">Edit</button>\
                    <button type="button" class="btn btn-secondary" onclick="get_request(\'/home/delete/post-'+data["id"]+'\',\'#post-'+data["id"]+'\')">Delete</button>\
                </div>\
            </td>\
        </tr>');
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
function sluggable(input_id,out_id){
    text = $(input_id).val();
    slug = getSlug(text);
    $(out_id).val(slug);
}