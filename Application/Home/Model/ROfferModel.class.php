<?php
namespace Home\Model;
class ROfferModel extends HomeModel {
    protected $trueTableName = 'r_offer';

    const PERCENTAGE = 0.01;
    const STATUS_DEL = -9;
    const STATUS_ON = 1;
    const STATUS_LINT = 5;
    const STATUS_OFF = 0;
    const STATUS_PASS = 10;


    protected $data = array();

    public function getOnLineList() {
        $where = array('f_status' => self::STATUS_LINT);

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

        // 排序相关
        $order = 'f_ctime desc';
        $order_name = I('request.t_name');
        $order_type = I('request.t_order');
        if (!empty($order_name) && !empty($order_type) && in_array($order_type, array('desc', 'asc'))) {
            $order = $order_name.' '.$order_type;
        }


        $count = self::where($where)->count();
        $page = $this->getPageShow($count);
        $list = self::where($where)->order($order)->limit($page['str'])->select();

        return array(
            'list' => $list,
            'page' => $page['show']
        );
    }

    public function addOffer($uid) {
        $this->checkUserNormal();
        $this->checkContract();
        $this->getG();
        $this->_getWeig();

        $this->_getPrice();
        $this->data['u_id'] = $uid;
        $this->_getDefault();
        return $this->data($this->data)->add();
    }

    // 五个从表里面取得值
    public function getG() {
        $this->data['gc_id'] = I('request.gc_id', 0, 'intval');
        $where = array('gc_id' => $this->data['gc_id']);
        $this->data['f_name'] = M('g_class')->where($where)->getField('gc_name');
        if (empty($this->data['f_name'])) {
            notice('品名id有误');
        }

        $this->data['gy_id'] = I('request.gy_id', 0, 'intval');
        $where = array('gy_id' => $this->data['gy_id']);
        $this->data['f_year'] = M('g_year')->where($where)->getField('gy_id');
        if (empty($this->data['f_year'])) {
            notice('出产年份有误');
        }

        $this->data['gp_id'] = I('request.gp_id', 0, 'intval');
        $where = array('gp_id' => $this->data['gp_id']);
        $this->data['f_place'] = M('g_place')->where($where)->getField('gp_name');
        if (empty($this->data['f_place'])) {
            notice('产地有误');
        }

        $this->data['gr_id'] = I('request.gr_id', 0, 'intval');
        $where = array('gr_id' => $this->data['gr_id']);
        $this->data['f_rz'] = M('g_rz')->where($where)->getField('gr_name');
        if (empty($this->data['f_rz'])) {
            notice('容量有误');
        }

        $this->data['gl_id'] = I('request.gl_id', 0, 'intval');
        $where = array('gl_id' => $this->data['gl_id']);
        $this->data['f_level'] = M('g_level')->where($where)->getField('gl_name');
        if (empty($this->data['f_level'])) {
            notice('等级有误');
        }

        return $this->data;
    }

    //出售单价 必须大于5元  读取市场参考价格
    private function _getPrice() {
        // 价格
        $this->data['f_pric'] = I('request.f_pric', 0);
        if(empty($this->data['f_pric']) || !is_int($this->data['f_pric'] / 5 )) {
            notice('[出售单价]非法输入，请通过 +, -按钮调整价格');
        }
        $this->data['f_pric'] = $this->data['f_pric'];

        //预约金额
        $this->data['f_pay'] = ($this->data['f_pric'] * $this->data['f_weig']) * self::PERCENTAGE;

    }

    //重量
    private function _getWeig() {
        //重量和保证金等信息
        $this->data['f_weig'] = I('request.f_weig', 0, 'intval');
        if (empty($this->data['f_weig'])) {
            notice("[出售重量]超出合理范围，请重新填写");
        }
    }

    //默认值
    private function _getDefault() {
        $this->data['f_status'] = 0;
        $this->data['f_ctime'] = time();
        $this->f_code = 'R'.date('YW').rand(10000000, 99999999);
        // 合同编号
        $this->f_contcode = 'RC'.date('YW').rand(10000000, 99999999);
    }

    //获取详情
    public function getInfo() {
        setReadMsg();
        $f_id = I('request.f_id', 0, 'intval');
        if (empty($f_id)) {
            $this->noticeView('未获取到预约单id');
        }
        $info = self::where(array('f_id' => $f_id))->find();

        if (empty($info)) {
            $this->noticeView('此预约单不存在');
        }

        if ($this->getModelUid() != $info['u_id']) {
            $this->noticeView('此预约单不是您的');
        }

        if ($info['f_status'] == ROfferModel::STATUS_DEL) {
            $this->noticeView('此预约单已被删除');
        }

        return $info;
    }

    // 用户获取自己的列表
    public function getUserList($uid) {
        $where = 'u_id='.$uid.' AND f_status >=0';
        $count = self::where($where)->count();
        $page = $this->getPageShow($count, $str = '?item=2');
        $list = self::where($where)->order('f_id desc')->limit($page['str'])->select();
        $total_page = intval($count / $this->limit) + 1;
        return array(
            'count' => $count,
            'list' => $list,
            'page' => $page['show'],
            'total_page' => $total_page
        );
    }
}