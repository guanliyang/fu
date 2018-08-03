<?php
namespace Home\Model;
use Think\Model;
class SysMsgModel extends Model {
    protected $trueTableName = 'sys_msg';
    const IS_READ = 1;
    const NOT_READ = 0;
    public function getMsg($uid) {
        $read_list = self::where(array(
            'u_id' => $uid,
            'sm_status' => self::IS_READ
        ))->select();

        $not_read_list = self::where(array(
            'u_id' => $uid,
            'sm_status' => self::NOT_READ
        ))->select();

        return array(
            'read_list' => $read_list,
            'not_read_list' => $not_read_list
        );
    }
}