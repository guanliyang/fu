<?php
namespace Home\Controller;
use Home\Model\CartModel;
use Home\Model\SysMsgModel;
use Think\Controller;
class HomeController extends Controller {
    public $user;

    public function _initialize() {
        // 用户信息
        $uid = session('uid');
        if (!empty($uid)) {
            $this->user = M('User')->find($uid);
        }
        $this->assign('user', $this->user);

        //头部信息 系统通知和购物车数量
        $msg_count = M('sys_msg')->where(array('u_id' => $uid, 'sm_status' => SysMsgModel::NOT_READ))->count();
        $cart_count = M('b_cart')->where(array('u_id' => $uid, 'c_status' => CartModel::STATUS_NORMAL))->count();
        $this->assign('msg_count', $msg_count);
        $this->assign('cart_count', $cart_count);
    }

    public function putG() {
        $this->assign('place', M('g_place')->select());
        $this->assign('class', M('g_class')->select());
        $this->assign('level', M('g_level')->select());
        $this->assign('rz', M('g_rz')->select());
        $this->assign('year', M('g_year')->order('gy_id desc')->select());
    }

    public function errorView($message = '') {
        $this->assign('message', $message);
        $this->display('/public/error');
    }

    // 检查是否登录,没登录去登录页面
    public function checkoutUserLogin() {
        if (empty($this->user)) {
            redirect("/");
        }
    }

    // ajax uid
    public function getUid() {
        if (empty($this->user)) {
            notice('您还没有登录, 请点击<会员中心>进行登录');
        }
        return $this->user['id'];
    }
}
