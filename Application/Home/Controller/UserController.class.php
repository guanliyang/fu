<?php
namespace Home\Controller;
class UserController extends HomeController {

    // 用户详细信息
    public function userView() {
        setReadMsg();
        $this->checkoutUserLogin();
        $this->getUserAdd($this->user['prov_id'], $this->user['city_id']);
        $this->assign('user', $this->user);
        $this->display();
    }

    // 保存修改
    public function ajaxSaveUser() {
        $this->getUid();
        $user = new \Home\Model\UserModel();
        $status = $user->saveUser($this->user);
        if ($status) {
            notice('修改成功', 0, array('url' => '/'));
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
