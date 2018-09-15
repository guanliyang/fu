<?php
namespace Home\Controller;
use Think\Controller;
class CliController extends Controller{
    public function test1() {
        $path = str_replace('cli.php', '', __FILE__);
        $msg = date('Y-m-d H:i:s')."\n";
        file_put_contents($path.'/test/a.log', $msg, FILE_APPEND);
    }
}
