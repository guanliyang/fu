<?php
    include 'inc/top.php';
?>
<script type="text/javascript">
	function codePost(){
		document.getElementById('mobi_code').disabled = '';
		document.getElementById('mobi_code').value = '';
		document.getElementById('mobi_code').focus();
		var eTime = Math.round(new Date().getTime()/1000)+5;
		var tTime = setInterval(ActiCodeGetTime,1000);
		function ActiCodeGetTime(){
			var nTime = Math.round(new Date().getTime()/1000);
			var t =eTime - nTime;
			if (t <= 0) {
				document.getElementById("code_bt").value = '重新发送';
				document.getElementById("code_bt").disabled = '';
				document.getElementById("code_bt").setAttribute("class", 'bt bt_s');
				clearInterval(tTime); 
			}else{
				document.getElementById("code_bt").value = t + " 秒后可重发";
				document.getElementById("code_bt").disabled = 'disabled';
				document.getElementById("code_bt").setAttribute("class", 'bt_dis bt_s');
			}
		}
	}
</script>
<div class="cont">
	<div class="tit"><a href="#" onclick="window.history.go(-1);"><返回</a>重置密码</div>
	<hr>
	<div class="inp">
		　手机号：<input name="mobile" value="" type="text"/>
		　验证码：<input name="mobi_code" id="mobi_code" class="tx_dis" disabled value="请先点击“发送验证码”" type="text"/><br/>　　　　　　　　　　<input id="code_bt" class="bt bt_s" value="发送验证码" type="button" onclick="codePost();"/>
		　新密码：<input name="password" value="" type="text"/>
	</div>
	<hr>
	<input class="bt " value="设定新密码" type="button"/>
</div>
<?php
    include 'inc/bot.php';
?>