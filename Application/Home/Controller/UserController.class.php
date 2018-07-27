<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
	public function getMobile() {
		var_dump($_POST);
		var_dump($_GET);
		var_dump(I('get.'));
		var_dump(I('d'));
		M('User')->getMobile();
	}
}
