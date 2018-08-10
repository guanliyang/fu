<?php
namespace Home\Controller;

class OrderController extends HomeController {
    // 进入订单结算
    public function add() {
        $order = new \Home\Model\OrderModel();
        $o_id = $order->addOrder($this->user['id']);
        notice('生成订单成功', 0, array('url'=>'/Home/Order/info/o_id/'.$o_id));
    }

    public function info() {
        $this->display();
    }
}
