<?php
namespace Wap\Controller;

class SysMsgController extends HomeController {
    public function _initialize() {
        parent::_initialize();
        $this->checkoutUserLogin();
    }
    // 系统消息
    public function index() {
        $msg = new \Home\Model\SysMsgModel();
        $not_read_list = $msg->getMsgNotRead($this->getUid());
        $this->assign('not_read', $not_read_list);

        $read_list = $msg->getMsgIsRead($this->getUid());
        $this->assign('read', $read_list);

        $count = $msg->getNotReadCount($this->getUid());
        $this->assign('count', $count);

        $this->display();
    }

    // ajax获取未读列表
    public function ajaxGetPageNotReadMsg() {
        $msg = new \Home\Model\SysMsgModel();
        $list = $msg->getMsgNotRead($this->getUid());
        $list = $this->changeList($list);
        message($list);
    }

    // ajax获取已读列表
    public function ajaxGetPageReadMsg() {
        $msg = new \Home\Model\SysMsgModel();
        $list = $msg->getMsgIsRead($this->getUid());
        $list = $this->changeList($list);
        message($list);
    }

    private function changeList($list) {
        $list = $list['list'];
        $str = '';
        if (!empty($list) && is_array($list)) {
            foreach ($list as $value) {
                $str .= '<div class="msgitem" onclick="location.href=\''.getWapMsgUrl($value).'\'">
        <div class="info1">
            '.getMsgText($value['sm_type']).'：'.$value['sm_rid'].'<label>'.getDateTime($value['sm_ctime']).'</label>
        </div>
        <div class="info2">'.$value['sm_content'].'</div>
    </div>';
            }
        }
        return $str;
    }
}
