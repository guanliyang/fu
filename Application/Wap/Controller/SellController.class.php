<?php
namespace Wap\Controller;

class SellController extends HomeController {
    // 在售粮源
    public function sellBillList() {
        $this->putG();

        $SBill = new \Home\Model\SBillModel();
        $info = $SBill->getOnLineList();
        $this->assign('info', $info);
        $this->display();

    }

    // ajax 分页 获取售粮详情
    public function ajaxGetPageSellBillList() {
        $SBill = new \Home\Model\SBillModel();
        $info = $SBill->getOnLineList();
        $list = $info['list'];
        $list = $this->ajaxChangeBillList($list);
        message($list);
    }

    private function ajaxChangeBillList($list) {
        $str = '';
        if (!empty($list) && is_array($list)) {
            foreach ($list as $bill) {
                $str .= '<div class="list" onclick="location.href=\'/Wap/Sell/onLineBillInfo/b_id/'.$bill['b_id'].'\'">
        <div class="info1">'.$bill['b_year'].'年 '.$bill['b_place'].' '.$bill['b_weig'].'吨<h3>'.formatMoney($bill['b_pri1']).'元/吨</h3></div>
        <div class="info2"><label>容重'.$bill['b_rz'].'g/l</label><label>霉变'.$bill['b_mb'].'%</label><label>水份'.$bill['b_sf'].'%</label></div>
        <div class="info2"><label>杂质'.$bill['b_zz'].'%</label><label>呕吐毒素'.$bill['b_ot'].'μg/kg</label></div>
    </div>';
            }
        }
        return $str;
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
        // 代入港口
        $port = M('sys_port')->where(array('bp_status' => 1))->select();
        $this->assign('port', $port);
        // 修改 卖粮信息
        $b_id = I('request.b_id');
        $bill = array();
        if ($b_id) {
            $bill = M('s_bill')->where(array('b_id' => $b_id))->find();
        }
        $this->assign('bill', $bill);

        $this->display();
    }

    // 添加卖货信息
    public function addBill() {
        $SBill = new \Home\Model\SBillModel();
        $b_id = $SBill->ajaxAdd($this->getUid());

        if ($b_id) {
            notice('添加成功', 0, array('url' => '/Wap/Sell/sellBillInfo?b_id='.$b_id));
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
            notice('修改成功', 0, array('url' => '/Wap/Sell/sellBillInfo/b_id/'.$b_id));
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
        $bill_item = new \Home\Model\SBillModel();
        $status = $bill_item->del();
        if ($status) {
            notice('修改成功', 0, array('url' => '/Wap/Message/index?item=3'));
        }
        else {
            notice('未修改');
        }
    }
}
