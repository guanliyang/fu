<?php
    include 'inc/top.php';
?>
<script type="text/javascript">
	function iSet(iname){
		document.getElementById(iname).value = '';
		if(iname=='logpass') document.getElementById(iname).type = 'password';
	}
</script>
<div class="cont">
	<div class="logo">
		<img src="img/logo.png"/>
	</div>
	<div class="login">
		<input name="logname" id="logname" value="请输入手机号(帐号)" type="text" onfocus="iSet('logname');" />
		<input name="logpass" id="logpass" value="请输入密码" type="text" onfocus="iSet('logpass');" />
		<input class="bt" value="会员登录" type="button"/><br/>
		[ <a href="resetpw.php">重置密码</a> ]　[ <a href="register.php">新会员注册</a> ]
	</div>
	<div class="cr">
		Ver 1.11 - &copy;2018 版权所有
	</div>
</div>
<?php
    include 'inc/bot.php';
?>