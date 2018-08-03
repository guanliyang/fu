<?php
namespace Home\Controller;

class OfferController extends HomeController {
    // 预约购粮首页
    public function index() {
        $this->assign('place', M('g_place')->select());
        $this->assign('class', M('g_class')->select());
        $this->assign('level', M('g_level')->select());
        $this->assign('rz', M('g_rz')->select());
        $this->assign('year', M('g_year')->select());
        $this->display();
    }

    // 提交预约信息
    public function addOffer() {
        notice('还没写好');
    }
}
