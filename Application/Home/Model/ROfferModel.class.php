<?php
namespace Home\Model;
use Think\Model;
class ROfferModel extends Model {
    protected $trueTableName = 'r_offer';

    protected $data = array();
    public function addOffer($uid) {
        $this->getG();
        $this->_getPrice();
        $this->_getWeig();
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
}