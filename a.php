<?php
file_put_contents('a.log', json_encode($_POST), FILE_APPEND);
file_put_contents('a.log', json_encode($_FILES), FILE_APPEND);