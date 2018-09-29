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
        $this->checkoutUserLogin();
        $bill = new \Home\Model\SBillModel();
        $info = $bill->getOnLineBillInfo($this->getUid());

        $this->assign('info', $info);
        $this->display();
    }

    // 卖粮页面
    public function sellBill() {
        $this->checkoutUserLogin();
        $this->putG();
        $this->assign('user', $this->user);


        // 代入港口
        $port = M('sys_port')->where(array('bp_status' => 1))->select();
        $this->assign('port', $port);
        // 修改 卖粮信息
        $b_id = I('request.b_id');
        $bill = '';
        if ($b_id) {
            $bill = M('s_bill')->where(array('b_id' => $b_id))->find();
            $this->getC($bill['c_province_id'], $bill['c_city_id']);
            // 传此参数时,是装货地址
            $this->getC($bill['z_province_id'], $bill['z_city_id'], '');
        }
        else {
            // 传此参数时,是装货地址
            $this->getC();
            $this->getC($this->user['prov_id'], $this->user['city_id'], '');

        }
        $this->assign('bill', $bill);

        $this->display();
    }

    // 添加卖货信息
    public function addBill() {
        $SBill = new \Home\Model\SBillModel();
        $b_id = $SBill->ajaxAdd($this->getUid(), $this->user);

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
    // 删除
    public function del() {
        $this->getUid();
        $bill_item = new \Home\Model\SBillModel();
        $status = $bill_item->del();
        if ($status) {
            notice('修改成功', 0, array('url' => '/Home/Message/index?item=3'));
        }
        else {
            notice('未修改');
        }
    }
}
