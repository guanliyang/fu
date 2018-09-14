<?php

// 获取 系统信息 文字显示
function getMsgText($type) {
    $list =
        array(
            0 => '订单号',
            2 => '货单号',
            1 => '预约单',
        );
    return $list[$type];
}

// 获取 系统信息
function getMsgUrl($msg) {
    $msg_type = $msg['sm_type'];
    $list =
        array(
            0 => '/Home/Order/info/o_id/',
            2 => '/Home/Sell/sellBillInfo/b_id/',
            1 => '/Home/Offer/offerInfo/f_id/',
        );
    $url = $list[$msg_type].$msg['sm_rid'].'/msg_id/'.$msg['sm_id'];
    return $url;
}

function getWapMsgUrl($msg) {
    $msg_type = $msg['sm_type'];
    $list =
        array(
            0 => '/Wap/Order/info/o_id/',
            2 => '/Wap/Sell/sellBillInfo/b_id/',
            1 => '/Wap/Offer/offerInfo/f_id/',
        );
    $url = $list[$msg_type].$msg['sm_rid'].'/msg_id/'.$msg['sm_id'];
    return $url;
}

// 获取 系统信息 链接显示文本
function getMsgUrlText($type) {
    $list =
        array(
            0 => '查看订单详情',
            2 => '查看货单详情',
            1 => '查看预约单详情',
        );
    return $list[$type];
}

// 由未读系统消息链接点击过来的  将消息设置成已读
function setReadMsg() {
    $status = 0;
    $msg_id = I('request.msg_id', 0, 'intval');
    if (!empty($msg_id)) {
        $status = M('sys_msg')->where('sm_id='.$msg_id)->save(array('sm_status' => 1));
    }
    return $status;
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

function message($message, $data = array() ) {
    header('Content-type: application/json;charset=utf-8');
    die(json_encode(array('list' => $message) + $data));
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

/**
 * 根据预约状态返回不同的值
 * number是想要获取内容的位置,对应文档中的2,3,4,5,6
 * @param $offer  预约信息
 * @param int $number
 */
function getOfferShow($offer, $number = 0, $url = 'Home') {
    $str = '';
    if ($offer['f_status'] == 0) {
        if ($number == 2) {
            $str = '待';
        }
        if ($number == 3) {
            $str = '待';
        }

        if ($number == 4) {
            $str = '支付预约金与服务费后，预约单立即生效。<br/>生效后，因您的原因取消预约单，服务费将不退还。因平台原因取消，则退还全部费用。';
        }

        if ($number == 5) {
            $str = '<input class="bt bt_s" onclick="disp_confirm()" value="取消预购" type="button"/>';
        }

        if ($number == 6) {
            $str = '';
        }
    }

    if ($offer['f_status'] > 0) {
        if ($number == 2) {
            $str = '已';
        }
        if ($number == 3) {
            $str = '已';
        }

        if ($number == 4) {
            $str = '支付预约金与服务费后，预约单立即生效。<br/>生效后，因您的原因取消预约单，服务费将不退还。因平台原因取消，则退还全部费用。';
        }

        if ($number == 5) {
            $str = '';
        }

        if ($number == 6) {
            $str = '下载电子要约';
        }
    }

    if ($offer['f_status'] == 10) {
        if ($number == 2) {
            $str = '已';
        }
        if ($number == 3) {
            $str = '已';
        }
        if ($number == 4) {
            $str = '预约已成功。生成购买订单，<a href="/'.$url.'/Order/info/o_id/'.$offer['o_id'].'">点击链接查看订单详情</a>';
        }
        if ($number == 5) {
            $str = '';
        }
        if ($number == 6) {
            $str = '下载电子要约';
        }
    }

    return $str;
}


// 售货单状态
function getBillStatus($status) {
    $list =
        array(
            -9 => '删除',
            -1 => '退回',
            0 => '待审核',
            1 => '待付保证金和运费', // 待付款
            2 => '待装货',
            3 => '待上架',
            4 => '待上架',
            5 => '在售',
            6 => '待上架',
            7 => '待上架',
            9 => '已成交',
            10 => '已结单'
        );
    return $list[$status];
}

// 货组状态
function getBillItemStatus($status) {
    $list =
        array(
            -9 => '删除',
            0 => '待审核',
            1 => '已封箱', // 待付款
            2 => '物流运送中',
            3 => '货物已入港',
            5 => '在售',
            6 => '买家已下单',
            7 => '已成交',
            8 => '待付利息及其他',
            9 => '已结算'
        );
    return $list[$status];
}

//在售天数
function getSellDays($bill_item) {
    $days = 0;
    if ($bill_item['bi_status'] == 5 && $bill_item['bi_stime']) {
        $today = strtotime(date('Y-m-d',time()));
        $rtimeDay = strtotime(date("Y-m-d", $bill_item['bi_stime']));
        $days = ($today - $rtimeDay) / 86400 + 1;
    }
    return $days;
}


// 滞箱天数
function getdeDay($order) {
    $today = strtotime(date('Y-m-d',time()));
    $rtimeDay = strtotime(date("Y-m-d", $order['o_detime']));
    $days = ($today - $rtimeDay) / 86400 + 1;
    $days = $days > 0 ? $days : 0;
    return $days;
}

// 显示货组状态
function getBillItemStatusByBill($bill, $status) {
    $str = '';
    if (in_array($bill['b_status'], array(3, 5, 9))) {
        $status_text = getBillItemStatus($status);
        $str = ' <label>['.$status_text.']</label>';
    }

    return $str;
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
            -9 => '已删除',
            0 => '待核费(陆运)',
            1 => '待核费(海运)',
            2 => '待付款',
            3 => '待离岸',
            4 => '海运中',
            5 => '已到岸',
            6 => '待发货',
            7 => '待收货',
            8 => '待提货',
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

// 总价格
function getAllPrice($bill) {
    return formatMoney($bill['b_pri1'] * $bill['b_weig']);
}

//应交保证金
function getDepo($bill) {
    $str = '';
    if ($bill['b_status'] == 0) {
        $str = '需缴保险金：'.$bill['b_depo'].'元';
    }

    if ($bill['b_status'] == 1) {
        $str = '已付保险金：'.$bill['b_depo'].'元';
    }

    if ($bill['b_status'] > 1) {
        $str = '待付保险金：'.$bill['b_depo'].'元';
    }

    return $str;
}

//一共几车
function getCartNumber($info) {
    return count($info['on_bill_item']) + count($info['finish_bill_item']);
}
// 需付运费
function getFrei($bill) {
    $str = '';
    if ($bill['b_status'] == 0) {
        $str = '需缴运费：'.formatMoney($bill['b_frei']).'元';
    }

    if ($bill['b_status'] == 1) {
        $str = '已付运费：'.formatMoney($bill['b_frei']).'元';
    }

    if ($bill['b_status'] > 1) {
        $str = '待付运费：'.formatMoney($bill['b_frei']).'元';
    }

    return $str;
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
            1 => C('FIRST_PAY').'首付',
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
function getMessageById($sm_rid, $type = 0) {
    $where = array(
        'sm_type' => $type,
        'sm_rid' => $sm_rid
    );

    $msg = M('sys_msg')->where($where)->order('sm_ctime desc')->find();

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
    return date("Y/m/d H:i:s", $time);
}

function getBillItemPayStatus($billItem) {
    $str = '-';
    if (in_array($billItem['bi_status'], array(5, 6, 7, 8))) {
        $str = '待';
    }
    if ($billItem['bi_status'] == 9) {
        $str = '已';
    }
    return $str;
}

function getDiffText($bill_item) {
    if ($bill_item['bi_diff'] < 0) {
        return '补跌价';
    }
    else {
        return '退溢价';
    }
}

// 在售货组 回款计息  计算出的，不取数据库字段
function getInte($bill, $bill_item) {
    $today = strtotime(date('Y-m-d',time()));
    $rtimeDay = strtotime(date("Y-m-d", $bill_item['bi_rtime']));

    $days = ($today - $rtimeDay) / 86400 + 1;

    return formatMoney($days * $bill['b_rrate'] * $bill_item['bi_rpay']);
}

// 回款计息
function getAllInte($bill, $on_sell) {
    $pay = 0;
    if (!empty($on_sell) && is_array($on_sell)) {
        foreach ($on_sell as $sell) {
            $pay += getInte($bill, $sell);
        }
    }

    return $pay;
}

/**
 * 待付货款 文本显示
 * @param $pay_type 支付方式
 * @param $oi_status  货组状态
 * @param $o_pay_t 尾款
 * @param $o_pay_f 首付款
 * @param $oi_dpay 本组货款
 */
function getOrderItemPendingMoneyText($order) {
    $pay_type = $order['o_pay_type'];
    $oi_status = $order['o_status'];

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
            $str = '待付货款';
            if (empty($str)) {
                $str = '已付货款';
            }
        }
    }

    return $str;
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

    $str = formatMoney($oi_dpay).'元';

    // 20首付
    if ($pay_type == \Home\Model\OrderModel::PAY_PART) {
        if ($oi_status < 3) {
            $str = formatMoney(getPendingMoney($o_pay_f, $o_pay_t, $oi_dpay)).'元';
        }
    }

    return $str;
}

// 全新 待付货款计算
function getOipm($order) {
    $o_pay_f = $order['o_pay_f'];
    $str = formatMoney($o_pay_f).'元';

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

///**
// * 可结息 -  获取已结利息
// * @param $pay_type 支付方式
// * @param $oi_status  货组状态
// * @param $oi_dpay 本组货款
// */
//function getKnot($order, $order_item) {
//    $pay_type = $order['o_pay_type'];
//    $oi_status = $order_item['oi_status'];
//
//    $rate = C('RATE');
//
//    // 全付
//    if ($pay_type == \Home\Model\OrderModel::PAY_ALL) {
//        $str = '';
//    }
//
//    // 20首付
//    if ($pay_type == \Home\Model\OrderModel::PAY_PART) {
//        if ($oi_status > 2) {
//            $str = '已结利息';
//        }
//        else {
//            $day = getPastDay($order);
//            $str = $order['o_pay_t'] * $rate * $day;
//        }
//    }
//    return $str;
//}

// 新可结利息
function getKnotNew($order) {
    $pay_type = $order['o_pay_type'];
    $rate = C('DAY_RATE');
    $status = $order['o_status'];
    // 全付
    if ($pay_type == \Home\Model\OrderModel::PAY_ALL) {
        $str = '';
    }

    // 20首付
    if ($pay_type == \Home\Model\OrderModel::PAY_PART) {
        if ($status > 2) {
            $str = '已结利息';
        }
        else {
            $day = getPastDay($order);
            $str = $order['o_pay_t'] * $rate * $day;
        }
    }
    return $str;
}

function getSumKnot($order_item) {
    $pay = 0;
    if (!empty($order_item) && is_array($order_item)) {
        foreach ($order_item as $item) {
            $pay += $item['oi_knot'];
        }
    }

    return $pay;
}
//已成交天数
function getPastDay($order) {
    $today = strtotime(date('Y-m-d',time()));
    $rtimeDay = strtotime(date("Y-m-d", $order['o_dtime']));

    $days = ($today - $rtimeDay) / 86400 + 1;

    return $days;
}

// 尾款计息
function getOrderInteT($order, $order_item) {
    $days = getPastDay($order);
    $pay_t = getOrderT($order_item);
    return formatMoney($days * $order['o_rate'] * $pay_t);
}

//已结回款  利息 总数
function alreadyPay($billItem, $m = 'bi_rpay') {
    $finish_sell = $billItem['finish_sell'];
    $over_sell = $billItem['over_sell'];
    $pay = 0;
    if (!empty($finish_sell) && is_array($finish_sell)) {
        foreach ($finish_sell as $finish) {
            if ($finish['bi_status'] == 9) {
                $pay += $finish[$m] ;
            }
        }
    }

    if (!empty($over_sell) && is_array($over_sell)) {
        foreach ($over_sell as $over) {
            if ($over['bi_status'] == 9) {
                $pay += $over[$m] ;
            }
        }
    }

    return formatMoney($pay);
}

//待结回款  利息 总数
function waitPay($billItem, $m = 'bi_rpay') {
    $finish_sell = $billItem['finish_sell']; // 已成交的货组的 - 待结回款
    $pay = 0;
    if (!empty($finish_sell) && is_array($finish_sell)) {
        foreach ($finish_sell as $finish) {
            if ($finish['bi_status'] == 8) {
                $pay += $finish[$m] ;
            }
        }
    }
    return formatMoney($pay);
}

// 未结
function notPay($billItem) {
    $wait_sell = $billItem['wait'];
    $pay = 0;
    if (!empty($wait_sell) && is_array($wait_sell)) {
        foreach ($wait_sell as $wait) {
            if ($wait['bi_status'] < 8) {
                $pay += $wait['bi_rpay'] ;
            }
        }
    }

    $finish_sell = $billItem['finish_sell'];
    if (!empty($finish_sell) && is_array($finish_sell)) {
        foreach ($finish_sell as $finish) {
            if ($finish['bi_status'] < 8) {
                $pay += $finish['bi_rpay'] ;
            }
        }
    }

    $on_sell = $billItem['on_sell'];
    if (!empty($on_sell) && is_array($on_sell)) {
        foreach ($on_sell as $on) {
            if ($on['bi_status'] < 8) {
                $pay += $on['bi_rpay'] ;
            }
        }
    }

    return formatMoney($pay);
}

//处理价格
function formatMoney($number) {
    return str_replace('.00', '', number_format(round($number, 2), 2));
}


/**
 * 获取保证金
 * @param $b_id
 * @param int $status  2已退  1待退
 * @return int
 */
function getAllDepo($b_id, $status = 2, $bi_status = 0) {
    $bill_item_list = M('s_bill_item')->where(array('b_id' => $b_id))->select();
    $money = 0;

    // 其中可退的保证金
    if ($bi_status == 8) {
        if (!empty($bill_item_list) && is_array($bill_item_list)) {
            foreach ($bill_item_list as $item) {
                if ($item['bi_status'] == 8) {
                    if ($item['bi_depo_status'] == 1) {
                        $money += $item['bi_depo'];
                    }
                }

            }
        }
        return formatMoney($money);
    }


    if (!empty($bill_item_list) && is_array($bill_item_list)) {
        foreach ($bill_item_list as $item) {
            if ($item['bi_depo_status'] == $status) {
                $money += $item['bi_depo'];
            }
        }
    }


    return formatMoney($money);
}

// 成交货款
function getClinch($bill, $bill_item) {
    $pri1 = $bill['b_pri1'];
    $nwei = $bill_item['bi_nwei'];
    return formatMoney($pri1 * $nwei);
}

// 在售的时候  待退跌价
function getBackMoney($bill, $bill_item) {
    $pri1 = $bill['b_pri1'];
    $nwei = $bill_item['bi_nwei'];
    // 成交货款 - 回款
    $clinck = $pri1 * $nwei;

    return formatMoney($clinck - $bill_item['bi_rpay']);
}

// 待补待退
function getBackMoneyText($bill, $bill_item) {
    $str = '';
    // 算
    if (in_array($bill_item['bi_status'], array(5, 6, 7, 8))) {
        $pri1 = $bill['b_pri1'];
        $nwei = $bill_item['bi_nwei'];
        // 成交货款 - 回款
        $clinck = $pri1 * $nwei;

        $money = $clinck - $bill_item['bi_rpay'];
        if ($money > 0) {
            $str = '退溢价';
        }

        if ($money < 0) {
            $str = '补跌价';
        }

    }

    // 读数据库
    if ($bill_item['bi_status'] == 9) {
        if ($bill_item['bi_diff'] > 0) {
            $str = '退溢价';
        }

        if ($bill_item['bi_diff'] < 0) {
            $str = '补跌价';
        }
    }
    return $str;
}

// order 尾款
function getOrderT($order_item, $status = 0) {
    $pay = 0;
    if (!empty($order_item) && is_array($order_item)) {
        foreach ($order_item as $item) {
            if ($item['oi_pay_t_status'] == $status) {
                $pay += $item['oi_pay_t'];
            }
        }
    }
    return $pay;
}

// 购物车每组货款
function getItemPay($bill_item, $bill) {
    return $bill['b_pri1'] * $bill_item['bi_nwei'];
}

//总货款
function getItemPayAll($bill_item, $bill) {
    $pay = 0;
    if (!empty($bill_item) && is_array($bill_item)) {
        foreach ($bill_item as $item) {
            $pay += $item['bi_nwei'] * $bill['b_pri1'];
        }
    }
    return $pay;
}

// 由港id称获取港口名称
function getPortName($port_id) {
    $name = '';
    if ($port_id) {
        $name = M('sys_port')->where(array('bp_id' => $port_id))->getField('bp_name');
    }
    return $name;
}

// 当前日期
function getDay() {
    return date('Y-m-d', time());
}