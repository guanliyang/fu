<?php
namespace Home\Model;


class OrderModel extends HomeModel {
    protected $trueTableName = 'b_order';

    const STATUS_DEL = -9;
    const STATUS_CHECK = 0;
    const STATUS_FINISH = 10;

    const PAY_PART = 2; // 首付
    const PAY_ALL = 1; //全款

    protected $data  = array();

    // 订单 每箱详情
    public function getBillItemInfo() {
        $oi_id = I('request.oi_id', 0, 'intval');
        if (empty($oi_id)) {
            $this->noticeView('货组编号不能为空');
        }
        $orderItem = M('b_order_item')->where(array('oi_id' => $oi_id))->find();
        if (empty($orderItem)) {
            $this->noticeView('货组id有误');
        }

        if ($orderItem['o_id'] != I('request.o_id', 0, 'intval')) {
            $this->noticeView('货组id和订单id不对应');
        }


        $bill_item = M('s_bill_item')->where(array('bi_id' => $orderItem['bi_id']))->find();

        return array(
            'order_item' => $orderItem,
            'bill_item' => $bill_item,
            'order' => $this->getOrderById()
        );
    }

    //订单货组详情
    public function getBillInfo() {
        $b_id = I('request.b_id', 0, 'intval');
        $bill = M('s_bill')->where(array('b_id' => $b_id))->find();
        $order = $this->getOrderById();
        $bi_id_str = I('request.bi_id');
        $bi_id_str = str_replace(',', ' / ', $bi_id_str);
        return array(
            'order' => $order,
            'bill' => $bill,
            'bi_id_str' => $bi_id_str
        );
    }

    // 用户的订单详情页面
    public function getInfo() {
        setReadMsg();
        $order = $this->getOrderById();
        $order_item_list = M('b_order_item')->where(array('o_id' => $order['o_id']))->select();

        $bill_list = array();
        if (!empty($order_item_list) && is_array($order_item_list)) {
            foreach ($order_item_list as $key => $order_item) {
                $bill_item = M('s_bill_item')->where(array('bi_id' => $order_item['bi_id']))->find();

                $b_id = $bill_item['b_id'];
                // 父数组不存在, 去查
                if (empty($bill_list[$b_id])) {
                    $bill = M('s_bill')->where(array('b_id' => $b_id))->find();
                    $bill_list = $bill;
                }
                $bill_list['bill_item'][] = $bill_item +
                    array(
                        'oi_status' => $order_item['oi_status'],
                        'oi_id' => $order_item['oi_id']
                    );
            }
        }

        // 海运公司名称
        $mc_name = '';
        $mc_id = M('oms_mari_order')->where(array('o_id' => $order['o_id']))->getField('mc_id');
        if ($mc_id) {
            $mc_name = M('sys_mari_co')->where(array('mc_id' => $mc_id))->getField('mc_name');
        }

        return array(
            'order' => $order,
            'bill' => $bill_list,
            'order_item' => $order_item_list,
            'mc_name' => $mc_name
        );
    }

    private function getOrderById() {
        $o_id = I('request.o_id', 0, 'intval');
        if (empty($o_id)) {
            $this->noticeView('订单id不能为空');
        }

        $order = self::where(array('o_id' => $o_id))->find();
        if (empty($order)) {
            $this->noticeView('订单id有误');
        }

        if ($order['u_id'] != $this->getModelUid()) {
            $this->noticeView('此订单不属于您!');
        }

        if ($order['o_status'] == OrderModel::STATUS_DEL) {
            $this->noticeView('此订单已被删除!');
        }

        return $order;
    }

    // 用户 订单列表信息
    public function getUserOrderList($uid) {
        $where = array('u_id' => $uid);
        $count = self::where($where)->count();
        $page = $this->getPageShow($count);
        $list = self::where($where)->order('o_id desc')->limit($page['str'])->select();
        $list = $this->_changeOrderList($list);
        $total_page = intval($count / $this->limit) + 1;
        return array(
            'order_count' => $count,
            'list' => $list,
            'page' => $page['show'],
            'total_page' => $total_page
        );
    }

    private function _changeOrderList($list) {
        if (!empty($list) && is_array($list)) {
            // 循环订单列表
            foreach ($list as $key => $order) {
                // 每个订单 item 的列表
                $order_item_list = M('b_order_item')->where(array('o_id' => $order['o_id']))->select();
                $bi_nwei = 0;
                // 每个bill_item 的净重量和
                foreach ($order_item_list as $order_item_key => $order_item_value) {
                    $bill_item = M('s_bill_item')->where(array('bi_id' => $order_item_value['bi_id']))->find();
                    $bi_nwei += $bill_item['bi_nwei'];
                }
                // 每个bill信息
                $list[$key]['bill'] = M('s_bill')->where(array('b_id' => $bill_item['b_id']))->find();
                $list[$key]['bill']['all_nwei'] = $bi_nwei;
            }

        }
        return $list;
    }

    //生成订单
    public function addOrder($uid) {
        $this->checkUserNormal();
        // 检查合同
        $this->checkContract();
        //检查bi_id
        $bi_id_list = $this->checkBiIdStr(I('request.bi_id_str'));

        // 生成多个订单
        $s_bill_item = new \Home\Model\SBillItemModel();
        $bill_list = $s_bill_item->getBidList($bi_id_list);

        foreach ($bill_list as $bill) {
            // 支付方式
            $pay_type = $this->getPayType();


            //编号 和默认信息 的设置
            $this->getDefault();
            $this->data['u_id'] = $uid;
            // 收货方式
            $this->getDeliType();
            // 收货地址
            $this->data['o_deli_add'] = $this->getAddress($uid);

            //收货人信息
            $this->getUser();

            $all_price = array_sum(array_column($bill['bill_item'], 'bi_dpay'));
            // 价格
            $this->getAllPrice($pay_type, $all_price, $bill);

            // 订单净重合计
            $this->data['o_nwei'] = array_sum(array_column($bill['bill_item'], 'bi_nwei'));
            //单货数合计
            $this->data['o_bsum'] = array_sum(array_column($bill['bill_item'], 'bi_sum'));

            // 货款金额
            $this->data['o_pay'] = $this->data['o_pri1'] * $this->data['o_nwei'];

            // 利率
            $this->data['o_rate'] = C('DUY_RATE');

            //order 表里插入信息
            $o_id = self::data($this->data)->add();
            // b_order_item 表插入信息
            $son_bi_id_list = array_column($bill['bill_item'], 'bi_id');
            $order_item = new \Home\Model\OrderItemModel();
            $order_item->addList($son_bi_id_list, $o_id);
        }

        // 购物车状态改成 转成正式订单
        $this->updateCat($bi_id_list, $uid);

        // bill_item 表改成已成交
        $this->updateBillItem($bi_id_list, $bill);


        if (!$o_id) {
            notice('生成订单出错');
        }
        return $o_id;
    }

    // item 转变成已成交
    public function updateBillItem($bi_id_list, $bill) {
        if (!empty($bi_id_list) && is_array($bi_id_list)) {
            foreach ($bi_id_list as $bi_id) {
                $where = array(
                    'bi_id' => $bi_id
                );
                $bill_item = M('s_bill_item')->where($where)->find();
                $bi_dpay = $bill['b_pri1'] * $bill_item['bi_nwei'];
                $data = array (
                    'bi_status' => 6,
                    'bi_dpri' =>  $bill['b_pri1'],
                    'bi_dpay' => $bi_dpay
                );

                M('s_bill_item')->where($where)->save($data);
            }
        }
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
        if (!in_array($deli_type, array(0,1))) {
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
        $pay_type = I('request.payment');
        if (empty($pay_type)) {
            notice('付款方式有误');
        }
        $this->data['o_pay_type'] = $pay_type;

        return $pay_type;
    }

    // 支付价格
    public function getAllPrice($pay_type, $all_price, $bill) {
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

        // 货物单价 *元/吨
        $this->data['o_pri1'] = $bill['b_pri1'];
    }
}