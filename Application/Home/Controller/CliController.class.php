<?php
namespace Home\Controller;
use Think\Controller;
class CliController extends Controller{
    public function test1() {
        $msg = date('Y-m-d H:i:s')."\n";
        file_put_contents(PATH.'/test/a.log', $msg, FILE_APPEND);
    }

//    public function updateOrder() {
//        $order_list = M('b_order')->where('o_artime IS NOT NULL AND o_artime < '.time().' AND o_status = 7')->select();
//        if ($order_list && is_array($order_list)) {
//            foreach ($order_list as $order) {
//                if (!empty($order['o_artime']) &&
//                    $order['o_artime'] < time() &&
//                    $order['o_status'] == 7 ){
//                    M('b_order')->where(array('o_id' => $order['o_id']))->save(array('o_status' => 9));
//                }
//            }
//        }
//    }

    public function updateOrder()
    {
        // (订单货组 状态为1，同时最晚收货时间不为空，同时小于当前时间），状态更新为2
        $where_item = 'oi_status=1 AND oi_artime IS NOT NULL AND oi_artime < '.time();
        $order_item_list = M('b_order_item')->where($where_item)->select();

        if (!empty($order_item_list) && is_array($order_item_list)) {
            foreach ($order_item_list as $item) {
                M('b_order_item')->where(array('oi_id' => $item['oi_id']))->save(array('oi_status' => 2));
            }
        }

        //表b_order 条件：o_status=7 AND 订单对应货组，全部货组状态oi_status=2时，更新订单状态为9
        $where_order = 'o_status=7';
        $order_list = M('b_order')->where($where_order)->select();

        if (!empty($order_list) && is_array($order_list)) {
            foreach ($order_list as $order) {
                $all_count = M('b_order_item')->where('o_id='.$order['o_id'])->count();
                $status_count = M('b_order_item')->where('o_id='.$order['o_id'].' AND oi_status=2')->count();

                // 等于2的数量相同，证明都等于2
                if ($all_count && $status_count && $all_count == $status_count) {
                    M('b_order')->where(array('o_id' => $order['o_id']))->save(array('o_status' => 9));
                }
            }
        }

    }
}
