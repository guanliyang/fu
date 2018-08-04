<?php
namespace Home\Controller;

class CartController extends HomeController {
    // 进入订单结算
    public function finish() {
        $car = new \Home\Model\CartModel();
        $bill = $car->finish();
        dump($bill);

        $this->display();
    }

    // 选择卖单附属
    public function choseBiId() {
        $car = new \Home\Model\CartModel();
        $bi_id_str = $car->choseBiId();
        notice('成功', 0, array('url' => '/Home/Cart/finish?bi_id_str='.$bi_id_str));
    }

    // 添加到购物车
    public function ajaxAdd() {
        $cart = new \Home\Model\CartModel();
        $cart->addCart($this->user['id']);
    }

    //购物车列表
    public function index() {
        $cart = new \Home\Model\CartModel();
        $list = $cart->getByUid($this->user['id']);
        dump($list);
        $this->assign('list', $list);
        $this->display();
    }
}