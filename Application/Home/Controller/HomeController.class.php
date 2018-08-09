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
        if (empty($uid)) {
            redirect("/index.php");
        }
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
}
