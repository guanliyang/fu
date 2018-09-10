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

    'MULTI_MODULE' => true,
    'MODULE_ALLOW_LIST' => array('Home','Wap'),

    // admin 地址定义
    'ADMIN_URL' => 'http://39.104.166.224:8080/',
    // 视频地址
    'ADMIN_VIDEO_UPLOAD' => 'upload/videos/ld/',
    // 图片地址 箱号
    'ADMIN_CN_UPLOAD' => 'upload/videos/cn/',
    // 图片地址 封号
    'ADMIN_SN_UPLOAD' => 'upload/videos/sn/',
    // 图片地址 榜单
    'ADMIN_LP_UPLOAD' => 'upload/videos/lp/',
);
