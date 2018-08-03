<?php
namespace Home\Controller;

class CartController extends HomeController {
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
        $this->display();
    }
}
