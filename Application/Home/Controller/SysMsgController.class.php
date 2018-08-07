<?php
namespace Home\Controller;

class SysMsgController extends HomeController {
    // 系统消息
    public function index() {
        $msg = new \Home\Model\SysMsgModel();
        $list = $msg->getMsgNotRead($this->user['id']);

        $this->assign('data', $list);
        $this->display();
    }

    public function is_read() {
        $msg = new \Home\Model\SysMsgModel();
        $list = $msg->getMsgIsRead($this->user['id']);

        $this->assign('data', $list);
        $this->assign('is_read', 1);
        $this->display('index');
    }
}
