function t_submit(url) {
    $("#t_submit").on('click tap',function(){
        // 获取所有input数组
        var data = '';
        $(":input").each(function(){
            var key = $(this).attr('name');
            var val = $(this).val() ;
            if (key && val) {
                data = data + key + "=" + val + "&";
            }
        });

        $("select option:selected").each(function(){
            var key = $(this).attr('name');
            var val = $(this).val() ;
            if (key && val) {
                data = data + key + "=" + val + "&";
            }
        });

        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            dataType: 'json',
            timeout: 10000,
            success: function(data){
                if(data.url) {
                    window.location.href = data.url ;
                }
                else {
                    alert(data.msg);
                }
            },
            error: function(xhr, type){
                alert('抱歉,加载失败!');
            }
        })
    });
}