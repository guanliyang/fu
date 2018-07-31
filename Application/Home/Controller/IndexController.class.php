<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    // 首页登录页面
    public function index(){
        $this->display();
    }

    // 注册视图
    public function registerView() {
        $this->display();
    }

    // 短信发送验证码
    public function ajaxSendSms() {
        $user = new \Home\Model\UserModel();
        $user->ajaxSendSms();
    }

    // 登录
    public function ajaxLogin() {
        $user = new \Home\Model\UserModel();

        // 超过5次 电话验证码登录
        $input_password_num = cookie('input_password_num');
        if ($input_password_num > 5) {
            notice('密码输入错误超过5次', 2, array('url' => '/Home/Index/mobileLogin'));
        }

        $user->ajaxLogin();
        notice('登录成功', 0, array('url' => '/Home/Message/index'));
    }

    //电话验证码登录
    public function mobileLogin() {
        $this->display();
    }

    // 电话验证码登录
    public function ajaxMobileLogin() {
        $user = new \Home\Model\UserModel();
        $user->mobileLogin();
        redirect('/Home/Message/index');
    }

    // 注册
    public function register() {
        $user = new \Home\Model\UserModel();
        $user->register();
        notice('注册成功', 0, array('url' => '/Home/Index/registerSuccessView'));
    }

    // 注册成功
    public function registerSuccessView() {
        $this->display();
    }
}