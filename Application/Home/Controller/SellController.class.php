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
        $this->putG();


        $SBill = new \Home\Model\SBillModel();
        $info = $SBill->getList();
dump($info);
        $this->assign('info', $info);
        $this->display();
        //dump($list);

    }

    // 卖粮页面
    public function sellBill() {
        $this->putG();
        $this->assign('user', $this->user);

        $province = M('area')->where(array('level' => 1))->select();
        $this->assign('province', $province);

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
        $b_id = $SBill->ajaxAdd($this->user['id']);

        if ($b_id) {
            notice('添加成功', 0, array('url' => '/Home/Sell/sellBillInfo?b_id='.$b_id));
        }
    }

    // 卖粮详情
    public function sellBillInfo() {
        $SBill = new \Home\Model\SBillModel();
        $info = $SBill->getInfo();
        $this->assign('SBill', $info);
        $this->display();
        dump($info);

    }

    //修改价格 页面
    public function changePrice() {
        $SBill = new \Home\Model\SBillModel();
        $info = $SBill->getInfo();
        $this->assign('SBill', $info);
        $this->display();
    }

    //修改价格操作
    public function ajaxChangePrice() {
        $SBill = new \Home\Model\SBillModel();
        $SBill->changePrice();
    }

    //货组详情
    public function billItemInfo() {
        $bi_id = I('request.bi_id');
        $this->display();
    }
}
