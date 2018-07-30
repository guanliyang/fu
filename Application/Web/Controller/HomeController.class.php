<?php
namespace Web\Controller;
use Think\Controller;
class HomeController extends Controller {
    public $user;

    public function _initialize() {
        $uid = session('uid');

        if (empty($uid)) {
            redirect("/index.php");
        }
        if (!empty($uid)) {
            $this->user = M('User')->find($uid);
        }

        // 没查到uid
        if (empty($this->user)) {
            redirect("/index.php");
        }
    }
}
