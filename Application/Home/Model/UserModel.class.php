<?php
namespace Home\Model;
use Think\Model;
class UserModel extends Model {
    protected $trueTableName = 'user';

    // 二维码有效期10分钟
    protected $codeTime = 600;

    public function ajaxSendSms() {
        $mobile = $this->_checkMobile();
        $this->_checkToken();
        $this->_insertSmsLog($mobile);
        //发短信 方法
        success('');
    }

    public function ajaxLogin() {
        $mobile = $this->_checkMobile();

        $this->_checkCode($mobile);
        $this->_addUser($mobile);
    }

    private function _addUser($mobile) {
        $where = ['mobile' => $mobile];
        $user = $this->where($where)->find();
        if (empty($user)) {
            $this->mobile = $mobile;
            $this->add();
        }
        var_dump($this->id);
    }

    private function _checkCode($mobile) {
        $userCode = I('request.code');
        $smsLog = M('SmsLog');
        $where = ['mobile' => $mobile];
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
}
