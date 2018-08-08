<?php
namespace Home\Controller;

class OrderController extends HomeController {
    // 进入订单结算
    public function add() {
        $order = new \Home\Model\OrderModel();
        $order->addOrder($this->user['id']);
        notice('生成订单成功');
    }

    public function info() {
        notice('order info');
    }
}
