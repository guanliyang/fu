<?php
namespace Home\Model;
class UserModel extends HomeModel {
    protected $trueTableName = 'sys_user';

    // 二维码有效期10分钟
    protected $codeTime = 600;

    // session有效时间
    protected $sessionTime = 31536000;

    //输入错误密码 计数cookie 的有效时间 半小时
    protected $wrongPasswordTime = 1800;

    public function register() {
        $this->real_name = $this->_checkName();
        $this->mobile = $this->_checkMobile();
        // 开户银行信息
        $this->bank_name = I('request.bank_name');
        $this->bank_account = checkAccount(I('request.bank_account'));
        $this->bank_payee = I('request.bank_payee');

        //$this->_checkCode($this->mobile);
        $this->_checkMobileExisted($this->mobile);
        $this->password = $this->_checkPassword();
        $this->company_name = I('request.company_name');

        // 地址设置
        $province = I('request.province');
        if (!empty($province)) {
            $this->province = $this->getAreaNameById($province);
            $this->prov_id = $province;
        }

        $city = I('request.city');
        if (!empty($city)) {
            $this->city = $this->getAreaNameById($city);
            $this->city_id = $city;
        }

        $area = I('request.area');
        if (!empty($area)) {
            $this->area = $this->getAreaNameById($area);
            $this->area_id = $area;
        }


        $this->address = I('request.address');
        $this->img = $this->getImagePath();

        $this->rtime = time();

        $this->add();
    }

    //用户修改信息
    public function saveUser($user) {
        $this->real_name = $this->_checkName();

        $this->company_name = I('request.company_name');

        $province = I('request.province');
        if (!empty($province)) {
            $this->province = $this->getAreaNameById($province);
        }

        $city = I('request.city');
        if (!empty($city)) {
            $this->city = $this->getAreaNameById($city);
        }

        $area = I('request.area');
        if (!empty($area)) {
            $this->area = $this->getAreaNameById($area);
        }

        $this->address = I('request.address');

        $user_img = cookie('user_img');
        if (!empty($user_img)) {
            $this->img = $user_img;
            cookie('user_img', null);
        }

        // 开户银行信息
        $this->bank_name = I('request.bank_name');
        $this->bank_account = checkAccount(I('request.bank_account'));
        $this->bank_payee = I('request.bank_payee');

        $status = $this->where(array('id'=>$user['id']))->save();
        return $status;
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
            "password"  => $password,
            "status" => array("EGT", -1)
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
        $userCode = I('request.mobi_code');
        $smsLog = M('SmsLog');
        $where = array('mobile' => $mobile);
        $sms = $smsLog->where($where)->order('id desc')->find();
        if (empty($sms)) {
            notice('未获取到发送的验证码');
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

    public function changePassword($user_mobile = '') {
        $mobile = $this->_checkMobile();

//        $this->_checkCode($mobile);
        $password = $this->_checkPassword();
        $where = array('mobile' => $mobile);
        $user = $this->where($where)->find();
        if (empty($user)) {
            notice('此电话号码还没有注册');
        }

        // 已登录修改密码时,判断是不是自己的电话
        if ($user_mobile && $user_mobile != $mobile) {
            notice('请填写自己的电话号码');
        }
        $this->where($where)->save(array('password' => $password));
    }

    /**
     * 用户首页信息 包括用户信息和 买 卖 , 预购信息
     */
    public function getMessageInfo($uid) {
        $where = array('u_id' => $uid);
        $SBill = M('s_bill')->where($where)->select();

        $ROffer = M('r_offer')->where($where)->select();
        return array(
            's_bill' => $SBill,
            'r_offer' => $ROffer,
        );
    }

    public function getMessageForWeb($uid) {
        $all_order_count = M('b_order')->where(array('o_status' => OrderModel::STATUS_FINISH))->count();
        $user_count = M('sys_user')->count();

        // 买粮订单
        $order = new \Home\Model\OrderModel();
        $order = $order->getUserOrderList($uid);
        // 卖粮货单
        $bill = new \Home\Model\SBillModel();
        $bill = $bill->getUserList($uid);

        // 预购约单
        $offer = new \Home\Model\ROfferModel();
        $offer = $offer->getUserList($uid);

        return array(
            'all_order_count' => $all_order_count,
            'user_count' => $user_count,
            'order' => $order,
            'bill' => $bill,
            'offer' => $offer
        );
    }

    private function getAreaNameById($id) {
        return M('area')->where(array('id' => $id))->getField('areaName');
    }

}
