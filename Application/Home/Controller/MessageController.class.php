<?php
namespace Home\Controller;

class MessageController extends HomeController {
    public function index() {
        $this->checkoutLogin();
        echo "我登录了";
    }
}
