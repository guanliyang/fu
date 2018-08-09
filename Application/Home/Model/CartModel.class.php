<?php
namespace Home\Model;
class CartModel extends HomeModel {
    protected $trueTableName = 'b_cart';

    const STATUS_DEL = -9;
    const STATUS_NORMAL = 1;
    const STATUS_FORMAL = 9;

    // 订单结算
    public function finish() {
        $bi_id_str = I('get.bi_id_str');
        $bi_id_list = $this->checkBiIdStr($bi_id_str);
        $data = array();
        foreach ($bi_id_list as $bi_id) {
            $bill_item = M('s_bill_item')->where(array('bi_id' => $bi_id))->find();
            $b_id = $bill_item['b_id'];
            $s_bill = M('s_bill')->where(array('b_id' => $b_id))->find();

            // 父
            if (empty($data[$b_id])) {
                $data[$b_id] = $s_bill;
            }

            // 子
            $data[$b_id]['bill_item'][] = $bill_item;
        }
        return $data;
    }

    // 选择跳转
    public function choseBiId() {
        $bi_id_str = implode(',', I('buyid'));

        $this->checkBiIdStr($bi_id_str);
        notice('选择成功', '0', array('url' => '/Home/Cart/finish?bi_id_str='.$bi_id_str));
    }

    //查询购物车
    public function getByUid($uid) {
        $list = self::where(array(
            'u_id' => $uid,
            'c_status' => self::STATUS_NORMAL
        ))->select();

        $list = $this->changeList($list);
        return $list;
    }

    // 获取货物详细信息
    private function changeList($list) {
        $data = array();
        if (!empty($list) && is_array($list)) {
            foreach ($list as $key => $cart) {
                $bill_item = M('s_bill_item')->where(array('bi_id' => $cart['bi_id']))->find();
                $b_id = $bill_item['b_id'];
                $s_bill = M('s_bill')->where(array('b_id' => $b_id))->find();

                // 父
                if (empty($data[$b_id])) {
                    $data[$b_id] = $s_bill;
                }

                // 子
                $data[$b_id]['bill_item'][] = $bill_item;
            }
        }
        return $data;
    }

    // 添加到购物车
    public function addCart($uid) {
        $bi_id_list = I('request.bi_id');
        $this->checkBiIdList($bi_id_list);
        $this->checkExist($bi_id_list, $uid);
        $data = array();
        foreach ($bi_id_list as $bi_id) {
            $data['bi_id'] = $bi_id;
            $data['u_id'] = $uid;

            $data['c_ctime'] = time();
            $data['c_status'] = self::STATUS_NORMAL;
            $status = self::data($data)->add();
        }
        return $status;
    }

    // 判断购物车中是否存在
    public function checkExist($bi_id_list, $uid) {
        foreach ($bi_id_list as $bi_id) {
            $data['bi_id'] = $bi_id;
            $data['u_id'] = $uid;
            $exist = self::where($data)->find();
            if ($exist) {
                notice("货组编号".$bi_id."已存在于您的购物车中,请重新选择");
            }
        }
        return true;
    }
}