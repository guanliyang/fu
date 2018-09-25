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

    // 视频地址
    'LD_URL' => 'http://39.104.166.224:8080/upload/videos/ld/',

    // 图片地址 箱号
    'CN_URL' => 'http://39.104.166.224:8080/upload/images/cn/',

    // 图片地址 封号
    'SN_URL' => 'http://39.104.166.224:8080/upload/images/sn/',

    // 图片地址 榜单
    'LP_URL' => 'http://39.104.166.224:8080/upload/images/lp/',

    // 首付 买粮 生成订单
    'FIRST_PAY_SHOW' => '5%',
    'FIRST_PAY' => 0.05,

    // 年利率 买粮尾款
    'BUY_RATE' => 0.06,

    // 卖粮 回款年利率
    'SELL_RATE' => 0.06,

    // 保证金 卖粮
    'DEPO_RATE' => 0.05,
    // 保证金显示
    'DEPO_RATE_SHOW' => '5%',

    // 滞箱费
    'BOX_DAY_PAY' => 50,

    // 预约单 预约金比例
    'OFFER_PAY' => 0.05,
    'OFFER_PAY_SHOW' => '5%',

    // 预约单 每吨 服务费
    'OFFER_SER' => 3,
);
