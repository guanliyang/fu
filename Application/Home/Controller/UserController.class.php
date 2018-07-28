<?php
namespace Home\Controller;
class UserController extends HomeController {
    // 短信发送验证码
    public function ajaxSendSms() {
        $user = new \Home\Model\UserModel();
        $user->ajaxSendSms();
    }

    // 登录
    public function ajaxLogin() {
        $user = new \Home\Model\UserModel();
        $user->ajaxLogin();
        redirect('/Home/Message/index');
    }

    // 密码重置
    public function changePasswordView() {
        $this->checkoutLogin();
        $this->display();
    }

    // 用户详细信息
    public function userView() {
        $this->checkoutLogin();
        $this->display();
    }

    // 注册视图
    public function registerView() {
        $this->display();
    }

    // 注册
    public function register() {
        $user = new \Home\Model\UserModel();
        $user->register();
        redirect('/Home/User/registerSuccessView');
    }

    public function registerSuccessView() {
        $this->display();
    }
}
