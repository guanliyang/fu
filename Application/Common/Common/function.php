<?php
function is_mobile($mobile) {
    return preg_match("/^1\d{10}$/", $mobile);
}

function notice($message, $code = 1, $data = []) {
    header('Content-type: application/json;charset=utf-8');
    die(json_encode(array('code' => $code, 'msg' => $message, 'ts' => time()) + $data));
}