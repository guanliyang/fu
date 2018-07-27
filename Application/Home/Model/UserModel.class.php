<?php
/**
 * Created by PhpStorm.
 * User: guanliyang
 * Date: 2018/7/27
 * Time: 下午3:13
 */
namespace Home\Model;
use Think\Model;
class UserModel extends Model {
	protected $tableName = 'user';

	public function getMobile() {
		var_dump(I('d'));
	}
}
