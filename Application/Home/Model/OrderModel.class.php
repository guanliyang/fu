<?php
namespace Home\Model;

class OrderModel extends HomeModel {
    protected $trueTableName = 'b_order';

    const STATUS_DEL = -9;
    const STATUS_CHECK = 0;
    const STATUS_FINISH = 10;

    const PAY_PART = 1;
    const PAY_ALL = 2;

    protected $data  = array();

    public function addOrder($uid) {
        // 检查合同
        $this->checkContract();
        //检查bi_id
        $this->checkBiIdStr(I('request.bi_id_str'));
        // 支付方式
        $pay_type = $this->getPayType();
        // 价格
        $this->getAllPrice($pay_type);

        //编号 和默认信息 的设置
        $this->getDefault();
        $this->data['u_id'] = $uid;
        // 收货方式
        $this->getDeliType();
        // 收货地址
        $this->getAddress($uid);

        //收货人信息
        $this->getUser();
        $status = self::data($this->data)->add();
        if (!$status) {
            notice('生成订单出错');
        }
        return $status;
    }

    // 收货联系人信息
    public function getUser() {
        $user_name = I('request.user_name');
        $mobile = I('request.mobile');
        if (empty($user_name)) {
            notice('练习人信息不能为空');
        }

        if (! is_mobile($mobile)) {
            notice('联系电话有误');
        }

        $this->data['o_deli_cont'] = $user_name;
        $this->data['o_deli_mobi'] = $mobile;
    }
    // 获取收货地址
    public function getAddress($uid) {
        $area_address = (new \Home\Model\AreaModel())->getAddress($uid);
        $address = I('request.address');
        if (empty($address)) {
            notice('请认真填写地址');
        }
        $this->data['o_deli_add'] = $area_address . $address;
    }

    public function getDeliType() {
        $deli_type = I('request.recmode', 0, 'intval');
        if (!in_array($deli_type, array(1,2))) {
            notice('收货方式有误');
        }
        $this->data['o_deli_type'] = $deli_type;
    }
    // 订单号设置
    public function getDefault() {
        $this->data['o_code'] = 'B'.date('YW').rand(10000000, 99999999);
        $this->data['o_contcode'] = 'BC'.date('YW').rand(10000000, 99999999);

        $this->data['o_ctime'] = time();
        $this->data['o_status'] = 0;
    }

    // 支付方式
    public function getPayType() {
        $pay_type = I('request.payment', 0, 'intval');
        if (!in_array($pay_type, array(1,2))) {
            notice('付款方式有误');
        }
        $this->data['o_pay_type'] = $pay_type;

        return $pay_type;
    }

    // 支付价格
    public function getAllPrice($pay_type) {
        $all_price = (new \Home\Model\SBillItemModel())->getPrice(I('request.bi_id_str'));
        $this->data['o_pay'] = $all_price;
        if ($pay_type == self::PAY_PART) {
            $this->data['o_pay_f'] = $all_price * 0.2;
            $this->data['o_pay_t'] = $all_price - $this->data['o_pay_f'];
        }
        if ($pay_type == self::PAY_ALL) {
            $this->data['o_pay_f'] = $all_price;
            $this->data['o_pay_t'] = 0;
        }

        // 运费暂时为空
        $this->data['o_frei'] = 0;
    }
}