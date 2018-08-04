<?php
namespace Home\Controller;
class UserController extends HomeController {

    // 密码重置
    public function changePasswordView() {

        $this->display();
    }

    // 用户详细信息
    public function userView() {
        dump($this->user);
        $this->assign('user', $this->user);
        $this->display();
    }

    // 设置新密码
    public function changePassword() {
        $user = new \Home\Model\UserModel();
        $user->changePassword($this->user['mobile']);
        notice("修改成功", 0);
    }

    // 保存修改
    public function ajaxSaveUser() {
        $user = new \Home\Model\UserModel();
        $user->saveUser($this->user);
    }
}
