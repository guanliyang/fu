<?php
namespace Home\Controller;
use Think\Controller;
class CliController extends Controller{
    public function test1() {
        $msg = date('Y-m-d H:i:s')."\n";
        file_put_contents(PATH.'/test/a.log', $msg, FILE_APPEND);
    }

    public function updateOrder() {
        $order_list = M('b_order')->where('o_artime IS NOT NULL AND o_artime < '.time().' AND o_status = 7')->select();
        if ($order_list && is_array($order_list)) {
            foreach ($order_list as $order) {
                if (!empty($order['o_artime']) &&
                    $order['o_artime'] < time() &&
                    $order['o_status'] == 7 ){
                    M('b_order')->where(array('o_id' => $order['o_id']))->save(array('o_status' => 9));
                }
            }
        }
    }
}
