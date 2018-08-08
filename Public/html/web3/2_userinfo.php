<?php
    include 'inc/top.php';
?>
<script type="text/javascript">
	pSet('3');
</script>

<div class="bdiv cont">
	<div class="inp">
		<div class="tit"><a href="#" onclick="window.history.go(-1);"><返回</a><h2>帐号信息</h2></div>
		<div class="reg">
			　　　 姓名：<input name="username" value="赵钱孙" type="text"/><br/>
			手机号/帐号：13910533527　　<input class="bt bt_s" value="重置密码" type="button"/><br/>
			　 帐号状态： 正常
		</div>
		<hr>
		<div class="reg">
			营业执照：<img id="licepho" src="#"/>　　　　　　　(重新上传)<br/><br/><br/>
			公司名称：<input name="cpname" value="辽宁省XX粮食公司" type="text"/><br/>
			联系地址：<select><option>辽宁</option></select> <select><option>沈阳</option></select> <select><option>和平区</option></select><br/>
			　　　　　<input name="cpaddress" value="XXX街XX号" type="text"/><br/><br/>
			　　　　　<input class="bt " value="保存修改" type="button"/>
		</div>
	</div>
</div>
<?php
    include 'inc/bot.php';
?>