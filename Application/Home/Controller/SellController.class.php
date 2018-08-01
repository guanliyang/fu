<?php
namespace Home\Controller;

class SellController extends HomeController {

    // 卖粮页面
    public function sellBill() {
        $this->assign('place', M('g_place')->select());
        $this->assign('class', M('g_class')->select());
        $this->assign('level', M('g_level')->select());
        $this->assign('rz', M('g_rz')->select());
        $this->assign('year', M('g_year')->select());
        $this->display();
    }

    // 添加卖货信息
    public function addBill() {
        $SBill = new \Home\Model\SBillModel();

        if ($SBill->ajaxAdd($this->user['id'])) {
            notice('添加成功', 0, array('url' => '/Home/Sell/sellBillInfo'));
        }
    }

    public function sellBillInfo() {
        $SBill = new \Home\Model\SBillModel();
        $info = $SBill->getInfo();
        dump($info);
        $this->assign('SBill', $info);
        $this->display();
    }
}
