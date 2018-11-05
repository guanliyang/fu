<?php
namespace Home\Model;
use Think\Model;
class AreaModel extends Model {
    protected $trueTableName = 'area';

    public function getAddress($uid) {
        $province = I('request.province', 0, 'intval');
        $city = I('request.city', 0, 'intval');
        $area = I('request.area', 0, 'intval');
        if (empty($province) && empty($city) && empty($area)) {
            $user = M('sys_user')->where(array('u_id' => $uid))->find();
            return $user['province'].$user['city'].$user['area'];
        }

        if (!empty($province) && empty($city)) {
            notice('请认真选择二级地址');
        }

        if (!empty($province) && !empty($city) && empty($area)) {
            notice('请认真选择三级地址');
        }

        return $this->getAreaNameById($province).' '.$this->getAreaNameById($city) . ' '.$this->getAreaNameById($area).' ';
    }

    private function getAreaNameById($id) {
        return M('area')->where(array('id' => $id))->getField('areaName');
    }
}