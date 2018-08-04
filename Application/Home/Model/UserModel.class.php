<?php
namespace Home\Model;
use Think\Model;
class UserModel extends Model {
    protected $trueTableName = 'user';

    // 二维码有效期10分钟
    protected $codeTime = 600;

    // session有效时间
    protected $sessionTime = 31536000;

    //输入错误密码 计数cookie 的有效时间 半小时
    protected $wrongPasswordTime = 1800;

    public function register() {
        $this->real_name = $this->_checkName();
        $this->mobile = $this->_checkMobile();
        //$this->_checkCode($this->mobile);
        $this->_checkMobileExisted($this->mobile);
        $this->password = $this->_checkPassword();
        $this->company_name = I('request.company_name');
        $this->province = I('request.province');
        $this->city = I('request.city');
        $this->area = I('request.area');
        $this->address = I('request.address');
        $this->img = I('request.src');

        $this->add();
    }


    private function getImg() {
        return 't';//I('request.src');
        //return base64_image_content($src);
    }
    private function _checkMobileExisted($mobile) {
        $where = array('mobile' => $mobile);
        $existed = $this->where($where)->find();
        if ($existed) {
            notice("此电话已被注册");
        }
    }

    private function _checkPassword() {
        $password = trim(I('request.password'));
        if (empty($password)) {
            notice('密码不能为空');
        }

        if (strlen($password) > 45) {
            notice('密码过长不方便记忆，请重新填写');
        }
        return md5($password);
    }

    private function _checkName() {
        $name = trim(I('request.name'));
        if (empty($name)) {
            notice("姓名为空，请填写完整");
        }

        // 一般汉字三个长度
        if (strlen($name) > 45) {
            notice("姓名超长");
        }
        return $name;
    }

    public function ajaxSendSms() {
        $mobile = $this->_checkMobile();
        $this->_checkToken();
        $this->_insertSmsLog($mobile);
        //发短信 方法
        notice('请求成功', 0);
    }

    public function ajaxLogin() {
        $mobile = $this->_checkMobile();
        $password = $this->_checkPassword();
        $where = array(
            "mobile"    => $mobile,
            "password"  => $password
        );

        if (! $user =  $this->where($where)->find()) {
            $input_password_num = intval(cookie('input_password_num')) + 1;
            cookie('input_password_num', $input_password_num, $this->wrongPasswordTime);
            notice("密码输入错误，请重新填写");
        }
        session('uid', $user['id']);
    }

    public function mobileLogin() {
        $mobile = $this->_checkMobile();
//        $this->_checkCode($mobile);
        $where = array(
            "mobile"    => $mobile,
        );
        if (! $user =  $this->where($where)->find()) {
            notice("此电话没有注册");
        }
        session('uid', $user['id']);
    }

    // 由电话对比验证码是否正确
    private function _checkCode($mobile) {
        $userCode = I('request.code');
        $smsLog = M('SmsLog');
        $where = array('mobile' => $mobile);
        $sms = $smsLog->where($where)->order('id desc')->find();
        if (empty($sms)) {
            notice('未查询到数据');
        }
        $code = $sms['code'];
        $time = $sms['ctime'];

        if ($userCode != $code) {
            notice('验证码错误');
        }

        if (time() - $time > $this->codeTime) {
            notice('验证码已过期');
        }

        return true;
    }

    private function _insertSmsLog($mobile) {
        $code = $this->_getCode();
        $smsLog = M('SmsLog');
        $smsLog->code = $code;
        $smsLog->mobile = $mobile;
        $smsLog->message = "您的验证码是".$code;
        $smsLog->ctime = time();
        $smsLog->add();

    }

    private function _checkMobile() {
        $mobile = I('request.mobile');
        if (empty($mobile)) {
            notice("电话号码不能为空");
        }
        if (!is_mobile($mobile)) {
            notice("电话号码有误");
        }
        return $mobile;
    }

    private function _checkToken() {
        if (!$this->autoCheckToken(I('request.'))) {
            notice("token验证失败,非法提交");
        }
    }

    private function _getCode() {
        return rand(100000, 999999);
    }

    public function changePassword($user_mobile) {
        $mobile = $this->_checkMobile();
        if ($user_mobile != $mobile) {
            notice("您填写的电话不是你自己的");
        }
//        $this->_checkCode($mobile);
        $this->password = $this->_checkPassword();
        $where = array('mobile' => $mobile);
        $this->where($where)->save();
    }

    /**
     * 用户首页信息 包括用户信息还买 卖 , 预售信息
     */
    public function getMessageInfo($uid) {
        $where = array('u_id' => $uid);
        $SBill = M('s_bill')->where($where)->select();
        return array(
            's_bill' => $SBill
        );
    }
}
