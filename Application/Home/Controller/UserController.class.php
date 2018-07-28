<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    public function ajaxSendSms() {
        $User = new \Home\Model\UserModel();
        $User->ajaxSendSms();
    }

    public function login() {
        $User = new \Home\Model\UserModel();
        $User->ajaxLogin();
    }
}
