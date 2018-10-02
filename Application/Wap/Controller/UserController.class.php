<?php
namespace Wap\Controller;
class UserController extends HomeController {

    // 用户详细信息
    public function userView() {
        setReadMsg();
        $this->checkoutUserLogin();
        $this->getUserAdd($this->user['prov_id'], $this->user['city_id']);
        // 用户等级
        $user_lev = M('sys_user_lev')->where('ul_id='.$this->user['ul_id'])->find();
        $this->assign('user_lev', $user_lev);

        $this->display();
    }

    // 保存修改
    public function ajaxSaveUser() {
        $this->getUid();
        $user = new \Home\Model\UserModel();
        $this->getUid();
        $status = $user->saveUser($this->user);
        if ($status) {
            notice('修改成功', 0, array('url' => '/Wap'));
        }
        else {
            notice('未修改信息');
        }
    }

    // 密码重置
    public function changePassword() {
        $this->checkoutUserLogin();
        $this->display();
    }

    // 设置新密码
    public function ajaxChangePassword() {
        $this->getUid();
        $user = new \Home\Model\UserModel();
        $user->changePassword($this->user['mobile']);
        notice("修改成功");
    }
}
