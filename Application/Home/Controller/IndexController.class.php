<?php
// 本类由系统自动生成，仅供测试用途
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
        $user->ajaxLogin();
        redirect('/Home/Message/index');
    }

    // 注册
    public function register() {
        $user = new \Home\Model\UserModel();
        $user->register();
        redirect('/Home/Index/registerSuccessView');
    }

    // 注册成功
    public function registerSuccessView() {
        $this->display();
    }
}
