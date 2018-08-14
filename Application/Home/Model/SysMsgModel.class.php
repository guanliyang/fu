<?php
namespace Home\Model;
class SysMsgModel extends HomeModel {
    protected $trueTableName = 'sys_msg';
    const IS_READ = 1;
    const NOT_READ = 0;

    // 消息类型声明 order
    const TYPE_ORDER = 0;
    // bill
    const TYPE_BILL = 1;
    //offer
    const TYPE_OFFER = 2;

    protected $limit = 1;

    public function getMsgNotRead($uid) {
        $where = array(
            'u_id' => $uid,
            'sm_status' => self::NOT_READ
        );
        $count = self::where($where)->count();

        $page = $this->getPageShow($count);

        $not_read_list = self::where($where)->limit($page['str'])->select();

        return array(
            'list' => $not_read_list,
            'not_read_list_count' => $count,
            'page' => $page['show'],
        );
    }

    public function getMsgIsRead($uid) {
        $where = array(
            'u_id' => $uid,
            'sm_status' => self::IS_READ
        );
        $count = self::where($where)->count();
        $page       = $page = $this->getPageShow($count);
        $read_list = self::where($where)->limit($page['str'])->select();


        $not_read_list_count = self::where(array(
            'u_id' => $uid,
            'sm_status' => self::NOT_READ
        ))->count();

        return array(
            'list' => $read_list,
            'not_read_list_count' => $not_read_list_count,
            'page' => $page['show']
        );
    }
}