<?php
namespace Home\Model;
use Think\Model;
class SysMsgModel extends Model {
    protected $trueTableName = 'sys_msg';
    const IS_READ = 1;
    const NOT_READ = 0;

    protected $limit = 1;

    public function getMsgNotRead($uid) {
        $where = array(
            'u_id' => $uid,
            'sm_status' => self::NOT_READ
        );
        $count = self::where($where)->count();

        $Page       = new \Think\Page($count, $this->limit);
        $show       = $Page->show();

        $not_read_list = self::where($where)->limit($Page->firstRow.','.$Page->listRows)->select();

        return array(
            'list' => $not_read_list,
            'not_read_list_count' => $count,
            'page' => $show
        );
    }

    public function getMsgIsRead($uid) {
        $where = array(
            'u_id' => $uid,
            'sm_status' => self::IS_READ
        );
        $read_list = self::where($where)->select();
        $count = self::where($where)->count();

        $Page       = new \Think\Page($count, $this->limit);
        $show       = $Page->show();


        $not_read_list_count = self::where(array(
            'u_id' => $uid,
            'sm_status' => self::NOT_READ
        ))->count();

        return array(
            'list' => $read_list,
            'not_read_list_count' => $not_read_list_count,
            'page' => $show
        );
    }
}