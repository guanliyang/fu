<?php
namespace Home\Model;
use Think\Model;
class CartModel extends Model {
    protected $trueTableName = 'b_cart';

    const STATUS_DEL = -9;
    const STATUS_NORMAL = 1;
    const STATUS_FORMAL = 9;

    //查询购物车
    public function getByUid($uid) {
        $list = self::where(array(
            'u_id' => $uid,
            'c_status' => self::STATUS_NORMAL
        ))->select();
        $list = $this->changeList($list);
        return $list;
    }

    // 获取货物详细信息
    private function changeList($list) {
        $data = array();
        dump($list);
        if (!empty($list) && is_array($list)) {
            foreach ($list as $key => $cart) {
                $data = M('s_bill_item')->where(array('bi_id' => $cart['bi_id']))->find();
            }
        }

        return $data;
    }

    // 添加到购物车
    public function addCart($uid) {
        $data['bi_id'] = $this->getBiId();
        $data['u_id'] = $uid;
        $data['c_ctime'] = time();
        $data['c_status'] = self::STATUS_NORMAL;
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