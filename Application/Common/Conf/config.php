<?php
return  array(
    'TOKEN_ON'      =>    true,  // 是否开启令牌验证 默认关闭
    'TOKEN_NAME'    =>    'hash',    // 令牌验证的表单隐藏字段名称，默认为__hash__
    'TOKEN_TYPE'    =>    'md5',  //令牌哈希验证规则 默认为MD5
    'TOKEN_RESET'   =>    true,  //令牌验证出错后是否重置令牌 默认为true

    'SESSION_OPTIONS'         =>  array(
        'name'                =>  'SESSION_NAME',                    //设置session名
        'expire'              =>  31536000,                      //SESSION过期时间，单位秒
    ),

    'RATE' => 0.0002,  // 滞箱费 日利率  从主订单和主货单读出来的。
//    'MODULE_ALLOW_LIST' => array('Home','Web'),
);
