$('select[name="c_province"]').on('change',function(){
    var province = $(this).val();
    $.ajax({
        type: 'POST',
        url: '/Home/Index/getCityCZ',
        data: 'province=' + province,
        dataType: 'json',
        timeout: 10000,
        success: function(data){
            $("#c_city").empty();
            $("#c_area").empty();
            $("#c_city").append(data.city);
            $("#c_area").append(data.area);
        },
        error: function(xhr, type){
            //alert('抱歉,加载失败!');
        }
    })
});

$('select[name="c_city"]').on('change',function(){
    var city = $(this).val();
    $.ajax({
        type: 'POST',
        url: '/Home/Index/getAreaCZ',
        data: 'city=' + city,
        dataType: 'json',
        timeout: 10000,
        success: function(data){
            $("#c_area").empty();
            $("#c_area").append(data.city);
        },
        error: function(xhr, type){
            //alert('抱歉,加载失败!');
        }
    })
});


$('select[name="z_province"]').on('change',function(){
    var province = $(this).val();
    $.ajax({
        type: 'POST',
        url: '/Home/Index/getCityCZ',
        data: 'province=' + province,
        dataType: 'json',
        timeout: 10000,
        success: function(data){
            $("#z_city").empty();
            $("#z_area").empty();
            $("#z_city").append(data.city);
            $("#z_area").append(data.area);
        },
        error: function(xhr, type){
            alert('抱歉,加载失败!');
        }
    })
});

$('select[name="z_city"]').on('change',function(){
    var city = $(this).val();
    $.ajax({
        type: 'POST',
        url: '/Home/Index/getAreaCZ',
        data: 'city=' + city,
        dataType: 'json',
        timeout: 10000,
        success: function(data){
            $("#z_area").empty();
            $("#z_area").append(data.city);
        },
        error: function(xhr, type){
            alert('抱歉,加载失败!');
        }
    })
});