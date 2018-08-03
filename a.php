<?php
file_put_contents('a.log', json_encode($_POST), FILE_APPEND);
file_put_contents('a.log', json_encode($_FILES), FILE_APPEND);

$a = move_uploaded_file($_FILES["image"]["tmp_name"], "Public/user_img/" . $_FILES["image"]["name"]);
file_put_contents('a.log', json_encode($a), FILE_APPEND);
