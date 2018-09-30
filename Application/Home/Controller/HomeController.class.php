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
            $this->user = M('sys_user')->find($uid);
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

    // 产地
    public function getC($pid = '', $cid = '', $prefix = 'c_') {
        $province = M('local_area')->where(array('level' => 1))->select();
        $this->assign($prefix.'province', $province);

        // 选中市
        $pro_key = 0;
        if ($province) {
            foreach ($province as $key => $value) {
                if ($pid == $value['id']) {
                    $pro_key = $key;
                }
            }
        }
        $city = M('local_area')->where(array('parentId' => $province[$pro_key]['id']))->select();
        $this->assign($prefix.'city', $city);

        //选中区
        $is_in_area = false;
        $city_key = 0;
        if ($city) {
            foreach ($city as $key => $value) {
                if ($cid == $value['id']) {
                    $city_key = $key;
                    $is_in_area = true;
                }
            }
        }
        $area = M('local_area')->where(array('parentId' => $city[$city_key]['id']))->select();
        $this->assign($prefix.'area', $area);
        $this->assign('is_in_area', $is_in_area);
    }

    // 用户地址
    public function getUserAdd($pid = '', $cid = '') {
        $province = M('area')->where(array('level' => 1))->select();
        $this->assign('province', $province);

        // 选中市
        $pro_key = 0;
        if ($province) {
            foreach ($province as $key => $value) {
                if ($pid == $value['id']) {
                    $pro_key = $key;
                }
            }
        }
        $city = M('area')->where(array('parentId' => $province[$pro_key]['id']))->select();
        $this->assign('city', $city);

        //选中区
        $city_key = 0;
        if ($city) {
            foreach ($city as $key => $value) {
                if ($cid == $value['id']) {
                    $city_key = $key;
                }
            }
        }
        $area = M('area')->where(array('parentId' => $city[$city_key]['id']))->select();
        $this->assign('area', $area);
    }
}
