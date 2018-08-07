<?php
    include 'inc/top.php';
?>
<script type="text/javascript">
	pSet('3');
	function iSet(iname){
		document.getElementById(iname).value = '';
		if(iname=='logpass') document.getElementById(iname).type = 'password';
	}
</script>
<div class="bdiv cont">
	<div class="inp">
		<div class="tit"><a href="#" onclick="window.history.go(-1);"><返回</a><h2>会员登录</h2></div>
		<input name="logname" id="logname" value="请输入手机号(帐号)" type="text" onfocus="iSet('logname');" /><br/>
		<input name="logpass" id="logpass" value="请输入密码" type="text" onfocus="iSet('logpass');" /><br/>
		<input class="bt" value="会员登录" type="button"/><br/>
		[ <a href="resetpw.php">重置密码</a> ]　[ <a href="register.php">新会员注册</a> ]
	</div>
</div>
<?php
    include 'inc/bot.php';
?>