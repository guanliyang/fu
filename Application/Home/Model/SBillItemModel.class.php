<?php
namespace Home\Model;
use Think\Model;
class SBillItemModel extends Model {
    protected $trueTableName = 's_bill_item';

    const STATUS_DEL = -9;
    const STATUS_ON = 9;
    const STATUS_CHECK = 0;
    const STATUS_FINISH = 10;
}