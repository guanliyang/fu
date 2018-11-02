$('select[name="gr_id"]').on('change',function(){
    var rz = $(this).val();
    var gang = $('select[name="b_port"] option:selected').text();
    getReferPrice(gang, rz);
})

$('select[name="b_port"]').on('change',function(){
    var gang = $('select[name="b_port"] option:selected').text();
    var rz = $('select[name="gr_id"] option:selected').text();
    getReferPrice(gang, rz);
})

function getReferPrice(gang, rz) {
    $.ajax({
        type: 'POST',
        url: '/Home/Index/getReferPrice',
        data: 'gang=' + gang + '&rz=' +rz,
        dataType: 'json',
        timeout: 10000,
        success: function(data){
            $("#rpri").empty();
            $("#rpri").append(data.price);
            if(data.clean) {
                $("#danwei").empty();
            }
            else {
                $("#danwei").empty();
                $("#danwei").append("元/吨");
            }
        },
        error: function(xhr, type){
            //alert('抱歉,加载失败!');
        }
    })
}