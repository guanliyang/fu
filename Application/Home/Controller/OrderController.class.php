<?php
namespace Home\Controller;

class OrderController extends HomeController {
    // 进入订单结算
    public function add() {
        $order = new \Home\Model\OrderModel();
        $o_id = $order->addOrder($this->getUid());
        notice('生成订单成功', 0, array('url'=>'/Home/Order/info/o_id/'.$o_id));
    }

    // 订单详情
    public function info() {
        $this->checkoutUserLogin();
        $order = new \Home\Model\OrderModel();
        $info = $order->getInfo();
        dump($info);
        $this->assign('info', $info);
        $this->display();
    }


    // 订单 bill 详情
    public function billInfo() {
        $this->checkoutUserLogin();
        $order = new \Home\Model\OrderModel();
        $info = $order->getBillInfo();

        $this->assign('info', $info);
        $this->display();
    }

    // 订单 item 货组详情
    public function billItemInfo() {
        $this->checkoutUserLogin();
        $order = new \Home\Model\OrderModel();
        $info = $order->getBillItemInfo();

        $this->assign('info', $info);
        $this->display();
    }
}
