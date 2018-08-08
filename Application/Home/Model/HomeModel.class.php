<?php
namespace Home\Model;
use Think\Model;
class HomeModel extends Model {
    public function checkContract() {
        $contract = I('request.contract', 0);
        if (empty($contract)) {
            notice('请仔选中阅读合同');
        }
    }

    // 检查 bi_id_str 的合法性
    public function checkBiIdStr($bi_id_str) {
        $bi_id_list = explode(',', $bi_id_str);
        if (empty($bi_id_list) || !is_array($bi_id_list)) {
            notice('bi_id_str 不能为空');
        }

        foreach ($bi_id_list as $bi_id) {
            $bill_item = M('s_bill_item')->where(array('bi_id' => $bi_id))->find();
            if (empty($bill_item)) {
                notice('bi_id='.$bi_id.' 有误');
            }

            if ($bill_item['bi_status'] != SBillItemModel::STATUS_ON) {
                notice('bi_id='.$bi_id.' 有误, 可能已被购买,请到购物车重新选择');
            }
        }

        return $bi_id_list;
    }
}