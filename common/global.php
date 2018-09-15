<?php
	require 'func.php';

	$GLOBALS['VisitIP'] = ''; //填写IP可限定访问者，不填写为不限定；
	$GLOBALS['VisitHost'] = '39.104.166.224:8080';
	
	$GLOBALS['dbhost'] = '127.0.0.1';
	$GLOBALS['username'] = 'root';
	$GLOBALS['userpass'] = '';
	$GLOBALS['dbdatabase'] = 'fu';
	
	$GLOBALS['uploadpath'] = 'upload/';
	$GLOBALS['web_uploadpath'] = '\upload';
	$GLOBALS['web_uploadhost'] = 'http://omsa.365lbb.com';
	$GLOBALS['downloadpath'] = 'download/';
	$GLOBALS['web_downloadpath'] = '\upload';
	$GLOBALS['web_downloadhost'] = 'http://omsa.365lbb.com';

        $GLOBALS['accRoleArr'] = array(1=>'货品专员', 2=>'交易专员', 3=>'物流专员', 4=>'海运专员', 5=>'财务专员', 6=>'客服专员', 7=>'高级客
服专员', 8=>'网站专员', 99=>'系统管理员');

        $GLOBALS['billStatusArr'] = array(-9=>'删除', 0=>'待审核', 4=>'待核费', 1=>'待收款', 2=>'待装货', 3=>'待填单', 6=>'待回款', 7=>'待>上架', 5=>'在售', 9=>'已成交', 10=>'已结单');

        $GLOBALS['billItemStatusArr'] = array(-9=>'删除', 0=>'待审核', 1=>'已封箱', 2=>'运送中', 3=>'已入港', 5=>'在售', 6=>'已下单', 7=>'>已成交');
        //, 8=>'待付款', 9=>'已结算', 10=>'已结单'

        $GLOBALS['billLogArr']= array(-1=>'基本信息审核 [已退]',0=>'基本信息审核 [完成]', 4=>'运费核算 [完成]', 1=>'保证金与运费收款确认 [>完成]', 2=>'装货派单 [完成]', 3=>'货组填单 [完成]', -3=>'退回修改 [已退]', 31=>'货组信息更新 [完成]', -31=>'退回更新 [已退]', 6=>'货款回款 [完成]', 7=>'上架出售 [完成]');

        $GLOBALS['orderStatusArr'] = array(-9=>'删除', 0=>'待核费', 1=>'待核费', 2=>'待付款', 3=>'待离岸', 4=>'海运中', 5=>'已到岸', 6=>'待
发货', 7=>'待收货', 8=>'待提货', 9=>'已收货', 10=>'已结单');

        $GLOBALS['orderLogArr']= array(0=>'运费(陆运)核算 [完成]', 1=>'运费(海运)核算 [完成]', 2=>'首付款与运费收款确认 [完成]', 3=>'海运派
单 [完成]', 4=>'海运到岸 [完成]', 5=>'尾款、利息与滞箱费收款确认 [完成]', 6=>'送货派单 [完成]', 7=>'送货到门 [完成]');


        $GLOBALS['dayDePay'] = '50';//每日每箱滞箱费
?>
