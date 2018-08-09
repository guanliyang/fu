<?php
namespace Home\Model;
use Think\Model;
class OrderItemModel extends Model {
    protected $trueTableName = 'b_order_item';

    public function addList($bi_id_list, $o_id) {
        $data = [];
        foreach ($bi_id_list as $bi_id) {
            $bill_item = M('s_bill_item')->where(array('bi_id'=>$bi_id))->find();
            $data['o_id'] = $o_id;
            $data['bi_id'] = $bi_id;
            $data['oi_dpay'] = $bill_item['bi_dpay'];
            $data['oi_status'] = 0;
            self::data($data)->add();
        }
    }
}