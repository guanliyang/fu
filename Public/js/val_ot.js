$('select[name="c_area"]').on('change',function(){
    var area = $(this).val();
    $.ajax({
        type: 'POST',
        url: '/Home/Index/getValOt',
        data: 'area=' + area,
        dataType: 'json',
        timeout: 10000,
        success: function(data){
            $(".val_ot").empty();
            $(".val_ot").append(data.val_ot);
        },
        error: function(xhr, type){
            //alert('抱歉,加载失败!');
        }
    })
});

$(function () {
    var area = $('select[name="c_area"]').val();
    $.ajax({
        type: 'POST',
        url: '/Home/Index/getValOt',
        data: 'area=' + area,
        dataType: 'json',
        timeout: 10000,
        success: function(data){
            $(".val_ot").empty();
            $(".val_ot").append(data.val_ot);
        },
        error: function(xhr, type){
            //alert('抱歉,加载失败!');
        }
    })
});