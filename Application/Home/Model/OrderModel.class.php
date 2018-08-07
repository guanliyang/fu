<?php
namespace Home\Model;
use Think\Model;
class OrderModel extends Model {
    protected $trueTableName = 'b_order';

    const STATUS_DEL = -9;
    const STATUS_CHECK = 0;
    const STATUS_FINISH = 10;

    public function addOrder() {
    }
}