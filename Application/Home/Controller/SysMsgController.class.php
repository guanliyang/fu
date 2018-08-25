<?php
namespace Home\Controller;

class SysMsgController extends HomeController {
    public function _initialize() {
        parent::_initialize();
        $this->checkoutUserLogin();

        $msg = new \Home\Model\SysMsgModel();
        $count = $msg->getNotReadCount($this->getUid());
        $this->assign('count', $count);
    }
    // 系统消息
    public function index() {
        $msg = new \Home\Model\SysMsgModel();
        $list = $msg->getMsgNotRead($this->getUid());

        $this->assign('data', $list);
        $this->display();
    }

    public function is_read() {
        $msg = new \Home\Model\SysMsgModel();
        $list = $msg->getMsgIsRead($this->getUid());

        $this->assign('data', $list);
        $this->assign('is_read', 1);
        $this->display('index');
    }
}
