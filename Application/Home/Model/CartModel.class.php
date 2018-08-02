<?php
namespace Home\Model;
use Think\Model;
class CartModel extends Model {
    protected $trueTableName = 'b_cart';

    public function addCart($uid) {
        $data['bi_id'] = $this->getBiId();
        $data['u_id'] = $uid;
        return self::data($data)->add();
    }

    // 获取bid
    private function getBiId() {
        $bi_id = I('request.bi_id');
        if (empty($bi_id)) {
            notice('bi_id为空');
        }
        $billItem = M('s_bill_item')->where(array('bi_id' => $bi_id))->find();
        if (empty($billItem)) {
            notice('bi_id有误');
        }

        if ($billItem['bi_status'] != SBillItemModel::STATUS_ON) {
            notice($bi_id. '- 此订单不是在售状态, 请重新选择');
        }

        return $bi_id;
    }
}