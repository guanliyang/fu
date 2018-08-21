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
	<div class="tit"><a href="#" onclick="window.history.go(-1);"><返回</a>会员注册</div>
	<hr>
	<div class="inp">
		真实姓名：<input name="username" value="" type="text"/>
		　手机号：<input name="mobile" value="限中国大陆手机号" type="text"/>
		　验证码：<input name="mobi_code" id="mobi_code" class="tx_dis" disabled value="请先点击“发送验证码”" type="text"/>　　　　　　　　　　<input id="code_bt" class="bt bt_s" value="发送验证码" type="button" onclick="codePost();"/>
		设置密码：<input name="password" value="" type="text"/>
	</div>
	<hr>
	<div class="inp">
		营业执照：<img id="licepho" src="#"/>　　　　　　　(点击上传)<br/><br/><br/>
		公司名称：<input name="cpname" value="" type="text"/>
		联系地址：<select><option>辽宁</option></select> <select><option>沈阳</option></select> <select><option>和平区</option></select>
		　　　　　<input name="cpaddress" value="" type="text"/>
	</div>
	<hr>
	<input class="bt " value="提交注册" type="button"/>
</div>
<?php
    include 'inc/bot.php';
?>
