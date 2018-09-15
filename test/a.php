<?php
phpinfo();
die;
function save_file($path = 'Public/user_img'){
    $size = 1024 * 1000 * 1; // 1M
    $file = $_FILES["file"];

    $file_types = array('image/png', 'image/jpeg', 'image/jpg', 'image/gif');
    // 图片类型判断
    if (!in_array($file['type'], $file_types)) {
        die(json_encode(array('msg' => '不支持该格式图片')));
    }

    // 图片大小
    if ($file['size'] > $size * 5) {
        die(json_encode(array('msg' => '只支持5M以下图片')));
    }

    $file_path = $path."/".date('Ymd',time())."/";

    if(!file_exists($file_path)){
        //检查是否有该文件夹，如果没有就创建，并给予最高权限
        mkdir($file_path, 0777);
    }
    $src = $file_path.time()."{$file["name"]}";

    $status = move_uploaded_file($file["tmp_name"], $src);
    if ($status) {
        die(json_encode(array('url' => '/'.$src)));
    }
    else {
        die(json_encode(array('msg' => '上传失败')));
    }

}
file_put_contents('a.log', json_encode($_FILES)."\n", FILE_APPEND);
save_file();
