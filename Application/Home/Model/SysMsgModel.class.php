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


    public function getNotReadCount($uid) {
        $where = array(
            'u_id' => $uid,
            'sm_status' => self::NOT_READ
        );
        $count = self::where($where)->count();
        return $count;
    }
    //未读
    public function getMsgNotRead($uid) {
        $where = array(
            'u_id' => $uid,
            'sm_status' => self::NOT_READ
        );
        $count = self::where($where)->count();

        $page = $this->getPageShow($count);

        $list = self::where($where)->order('sm_id desc')->limit($page['str'])->select();
        $total_page = intval($count / $this->limit) + 1;
        return array(
            'list' => $list,
            'page' => $page['show'],
            'total_page' => $total_page
        );
    }

    // 已读
    public function getMsgIsRead($uid) {
        $where = array(
            'u_id' => $uid,
            'sm_status' => self::IS_READ
        );
        $count = self::where($where)->count();
        $page       = $page = $this->getPageShow($count);
        $list = self::where($where)->order('sm_id desc')->limit($page['str'])->select();

        $total_page = intval($count / $this->limit) + 1;
        return array(
            'list' => $list,
            'page' => $page['show'],
            'total_page' => $total_page
        );
    }
}