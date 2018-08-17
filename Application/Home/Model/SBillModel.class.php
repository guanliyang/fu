<?php
namespace Home\Model;
class SBillModel extends HomeModel {
    protected $trueTableName = 's_bill';
    protected $data = array();

    const STATUS_DEL = -9;
    const STATUS_ON = 9;
    const STATUS_CHECK = 0;
    const STATUS_FINISH = 10;

    public function getP() {
        $page = I('request.page', 1, 'intval');
        $page = $page < 1 ? 1 : $page;
        $limit = I('request.limit', 10, 'intval');

        return $page. ',' . $limit;
    }
    // 在售粮源
    public function getOnLineList() {
        $where = array('b_status' => self::STATUS_ON);

        $gc_id = I('request.gc_id', 0, 'intval');
        if (!empty($gc_id)) {
            $where += array('gc_id' => $gc_id);
        }

        $gc_id = I('request.gl_id', 0, 'intval');
        if (!empty($gc_id)) {
            $where += array('gl_id' => $gc_id);
        }

        $gc_id = I('request.gp_id', 0, 'intval');
        if (!empty($gc_id)) {
            $where += array('gp_id' => $gc_id);
        }

        $gc_id = I('request.gr_id', 0, 'intval');
        if (!empty($gc_id)) {
            $where += array('gr_id' => $gc_id);
        }

        $gc_id = I('request.gy_id', 0, 'intval');
        if (!empty($gc_id)) {
            $where += array('gy_id' => $gc_id);
        }

        $order = 'b_ctime desc';
        $search_order = I('request.order');
        if (!empty($search_order)) {
            $order = $search_order.' desc';
        }

        $count = self::where($where)->count();
        $page = $this->getPageShow($count);
        $list = self::where($where)->order($order)->limit($page['str'])->select();

        return array(
            'list' => $list,
            'page' => $page['show']
        );
    }

    // 用户卖货列表
    public function getUserList($uid) {
        $where = array('u_id' => $uid);
        $count = self::where($where)->count();
        $page = $this->getPageShow($count, $str = '?item=3');
        $list = self::where($where)->order('b_id desc')->limit($page['str'])->select();

        return array(
            'count' => $count,
            'list' => $list,
            'page' => $page['show']
        );
    }

    //修改价格
    public function changePrice() {
        $id = I("request.b_id", 0, 'intval');
        $price = I("request.b_pri1", 0, 'intval');
        $status = self::where(array('b_id' => $id))->save(array('b_pri1' => $price));
        return $status;
    }

    // 获取卖单 详情
    public function getInfo() {
        $bill = $this->getBId();

        $where = array('b_id' => $bill['b_id']);

        $on_where = $where + array(
                'bi_status' => array('GT', 0),
                'bi_status' => array('LT', 6),
            );

        $finish_where = $where + array(
                'bi_status' => array('GT', 5),
            );

        return array(
                'bill' => $bill,
                'on_bill_item' => M('s_bill_item')->where($on_where)->select(),
                'finish_bill_item' => M('s_bill_item')->where($finish_where)->select(),
            );
    }

    /**
     * 重写获取卖单详情
     * 包括itme 已售货组和未售货组信息
     * 根据b_status 获取
     */
    public function getBillInfo($getMyBill = true) {
        $bill = $this->getBId($getMyBill);
        // 根据b_status 获取item信息
        $where = array('b_id' => $bill['b_id']);
        if ($bill['b_status'] == 3) {
            $where += array('bi_status' => array('in','1, 2, 3'));
            // 待上架货组
            $bill['wait'] = M('s_bill_item')->where($where)->select();
        }
        // 在售
        if ($bill['b_status'] == 5) {
            $where += array('bi_status' => array('in','5, 6'));
            $bill['on_sell'] = M('s_bill_item')->where($where)->select();

            $where = array(
                'b_id' => $bill['b_id'],
                'bi_status' => array('in','7')
            );
            $bill['finish_sell'] = M('s_bill_item')->where($where)->select();
        }

        //已售
        if ($bill['b_status'] == 9) {
            $where += array('bi_status' => array('in','7, 8, 9'));
            $bill['finish_sell'] = M('s_bill_item')->where($where)->select();
        }

        return $bill;
    }

    public function getBId($getMyBill = true) {
        $id = I("request.b_id", 0, 'intval');
        if (empty($id)) {
            $this->noticeView('未获取到货单号');
        }

        $bill = $this->where(array('b_id' => $id))->find();
        if (empty($bill)) {
            $this->noticeView('货单号有误');
        }

        if ($bill['b_status'] == SBillModel::STATUS_DEL) {
            $this->noticeView('货单号已被删除');
        }

        if ($getMyBill && $bill['u_id'] != $this->getModelUid()) {
            $this->noticeView('此货单不属于您');
        }

        return $bill;
    }
    public function ajaxAdd($uid) {
        $this->checkContract();
        $this->getG();
        $this->_getHan();
        $this->_getPrice();
        $this->_getFrei();
        $this->_getDepo();
        $this->_getAdd();
        $this->_getDefault();
        $this->data['u_id'] = $uid;
        $this->data['b_photo'] = $this->getImagePath();
        $this->data['b_add'] = $this->getAddress($uid);
        return $this->data($this->data)->add();
    }

    // 五个从表里面取得值
    public function getG() {
        $this->data['gc_id'] = I('request.gc_id', 0, 'intval');
        $where = array('gc_id' => $this->data['gc_id']);
        $this->data['b_name'] = M('g_class')->where($where)->getField('gc_name');
        if (empty($this->data['b_name'])) {
            notice('品名id有误');
        }

        $this->data['gy_id'] = I('request.gy_id', 0, 'intval');
        $where = array('gy_id' => $this->data['gy_id']);
        $this->data['b_year'] = M('g_year')->where($where)->getField('gy_id');
        if (empty($this->data['b_year'])) {
            notice('出产年份有误');
        }

        $this->data['gp_id'] = I('request.gp_id', 0, 'intval');
        $where = array('gp_id' => $this->data['gp_id']);
        $this->data['b_place'] = M('g_place')->where($where)->getField('gp_name');
        if (empty($this->data['b_place'])) {
            notice('产地有误');
        }

        $this->data['gr_id'] = I('request.gr_id', 0, 'intval');
        $where = array('gr_id' => $this->data['gr_id']);
        $this->data['b_rz'] = M('g_rz')->where($where)->getField('gr_name');
        if (empty($this->data['b_rz'])) {
            notice('容量有误');
        }

        $this->data['gl_id'] = I('request.gl_id', 0, 'intval');
        $where = array('gl_id' => $this->data['gl_id']);
        $this->data['b_level'] = M('g_level')->where($where)->getField('gl_name');
        if (empty($this->data['b_level'])) {
            notice('等级有误');
        }

        return $this->data;
    }

    // 四个汉字百分比
    private function _getHan() {
        $this->data['b_mb'] = I('request.b_mb', 0, 'intval');
        if ($this->data['b_mb'] > 4 || $this->data['b_mb'] < 1) {
            notice("[霉变]数据超出合理范围(1.0~4.0)，请重新填写");
        }

        $this->data['b_zz'] = I('request.b_zz', 0, 'intval');
        if ($this->data['b_zz'] < 1 || $this->data['b_zz'] > 2) {
            notice("[杂质]数据超出合理范围(1.0-2.0)，请重新填写");
        }

        $this->data['b_sf'] = I('request.b_sf', 0, 'intval');
        if ($this->data['b_sf'] < 12 || $this->data['b_sf'] > 16) {
            notice("[水份]数据超出合理范围(12.0~16.0)，请重新填写");
        }

        $this->data['b_ot'] = I('request.b_ot', 0);
        if (empty($this->data['b_ot']) || !is_numeric($this->data['b_ot']) || strstr($this->data['b_ot'], '.') ) {
            notice("[呕吐毒素]数据只能输入整数，请重新填写");
        }
    }

    //出售单价 必须大于5元  读取市场参考价格
    private function _getPrice() {
        // 价格
        $this->data['b_pri0'] = I('request.b_pri0', 0);
        if(empty($this->data['b_pri0']) || !is_int($this->data['b_pri0'] / 5 )) {
            notice('[出售单价]非法输入，请通过 +, -按钮调整价格');
        }
        $this->data['b_pri1'] = $this->data['b_pri0'];
    }

    //获取运费
    private function _getFrei() {
        //重量和保证金等信息
        $this->data['b_weig'] = I('request.b_weig', 0, 'intval');
        if (empty($this->data['b_weig'])) {
            notice("[出售重量]超出合理范围，请重新填写");
        }
        // 箱数
        $boxNum = ceil($this->data['b_weig'] / 28);
        // 车数
        $carNum = ceil($boxNum / 2);
        // 全单运费  单车价格 89
        return $this->data['b_frei'] = 89 * $carNum;
    }

    // 缴纳保证金
    private function _getDepo() {
        $b_pri0 = I('request.b_pri0', 0);
        $b_weig = I('request.b_weig', 0, 'intval');
        $this->data['b_depo'] = $b_pri0 * $b_weig * 0.2;
    }

    // 联系人信息
    private function _getAdd() {
        $b_cont = I('request.b_cont');
        if (empty($b_cont)) {
            notice('联系人不能为空');
        }
        $this->data['b_cont'] = $b_cont;

        $b_mobi = I('request.b_mobi');
        if (!is_mobile($b_mobi)) {
            notice('联系人手机有误');
        }
        $this->data['b_mobi'] = $b_mobi;
    }

    private function _getDefault() {
        $this->data['b_ctime'] = time();
        $this->data['b_status'] = 0;
        $this->b_code = 'S'.date('YW').rand(10000000, 99999999);
        // 合同编号
        $this->b_concode = 'SC'.date('YW').rand(10000000, 99999999);
    }
}