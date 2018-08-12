<?php
function is_mobile($mobile) {
    return preg_match("/^1\d{10}$/", $mobile);
}

function notice($message, $code = 1, $data = array()) {
    header('Content-type: application/json;charset=utf-8');
    die(json_encode(array('code' => $code, 'msg' => $message, 'ts' => time()) + $data));
}

// 获取二维数组键值, ,分隔
function getArrayV($list, $v_key) {
    if (empty($list) && !is_array($list)) {
        return false;
    }

    $str = '';
    foreach ($list as $key => $value) {
        $str .= $value[$v_key].',';
    }
    return trim($str, ',');
}
/**
 * 保存图片
 */
function save_file($path = 'Public/user_img'){
    file_put_contents('a.log', json_encode($_FILES)."\n", FILE_APPEND);
    $size = 1024 * 1000 * 1; // 1M
    $file = $_FILES["file"];

    $file_types = array('image/png', 'image/jpeg', 'image/jpg', 'image/gif');
    // 图片类型判断
    if (!in_array($file['type'], $file_types)) {
        die(json_encode(array('msg' => '不支持该格式图片')));
    }

    // 图片大小
    if ($file['size'] > $size * 5) {
        die(json_encode(array('msg' => '只支持5M以下图片')));
    }

    $file_path = $path."/".date('Ymd',time())."/";

    if(!file_exists($file_path)){
        //检查是否有该文件夹，如果没有就创建，并给予最高权限
        mkdir($file_path, 0777);
    }
    $src = $file_path.time()."{$file["name"]}";

    $status = move_uploaded_file($file["tmp_name"], $src);
    if ($status) {
        // 地址存cookie里面,不二次上传
        cookie('user_img', '/'.$src);
        die(json_encode(array('url' => '/'.$src)));
    }
    else {
        die(json_encode(array('msg' => '上传失败')));
    }

}

// 用户状态
function getUserStatus($status) {
    $list =
        array(
            0 => '待审核',
            1 => '审核通过'
    );
    return $list[$status];
}

//预购状态
function getOfferStatus($status) {
    $list =
        array(
            0 => '待审核',
            1 => '预约确认', //
            5 => '预约确认(推荐)',
            10 => '已转正式订单'
        );
    return $list[$status];
}

// 售货单状态
function getBillStatus($status) {
    $list =
        array(
            -9 => '删除',
            0 => '待审核',
            9 => '在售',
            10 => '已结单'
        );
    return $list[$status];
}

// 购物车状态
function getCartStatus($status) {
    $list =
        array(
            -9 => '删除',
            1 => '正常',
            9 => '已售',
        );
    return $list[$status];
}

// 订单状态
function getOrderStatus($status) {
    $list =
        array(
            -9 => '删除',
            0 => '审核中',
            10 => '已结单',
        );
    return $list[$status];
}

// 订单 order_item 状态 1离岸/2海运在途/3到岸/4待收货/5待确认/9已确认
function getOrderItemStatus($status) {
    $list =
        array(
            0 => '审核中',
            1 => '离岸',
            2 => '海运在途',
            3 => '到岸',
            4 => '待收货',
            5 => '待确认',
            9 => '已确认',
        );
    return $list[$status];
}

// 订单收货方式
function getDeliType($type) {
    $list =
        array(
            0 => '空',
            1 => '平台物流到门',
            2 => '自提',
        );
    return $list[$type];
}

//支付方式
function getPayType($type) {
    $list =
        array(
            0 => '空',
            1 => '20%首付',
            2 => '全款',
        );
    return $list[$type];
}

if (!function_exists('array_column')) {
    function array_column(array $array, $column_key, $index_key=null){
        $result = array();
        foreach($array as $arr) {
            if(!is_array($arr)) continue;

            if(is_null($column_key)){
                $value = $arr;
            }else{
                $value = $arr[$column_key];
            }

            if(!is_null($index_key)){
                $key = $arr[$index_key];
                $result[$key] = $value;
            }else{
                $result[] = $value;
            }
        }
        return $result;
    }
}
