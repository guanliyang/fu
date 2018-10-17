<?php
namespace Home\Controller;
class UserController extends HomeController {

    // 用户详细信息
    public function userView() {
        setReadMsg();
        $this->checkoutUserLogin();
        // 用户地址
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

    // 检查用户是否有发布权限
    public function checkoutUserPermission() {
        $user = $this->user;
        if (!empty($user) && $user['status'] < 1) {
            notice('您的用户状态还未通过审核,不能进行此操作！');
        }
        else {
            notice('成功', 0);
        }
    }
}
