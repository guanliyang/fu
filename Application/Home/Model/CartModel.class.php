<?php
namespace Home\Model;
use Think\Model;
class CartModel extends Model {
    protected $trueTableName = 'b_cart';

    const STATUS_DEL = -9;
    const STATUS_NORMAL = 1;
    const STATUS_FORMAL = 9;

    // 订单结算
    public function finish() {
        $bi_id_str = I('get.bi_id_str');
        $bi_id_list = explode(',', $bi_id_str);
        // 由于是url传输过来的，做二次判断
        $this->choseBiIdStr($bi_id_list);

        $data = array();
        foreach ($bi_id_list as $bi_id) {
            $bill_item = M('s_bill_item')->where(array('bi_id' => $bi_id))->find();
            $b_id = $bill_item['b_id'];
            $s_bill = M('s_bill')->where(array('b_id' => $b_id))->find();

            // 父
            if (empty($data[$b_id])) {
                $data[$b_id] = $s_bill;
            }

            // 子
            $data[$b_id]['bill_item'][] = $bill_item;
        }
        return $data;
    }

    // 选择跳转
    public function choseBiId() {
        $bi_id_list = I('bi_id');

        return $this->choseBiIdStr($bi_id_list);
    }

    // 判断id是否合法
    private function choseBiIdStr($bi_id_list) {
        if (empty($bi_id_list)) {
            notice('请勾选货物');
        }
        return implode(',', $bi_id_list);
    }

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
        if (!empty($list) && is_array($list)) {
            foreach ($list as $key => $cart) {
                $bill_item = M('s_bill_item')->where(array('bi_id' => $cart['bi_id']))->find();
                $b_id = $bill_item['b_id'];
                $s_bill = M('s_bill')->where(array('b_id' => $b_id))->find();

                // 父
                if (empty($data[$b_id])) {
                    $data[$b_id] = $s_bill;
                }

                // 子
                $data[$b_id]['bill_item'][] = $bill_item;
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