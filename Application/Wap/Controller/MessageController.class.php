<?php
namespace Wap\Controller;

class MessageController extends HomeController {
    public function index() {
        $this->checkoutUserLogin();
        $user = new \Home\Model\UserModel();
        $info = $user->getMessageForWeb($this->getUid());
        $this->assign('info', $info);
        $this->display();
    }
}
