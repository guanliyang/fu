<?php
namespace Home\Controller;
use Think\Controller;
class CliController extends Controller{
    public function test1() {
        $msg = date('Y-m-d H:i:s')."\n";
        file_put_contents(C('PATH').'/test/a.log', $msg, FILE_APPEND);
    }
}
