<?php
namespace Wap\Controller;
use Think\Controller;
class IndexController extends Controller {
    // 密码重置
    public function changePasswordView() {
        $this->display();
    }

    // 设置新密码
    public function changePassword() {
        $user = new \Home\Model\UserModel();
        $user->changePassword();
        notice('', 2, array('url' => '/Wap'));
    }

    // 首页登录页面
    public function index(){
        if ($uid = session('uid')) {
            //买
            $order = M('b_order')->where(array('u_id' => $uid))->order('o_ctime desc')->find();
            $order_time = 0;
            if (!empty($order)) {
                $order_time = $order['o_ctime'];
            }

            // 预约
            $offer = M('r_offer')->where(array('u_id' => $uid))->order('f_id desc')->find();
            $offer_time = 0;
            if (!empty($offer)) {
                $offer_time = $offer['f_ctime'];
            }

            //卖
            $bill = M('s_bill')->where(array('u_id' => $uid))->order('b_id desc')->find();
            $bill_time = 0;
            if (!empty($bill)) {
                $bill_time = $bill['b_ctime'];
            }

            // 取最大值拿到键值
            $list = array($order_time, $offer_time, $bill_time);
            $key = array_search(max($list), $list);

            $item = $key + 1;
            redirect('/Wap/Message/index?item='.$item);
        }
        $this->display();
    }

    // 注册视图
    public function registerView() {
        $province = M('area')->where(array('level' => 1))->select();
        $this->assign('province', $province);
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
        if ($input_password_num > 4) {
            notice('密码输入错误超过5次', 2, array('url' => '/Wap/Index/mobileLogin'));
        }

        $user->ajaxLogin();
        notice('登录成功', 0, array('url' => '/Wap/Message/index'));
    }

    //电话验证码登录
    public function mobileLogin() {
        $this->display();
    }

    // 电话验证码登录
    public function ajaxMobileLogin() {
        $user = new \Home\Model\UserModel();
        $user->mobileLogin();
        notice('登录成功', 0, array('url' => '/Wap/Message/index'));
    }

    // 注册
    public function register() {
        $user = new \Home\Model\UserModel();
        $user->register();
        notice('注册成功', 0, array('url' => '/Wap/Index/registerSuccessView'));
    }

    // 注册成功
    public function registerSuccessView() {
        $this->display();
    }

    // 退出
    public function logOut() {
        session('uid', null);
        redirect('/');
    }

    // 上传方法
    public function uploadImg() {
        save_file();
    }

    // 返回二级城市列表
    public function getCity() {
        $pId = I('request.province');
        $province = M('area')->where(array('parentId' => $pId))->select();
        $str = '';//'<option>请选择城市</option>';
        if (!empty($province)) {
            foreach ($province as $value) {
                $str .= '<option value="'.$value['id'].' "> '.$value['areaName'].'</option>';
            }
        }

        $area_str = '';
        $area = M('area')->where(array('parentId' => $province[0]['id']))->select();
        if (!empty($area)) {
            foreach ($area as $value) {
                $area_str .= '<option value="'.$value['id'].' "> '.$value['areaName'].'</option>';
            }
        }

        die(json_encode(array('city' => $str, 'area' => $area_str)));
    }

    // 返回三级市区
    public function getArea() {
        $cid = I('request.city');
        $province = M('area')->where(array('parentId' => $cid))->select();
        $str = '';
        if (!empty($province)) {
            foreach ($province as $value) {
                $str .= '<option value="'.$value['id'].' "> '.$value['areaName'].'</option>';
            }
        }
        die(json_encode(array('city' => $str)));
    }
}