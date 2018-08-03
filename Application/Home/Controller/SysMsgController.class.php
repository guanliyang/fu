<?php
namespace Home\Controller;

class SysMsgController extends HomeController {
    // 系统消息
    public function index() {
        $msg = new \Home\Model\SysMsgModel();
        $list = $msg->getMsg($this->user['id']);
        dump($list);
        $this->display();
    }

}
