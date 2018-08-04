$('select[name="province"]').on('change',function(){
    var province = $(this).val();
    $.ajax({
        type: 'POST',
        url: '/Home/Index/getCity',
        data: 'province=' + province,
        dataType: 'json',
        timeout: 10000,
        success: function(data){
            $("#cmbCity").empty();
            $("#cmbArea").empty();
            $("#cmbCity").append(data.city);
        },
        error: function(xhr, type){
            alert('抱歉,加载失败!');
        }
    })
});

$('select[name="city"]').on('change',function(){
    var city = $(this).val();
    $.ajax({
        type: 'POST',
        url: '/Home/Index/getArea',
        data: 'city=' + city,
        dataType: 'json',
        timeout: 10000,
        success: function(data){
            $("#cmbArea").empty();
            $("#cmbArea").append(data.city);
        },
        error: function(xhr, type){
            alert('抱歉,加载失败!');
        }
    })
});