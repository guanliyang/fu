<?php
namespace Home\Controller;
class UserController extends HomeController {

    // 用户详细信息
    public function userView() {
        $province = M('area')->where(array('level' => 1))->select();
        $this->assign('province', $province);
        $this->assign('user', $this->user);
        $this->display();
    }

    // 保存修改
    public function ajaxSaveUser() {
        $user = new \Home\Model\UserModel();
        $user->saveUser($this->user);
    }

    // 密码重置
    public function changePassword() {
        $this->display();
    }

    // 设置新密码
    public function ajaxChangePassword() {
        $user = new \Home\Model\UserModel();
        $user->changePassword($this->user['mobile']);
        notice("修改成功");
    }
}
