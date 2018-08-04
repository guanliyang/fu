<?php

$src = "Public/user_img/" . $_FILES["file"]["name"];
$a = move_uploaded_file($_FILES["file"]["tmp_name"], $src);
file_put_contents('a.log', json_encode($a), FILE_APPEND);
if ($a) {
    die(json_encode(array('url' => '/'.$src)));
}
else {
    die(json_encode(array('msg' => '上传失败')));
}
