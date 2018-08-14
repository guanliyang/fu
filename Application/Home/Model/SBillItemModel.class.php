<?php
namespace Home\Model;
class SBillItemModel extends HomeModel {
    protected $trueTableName = 's_bill_item';

    const STATUS_DEL = -9;
    const STATUS_ON = 9;
    const STATUS_CHECK = 0;
    const STATUS_FINISH = 10;

    // bi_id_str 获取总价格
    public function getPrice($bi_id_str) {
        $bi_id_list = $this->checkBiIdStr($bi_id_str);
        $all_price = 0;
        foreach ($bi_id_list as $bi_id) {
            $bill_item = M('s_bill_item')->where(array('bi_id' => $bi_id))->find();
            $all_price += $bill_item['bi_dpay'];
        }
        return $all_price;
    }

    // 获取单条详细内容
    public function getInfo() {
        $bi_id = I('request.bi_id');
        return self::where(array('bi_id' => $bi_id))->find();
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