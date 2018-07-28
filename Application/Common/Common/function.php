<?php
function is_mobile($mobile) {
    return preg_match("/^1\d{10}$/", $mobile);
}

function notice($message, $code = 1) {
    header('Content-type: application/json;charset=utf-8');
    die(json_encode(array('code' => $code, 'msg' => $message, 'ts' => time())));
}

function success($data, $message = '') {
    $message = empty($message) ? '请求成功' : $message;
    if (is_array($data)) {
        $data = ['data_list' => $data];
    }
    else {
        $data = ['data' => $data];
    }
    die(json_encode(array('code' => 0, 'msg' => $message, 'ts' => time()) + $data));
}