<?php
namespace Home\Controller;

class OfferController extends HomeController {
    // 线上 预约购粮 列表
    public function offerList() {
        $this->putG();

        $this->display();
    }

    public function addOffer() {
        $this->putG();
        $this->display();
    }
    // 提交预约信息
    public function ajaxAddOffer() {
        $offer = new \Home\Model\ROfferModel();
        $status = $offer->addOffer($this->user['id']);
        if ($status) {
            notice('成功', 0, array('url' => '/Home/Offer/offerInfo?f_id='.$status));
        }
        else {
            notice('写入出错!');
        }
    }

    public function offerInfo() {
        $offer = new \Home\Model\ROfferModel();
        $info = $offer->getInfo();
        $this->assign('info', $info);
        $this->display();
    }
}
