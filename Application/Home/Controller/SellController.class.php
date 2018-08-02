<?php
namespace Home\Controller;

class SellController extends HomeController {
    // 在售粮源 选择单个加入购物车页面
    public function choseBill() {
        $bill = M('s_bill')->where(array('bi_id' => I('request.id')))->select();
        $billItem = M('s_bill_item')->where(array('bi_id' => I('request.id')))->select();

        dump($bill);
        dump($billItem);
        $this->display();
    }

    // 在售粮源
    public function sellBillList() {
        $SBill = new \Home\Model\SBillModel();
        $list = $SBill->getList();
        dump($list);
        $this->putG();

        $this->assign('list', $list);
        $this->display();
    }

    // 卖粮页面
    public function sellBill() {
        $this->putG();
        $this->display();
    }

    public function putG() {
        $this->assign('place', M('g_place')->select());
        $this->assign('class', M('g_class')->select());
        $this->assign('level', M('g_level')->select());
        $this->assign('rz', M('g_rz')->select());
        $this->assign('year', M('g_year')->select());
    }

    // 添加卖货信息
    public function addBill() {
        $SBill = new \Home\Model\SBillModel();

        if ($SBill->ajaxAdd($this->user['id'])) {
            notice('添加成功', 0, array('url' => '/Home/Sell/sellBillInfo'));
        }
    }

    // 卖粮详情
    public function sellBillInfo() {
        $SBill = new \Home\Model\SBillModel();
        $info = $SBill->getInfo();
        dump($info);
        $this->assign('SBill', $info);
        $this->display();
    }

    //修改价格 页面
    public function changePrice() {
        $this->display();
    }

    //修改价格操作
    public function ajaxChangePrice() {
        $SBill = new \Home\Model\SBillModel();
        $SBill->changePrice();
    }
}
