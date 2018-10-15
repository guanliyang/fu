function getUrlParam(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
    var r = window.location.search.substr(1).match(reg);  //匹配目标参数
    if (r != null) return unescape(r[2]); return null; //返回参数值
}
function isEmpty(v) {
    switch (typeof v) {
        case 'undefined':
            return true;
        case 'string':
            if (v.replace(/(^[ \t\n\r]*)|([ \t\n\r]*$)/g, '').length == 0) return true;
            break;
        case 'boolean':
            if (!v) return true;
            break;
        case 'number':
            if (0 === v || isNaN(v)) return true;
            break;
        case 'object':
            if (null === v || v.length === 0) return true;
            for (var i in v) {
                return false;
            }
            return true;
    }
    return false;
}


// 排序
$(".clkitem").on('click tap',function(){
    // 设置url  有年份和产地时 把年份和产地参数带上
    var url = getUrlYearAndOrder(true, true, true, true, null, true);

    // 重新设置排序属性
    var t_name = $(this).attr('t_name');
    var t_order = $(this).attr('t_order');
    if (t_order == 'desc') {
        s_order = 'asc';
    }
    else {
        s_order = 'desc';
    }
    // 拼链接
    window.location.href = url + "&t_name=" + t_name + "&t_order=" + s_order ;
});

//年份
$(".gy_click").on('click tap',function(){
    var url = getUrlYearAndOrder(true, true, true, null, true, true);

    var gy_id = $(this).attr('value');
    if (!isEmpty(gy_id)) {
        window.location.href = url + "&gy_id=" + gy_id;
    }
    else {
        window.location.href = url;
    }
})

// 产地
$(".gp_click").on('click tap', function() {
    // 年份链接
    var url_gy_id = getUrlParam('gy_id');
    if (url_gy_id != null) {
        url = url + '&gy_id=' + url_gy_id;
    }

    //排序链接
    var url_t_name = getUrlParam('t_name');
    if (url_t_name != null) {
        url = url + '&t_name=' + url_t_name;
    }

    var url_t_order = getUrlParam('t_order');
    if (url_t_order != null) {
        url = url + '&t_order=' + url_t_order;
    }

    var gp_id = $(this).attr('value');
    if (!isEmpty(gp_id)) {
        window.location.href = url + "&gp_id=" + gp_id;
    }
    else {
        window.location.href = url;
    }
})


$(".gl_click").on('click tap', function () {
    var url = getUrlYearAndOrder(true, true, true, true, true, null);
    var gl_id = $(this).attr('value');
    if (!isEmpty(gl_id)) {
        window.location.href = url + "&gl_id=" + gl_id;
    }
    else {
        window.location.href = url;
    }
});

// 年份和排序
function getUrlYearAndOrder(is_province, is_city, is_area, is_gy, is_order, is_level) {
    // 等级
    var url_gl_id = getUrlParam('gl_id');
    if (!isEmpty(url_gl_id) && !isEmpty(is_level)) {
        url = url+ '&gl_id=' + url_gl_id;
    }

    // 年份链接
    var url_gy_id = getUrlParam('gy_id');
    if (!isEmpty(url_gy_id) && !isEmpty(is_gy)) {
        url = url + '&gy_id=' + url_gy_id;
    }

    //排序链接
    var url_t_name = getUrlParam('t_name');
    if (!isEmpty(url_t_name) && !isEmpty(is_order)) {
        url = url + '&t_name=' + url_t_name;
    }

    var url_t_order = getUrlParam('t_order');
    if (!isEmpty(url_t_order) && !isEmpty(is_order)) {
        url = url + '&t_order=' + url_t_order;
    }

    //省市区
    var c_province_id = getUrlParam('c_province_id');
    if (!isEmpty(c_province_id) && !isEmpty(is_province)) {
        url = url + '&c_province_id=' + c_province_id;
    }

    var c_city_id = getUrlParam('c_city_id');
    if (!isEmpty(c_city_id) && !isEmpty(is_city)) {
        url = url + '&c_city_id=' + c_city_id;
    }

    var c_area_id = getUrlParam('c_area_id');
    if (!isEmpty(c_area_id) && !isEmpty(is_area)) {
        url = url + '&c_area_id=' + c_area_id;
    }
    return url;
}


$('select[name="c_province"]').on('change',function(){
    url = getUrlYearAndOrder(null, true, true, true, true, true);

    var c_province_id = $(this).val();
    if (!isEmpty(c_province_id)) {
        window.location.href = url + "&c_province_id=" + c_province_id;
    }
    else {
        window.location.href = url;
    }
});

$('select[name="c_city"]').on('change',function(){
    url = getUrlYearAndOrder(true, null, true, true, true, true);

    var c_city_id = $(this).val();
    if (!isEmpty(c_city_id)) {
        window.location.href = url + "&c_city_id=" + c_city_id;
    }
    else {
        window.location.href = url;
    }
});


$('select[name="c_area"]').on('change',function(){
    url = getUrlYearAndOrder(true, true, null, true, true, true);

    var c_area_id = $(this).val();
    if (!isEmpty(c_area_id)) {
        window.location.href = url + "&c_area_id=" + c_area_id;
    }
    else {
        window.location.href = url;
    }
});