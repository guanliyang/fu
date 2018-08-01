<?php
namespace Home\Model;
use Think\Model;
class SBillModel extends Model {
    protected $trueTableName = 's_bill';

    protected $data = array();

    public function ajaxAdd() {
        $this->_getG();
        $this->_getHan();
        $this->data($this->data)->add();
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
}