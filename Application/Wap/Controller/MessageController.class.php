<?php
namespace Wap\Controller;

class MessageController extends HomeController {
    public function index() {
        $this->checkoutUserLogin();
        $user = new \Home\Model\UserModel();
        $info = $user->getMessageForWeb($this->getUid());

        $this->assign('info', $info);
        $this->display();
    }

    // 卖粮ajax分页
    public function ajaxGetPageBill() {
        // 卖粮货单
        $bill = new \Home\Model\SBillModel();
        $bill = $bill->getUserList($this->getUid());
        $list = $bill['list'];
        $list = $this->ajaxChangeBillList($list);
        message($list);
    }

    // 卖粮分页列表
    private function ajaxChangeBillList($list) {
        $str = '';
        if (!empty($list) && is_array($list)) {
            foreach ($list as $bill) {
                $str .= '<div class="item" onclick="location.href=\'/Wap/Sell/sellBillInfo/b_id/'.$bill['b_id'].'\'">
        <div class="info1">
            '.$bill['b_code'].'<label>'.date("Y/m/d H:i", $bill['b_ctime']).'</label>
        </div>
        <div class="info2">'.$bill['b_name'].'　　'.$bill['b_year'].'年/'.$bill['b_place'].'/'.$bill['b_level'].'　　容重：'.$bill['b_rz'].'g/l</div>
        <div class="info3"><b>'.$bill['b_weig'].'</b>吨　　<b>'.formatMoney($bill['b_pri1']).'</b>元/吨<label><b>'.getMessageById($bill['b_id'], 1).'</b></label></div>
    </div>';
            }
        }
        return $str;
    }


    //ajax分页获取预购列表
    public function ajaxGetPageOffer() {
        $offer = new \Home\Model\ROfferModel();
        $offer = $offer->getUserList($this->getUid());
        $list = $offer['list'];
        $list = $this->ajaxChangeOfferList($list);
        message($list);
    }

    // 预购ajax列表
    private function ajaxChangeOfferList($list) {
        $str = '';
        if (!empty($list) && is_array($list)) {
            foreach ($list as $offer) {
                $str .= '<div class="item" onclick="location.href=\'/Wap/Offer/offerInfo/f_id/'.$offer['f_id'].'\'">
        <div class="info1">
            '.$offer['f_code'].'<label>'.date("Y/m/d H:i", $offer['f_ctime']).'</label>
        </div>
        <div class="info2">'.$offer['f_name'].'　　'.$offer['f_year'].'年/'.$offer['f_place'].'/'.$offer['f_level'].'　　容重：'.$offer['f_rz'].'g/l</div>
        <div class="info3"><b>'.$offer['f_weig'].'</b>吨<label>'.getMessageById($offer['f_id'] ,2).'</label></div>
    </div>';
            }
        }
        return $str;
    }


    // ajax分页获取订单列表
    public function ajaxGetPageOrder() {
        // 买粮订单
        $order = new \Home\Model\OrderModel();
        $order = $order->getUserOrderList($this->getUid());
        $list = $order['list'];

        $list = $this->ajaxChangeOrderList($list);
        message($list);
    }



    // 订单ajax列表
    private function ajaxChangeOrderList($list) {
        $str = '';
        if (!empty($list) && is_array($list)) {
            foreach ($list as $order) {
                $str .= '<div class="item" 
onclick="location.href=\'/Wap/Order/info/o_id/'.$order['o_id'].'\'">
<div class="info1">'.$order['o_code'].'
<label>'.date("Y/m/d H:i", $order['o_ctime']).'</label></div>
<div class="info2">'.$order['bill']['b_name'].'　　
'.$order['bill']['b_year'].'年/
'.$order['bill']['b_place'].'/
'.$order['bill']['b_level'].'　　
容重：'.$order['bill']['b_rz'].'g/l</div>
<div class="info3"><b>'.$order['bill']['all_nwei'].'</b>吨
<b>'.$order['o_pri1'].'</b>元/吨<label><b>'.getMessageById($order['o_id'], 0).'</b></label>
</div></div>';

            }
        }
        return $str;
    }
}
