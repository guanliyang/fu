<?php
namespace Home\Controller;

class SellController extends HomeController {
    // 在售粮源
    public function sellBillList() {
        $this->putG();

        $SBill = new \Home\Model\SBillModel();
        $info = $SBill->getOnLineList();
        $this->assign('info', $info);
        $this->display();

    }

    // 在售粮源详情
    public function onLineBillInfo() {
        $bill = new \Home\Model\SBillModel();
        $info = $bill->getBillInfo(false);

        $this->assign('info', $info);
        $this->display();
    }

    // 卖粮页面
    public function sellBill() {
        $this->checkoutUserLogin();
        $this->putG();
        $this->assign('user', $this->user);

        $province = M('area')->where(array('level' => 1))->select();
        $this->assign('province', $province);

        $this->display();
    }

    // 添加卖货信息
    public function addBill() {
        $SBill = new \Home\Model\SBillModel();
        $b_id = $SBill->ajaxAdd($this->getUid());

        if ($b_id) {
            notice('添加成功', 0, array('url' => '/Home/Sell/sellBillInfo?b_id='.$b_id));
        }
    }

    // 个人中心  卖粮详情
    public function sellBillInfo() {
        $this->checkoutUserLogin();
        $SBill = new \Home\Model\SBillModel();
        $info = $SBill->getBillInfo();
        $this->assign('info', $info);
        $this->display();
    }

    //修改价格 页面
    public function changePrice() {
        $this->checkoutUserLogin();
        $SBill = new \Home\Model\SBillModel();
        $info = $SBill->getBillInfo();
        $this->assign('info', $info);
        $this->display();
    }

    //修改价格操作
    public function ajaxChangePrice() {
        $SBill = new \Home\Model\SBillModel();
        $status = $SBill->changePrice();
        $b_id = I("request.b_id", 0, 'intval');
        if ($status) {
            notice('修改成功', 0, array('url' => '/Home/Sell/sellBillInfo/b_id/'.$b_id));
        }
        else {
            notice('未修改');
        }
    }

    //货组详情
    public function billItemInfo() {
        $this->checkoutUserLogin();
        $bill_item = new \Home\Model\SBillItemModel();
        $info = $bill_item->getInfo();
        $this->assign('info', $info);
        $this->display();
    }
}
