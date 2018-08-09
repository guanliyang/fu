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

    //生成订单
    public function addOrder($uid) {
        // 检查合同
        $this->checkContract();
        //检查bi_id
        $bi_id_list = $this->checkBiIdStr(I('request.bi_id_str'));
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
        $this->data['o_deli_add'] = $this->getAddress($uid);

        //收货人信息
        $this->getUser();
        // 购物车状态改成 转成正式订单
        $this->updateCat($bi_id_list, $uid);

        //order 表里插入信息
        $o_id = self::data($this->data)->add();
        // b_order_item 表插入信息
        $order_item = new \Home\Model\OrderItemModel();
        $order_item->addList($bi_id_list, $o_id);
        if (!$o_id) {
            notice('生成订单出错');
        }
        return $o_id;
    }

    // 购物车转成正式订单
    public function updateCat($bi_id_list, $uid) {
        if (!empty($bi_id_list) && is_array($bi_id_list)) {
            foreach ($bi_id_list as $bi_id) {
                $where = array(
                    'uid' => $uid,
                    'bi_id' => $bi_id
                );
                $data = array(
                    'c_status' => CartModel::STATUS_FORMAL
                );
                M('b_cart')->where($where)->save($data);
            }
        }
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
        $bill_item = new \Home\Model\SBillItemModel();
        $all_price = $bill_item->getPrice(I('request.bi_id_str'));
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