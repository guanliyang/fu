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
        $list = $this->getMsCode($list);

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
        $list = $this->getMsCode($list);

        $total_page = intval($count / $this->limit) + 1;
        return array(
            'list' => $list,
            'page' => $page['show'],
            'total_page' => $total_page
        );
    }

    // 获取货单号码
    private function getMsCode($list) {
        if (!empty($list) && is_array($list)) {
            foreach ($list as $key => $value) {
                if ($value['sm_type'] == 1) {
                    $list[$key]['code'] = M('r_offer')->where(array('f_id' => $value['sm_rid']))->getField('f_code');
                }
                if ($value['sm_type'] == 2) {
                    $list[$key]['code'] = M('s_bill')->where(array('b_id' => $value['sm_rid']))->getField('b_code');
                }
                if ($value['sm_type'] == "0") {
                    $list[$key]['code'] = M('b_order')->where(array('o_id' => $value['sm_rid']))->getField('o_code');
                }
            }
        }
        return $list;
    }
}