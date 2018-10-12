$("#code_bt").click(function(){
    var mobile = $("input[name='mobile']").val();
    $.ajax({
        type: 'POST',
        url: '/Home/Index/ajaxSendSms',
        data: 'mobile=' + mobile,
        dataType: 'json',
        timeout: 10000,
        success: function(data){
            if (data.code != 0) {
                alert(data.msg);
            }
        },
        error: function(xhr, type){
            alert('抱歉,加载失败!');
        }
    })
});