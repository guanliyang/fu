<?php

// 获取 系统信息 文字显示
function getMsgText($type) {
    $list =
        array(
            0 => '订单号',
            1 => '货单号',
            2 => '预约单',
        );
    return $list[$type];
}

// 获取 系统信息
function getMsgUrl($type) {
    $list =
        array(
            0 => '/Home/Order/info/o_id/',
            1 => '/Home/Sell/sellBillInfo/b_id/',
            2 => '/Home/Offer/offerInfo/f_id/',
        );
    return $list[$type];
}

// 判断是否是电话
function is_mobile($mobile) {
    return preg_match("/^1\d{10}$/", $mobile);
}

//警告信息
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
            0 => '待生效',
            1 => '预约中', //
            5 => '预约确认(推荐)',
            10 => '预约成功'
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
            0 => '待付款',
            1 => '待收货',
            9 => '已收货',
            10 => '已结单',
        );
    return $list[$status];
}

// 订单 order_item 状态 1离岸/2海运在途/3到岸/4待收货/5待确认/9已确认
function getOrderItemStatus($status) {
    $list =
        array(
            0 => '',
            1 => '[海运在途]',
            2 => '[待付尾款]',
            3 => '[待付其他费用]',
            4 => '[物流待发货]',
            5 => '[待到港提货]',
            6 => '[物流配送中]',
            7 => '[待确认收货]',
            8 => '[已确认收货]',
            // 当OrderStatus 状态是10 已结单时  item 不显示状态
            9 => '',
        );
    return $list[$status];
}

// 物流信息
function getWuLiuMessage($status) {
    if ($status == 4) {
        return '正在派单';
    }

    if ($status == 6) {
        return '运送途中请准备收货';
    }

    if ($status >= 7) {
        return '物流配送完成';
    }

    return '暂无';
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

// 二维数组 某键值
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

//根据id和类型获取被截断的消息内容
function getMessageById($resource_id, $type = 0) {
    $where = array(
        'type' => $type,
        'resource_id' => $resource_id
    );

    $msg = M('sys_msg')->where($where)->order('ctime desc')->find();

    return subtext($msg['sm_content'], 6);
}

/*字符串截断函数+省略号*/
function subtext($text, $length)
{
    $dian = '...';
    if(mb_strlen($text, 'utf8') > $length) {
        return mb_substr($text, 0, $length, 'utf8').$dian;
    }
    if (empty($text)) {
        return $dian;
    }
    return $text;
}

function getDateTime($time) {
    if (empty($time)) {
        return '暂无';
    }
    return date("Y年m月d日 H:i:s", $time);
}


/**
 * 待付货款
 * @param $pay_type 支付方式
 * @param $oi_status  货组状态
 * @param $o_pay_t 尾款
 * @param $o_pay_f 首付款
 * @param $oi_dpay 本组货款
 */
function getOrderItemPendingMoney($order, $order_item) {
    $pay_type = $order['o_pay_type'];
    $oi_status = $order_item['oi_status'];
    $o_pay_t = $order['o_pay_t'];
    $o_pay_f = $order['o_pay_f'];
    $oi_dpay = $order_item['oi_dpay'];

    $str = '--';
    // 全付
    if ($pay_type == \Home\Model\OrderModel::PAY_ALL) {
        $str = '已付货款';
    }

    // 20首付
    if ($pay_type == \Home\Model\OrderModel::PAY_PART) {
        if ($oi_status > 2) {
            $str = '已付货款';
        }
        else {
            // 计算公式算出待付货款
            $str = number_format(getPendingMoney($o_pay_f, $o_pay_t, $oi_dpay)).'元';
            if (empty($str)) {
                $str = '已付货款';
            }
        }
    }

    return $str;
}

// 公式计算出待付货款
function getPendingMoney($o_pay_f, $o_pay_t, $oi_dpay) {
    $numb = 0;
    if ($o_pay_f - $o_pay_t >= $oi_dpay) {
        $numb = $oi_dpay;
    }
    elseif ($o_pay_t > $o_pay_f) {
        $numb = $o_pay_t - $o_pay_f;
    }
    return $numb;
}

/**
 * 可结息 -  获取已结利息
 * @param $pay_type 支付方式
 * @param $oi_status  货组状态
 * @param $oi_dpay 本组货款
 */
function getKnot($order, $order_item) {
    $pay_type = $order['o_pay_type'];
    $oi_status = $order_item['oi_status'];
    $o_pay_t = $order['o_pay_t'];
    $o_pay_f = $order['o_pay_f'];
    $oi_dpay = $order_item['oi_dpay'];

    $rate = C('RATE');

    // 全付
    if ($pay_type == \Home\Model\OrderModel::PAY_ALL) {
        $str = '';
    }

    // 20首付
    if ($pay_type == \Home\Model\OrderModel::PAY_PART) {
        if ($oi_status > 2) {
            $str = '已结利息';
        }
        else {
            $pendMoney = getPendingMoney($o_pay_f, $o_pay_t, $oi_dpay);
            $day = getPastDay($order);
            $str = $pendMoney * $rate * $day;
        }
    }
    return $str;
}

//已成交天数
function getPastDay($order) {
    $day = (int)((time() - $order['o_dtime']) / (60*60*24));
    return $day;
}