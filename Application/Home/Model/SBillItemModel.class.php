<?php
namespace Home\Model;
class SBillItemModel extends HomeModel {
    protected $trueTableName = 's_bill_item';

    const STATUS_DEL = -9;
    const STATUS_ON = 9;
    const STATUS_CHECK = 0;
    const STATUS_FINISH = 10;

    public function getPrice($bi_id_str) {
        $bi_id_list = $this->checkBiIdStr($bi_id_str);
        $all_price = 0;
        foreach ($bi_id_list as $bi_id) {
            $bill_item = M('s_bill_item')->where(array('bi_id' => $bi_id))->find();
            $all_price += $bill_item['bi_dpay'];
        }
        return $all_price;
    }

    public function getInfo() {
        $bi_id = I('request.bi_id');
        return self::where(array('bi_id' => $bi_id))->find();
    }
}