<?php
namespace Home\Controller;

class OrderController extends HomeController {
    // 进入订单结算
    public function add() {
        $order = new \Home\Model\OrderModel();
        $order->addOrder();
        notice("success");
    }

}
