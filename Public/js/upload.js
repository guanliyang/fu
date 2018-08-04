$("#t_file").change(function(){
    var formData = new FormData();
    formData.append('file', $('#t_file')[0].files[0]);
    $.ajax({
        url: '/Home/Index/uploadImg',
        type: 'POST',
        cache: false,
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        timeout: 10000,
    }).done(function(data) {
        // 返回了地址证明成功了
        if(data.url) {
            $("#show_img").show();
            $("#show_img").attr('src', data.url);
        }
        else {
            alert(data.msg);
        }
    }).fail(function(res) {
        alert("网络过慢");
    });
})