<?php
namespace Home\Controller;

class MessageController extends HomeController {
    public function index() {
        $user = new \Home\Model\UserModel();
        $info = $user->getMessageForWeb($this->user['id']);
        $this->assign('info', $info);
        $this->display();
    }
}
