<?php
namespace Home\Model;
class SBillItemModel extends HomeModel {
    protected $trueTableName = 's_bill_item';

    const STATUS_DEL = -9;
    const STATUS_ON = 9;
    const STATUS_CHECK = 0;
    const STATUS_FINISH = 10;

    // bi_id_str 获取总价格
    public function getPrice($bill) {

        $all_price = 0;
        if (!empty($bill) && is_array($bill)) {
            foreach ($bill as $b) {
                $bill_item_list = $b['bill_item'];
                if (!empty($bill_item_list) && is_array($bill_item_list)) {
                    foreach ($bill_item_list as $bill_item) {
                        $all_price += $bill_item['bi_nwei'] * $b['b_pri1'];
                    }
                }
            }
        }

        return $all_price;
    }

    // 获取单条详细内容
    public function getInfo() {
        $bi_id = I('request.bi_id');
        if (empty($bi_id)) {
            $this->noticeView('货组编号不能为空');
        }
        $bill_item = self::where(array('bi_id' => $bi_id))->find();
        if (empty($bill_item)) {
            $this->noticeView('货组编号不存在');
        }

        $bill = M('s_bill')->where(array('b_id' => $bill_item['b_id']))->find();
        if ($bill['u_id'] != $this->getModelUid()) {
            $this->noticeView('此货组不属于您');
        }

        if ($bill_item['bi_status'] < 0) {
            $this->noticeView('此货组已删除');
        }

        $order_item = array();
        if ($bill_item['bi_status'] > 1) {
            $order_item = M('b_order_item')->where(array('bi_id' => $bi_id))->order('oi_id desc')->find();
        }

        return array(
            'bill_item' => $bill_item,
            'order_item' => $order_item,
            'bill' => $bill
        );
    }

    // 由bi_id_list  获取
    public function getBidList($bi_id_list) {
        $data = array();
        if (is_array($bi_id_list) && is_array($bi_id_list)) {
            foreach ($bi_id_list as $bi_id) {
                $bill_item = self::where(array('bi_id' => $bi_id))->find();
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
}