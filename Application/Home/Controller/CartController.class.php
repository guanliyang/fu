<?php
namespace Home\Controller;

class CartController extends HomeController {
    public function ajaxAdd() {
        $cart = new \Home\Model\CartModel();
        $cart->addCart($this->user['id']);
    }
}
