function t_submit(url) {
    $("#t_submit").on('click tap',function(){
        // 获取所有input text 数组
        var data = '';
        $("input:text").each(function(){
            var key = $(this).attr('name');
            var val = $(this).val() ;
            if (key && val) {
                data = data + key + "=" + val + "&";
            }
        });

        // 获取所有input hidden 数组
        $("input:hidden").each(function(){
            var key = $(this).attr('name');
            var val = $(this).val() ;
            if (key && val) {
                data = data + key + "=" + val + "&";
            }
        });

        // 所有select数组
        $("select").each(function(){
            var key = $(this).attr('name');
            var val = $(this).find('option:selected').val() ;
            if (key && val) {
                data = data + key + "=" + val + "&";
            }
        });

        // checkbox
        $("input:checkbox:checked").each(function(){
            var key = $(this).attr('name');
            var val = $(this).val() ;
            if (key && val) {
                data = data + key + "=" + val + "&";
            }
        });

        // radio
        $("input:radio:checked").each(function(){
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