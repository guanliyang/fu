<?php
namespace Home\Controller;

class OfferController extends HomeController {
    // 线上 预约购粮 列表
    public function offerList() {
        $this->putG();
        $SBill = new \Home\Model\ROfferModel();
        $info = $SBill->getOnLineList();
        $this->assign('info', $info);
        $this->display();
    }

    public function addOffer() {
        $this->checkoutUserLogin();
        $this->putG();
        $this->display();
    }
    // 提交预约信息
    public function ajaxAddOffer() {
        $offer = new \Home\Model\ROfferModel();
        $status = $offer->addOffer($this->getUid());
        if ($status) {
            notice('成功', 0, array('url' => '/Home/Offer/offerInfo?f_id='.$status));
        }
        else {
            notice('写入出错!');
        }
    }

    //预购详情
    public function offerInfo() {
        $this->checkoutUserLogin();
        $offer = new \Home\Model\ROfferModel();
        $info = $offer->getInfo();
        $this->assign('info', $info);
        $this->display();
    }

    //取消预购
    public function del() {
        $this->getUid();
        $f_id = I('request.f_id');
        $data = array(
            'f_status' => -9
        );
        $offer = M('r_offer')->where('f_id = '.$f_id)->save($data);

        if ($offer) {
            notice('删除成功', 0, array('url' => '/Home/Message/index/?item=2'));
        }
        else {
            notice('删除出错');
        }
    }
}
