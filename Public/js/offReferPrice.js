// 提交预约时 输入容重事件
$('#rzprice').bind('input propertychange', function() {
    var rz = $(this).val();
    $.ajax({
        type: 'POST',
        url: '/Home/Index/getOffReferPrice',
        data: 'rz=' +rz,
        dataType: 'json',
        timeout: 10000,
        success: function(data){
            $("#rpri").empty();
            $("#rpri").append(data.price);


            if(data.clean) {
                $("#danwei").empty();
            }
            else {
                $("#pri1").empty();
                $("#pri1").append(data.price);
                $("#danwei").append("元/吨");
            }
        },
        error: function(xhr, type){
            //alert('抱歉,加载失败!');
        }
    })
})