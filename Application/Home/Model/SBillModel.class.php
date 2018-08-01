<?php
namespace Home\Model;
use Think\Model;
class SBillModel extends Model {
    protected $trueTableName = 's_bill';
    protected $data = array();

    public function getInfo() {
        $id = I("request.id", 0, 'intval');
        return $this->where(array('id' => $id))->find();
    }

    public function ajaxAdd($uid) {
        $this->_getG();
        $this->_getHan();
        $this->_getPrice();
        $this->_getFrei();
        $this->_getDepo();
        $this->_getAdd();
        $this->_getDefault();
        $this->data['u_id'] = $uid;
        return $this->data($this->data)->add();
    }

    // 五个从表里面取得值
    private function _getG() {
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
        $b_add = I('request.b_add');
        if (empty($b_add)) {
            notice('装货详细地址不能为空');
        }
        $this->data['b_add'] = $b_add;

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