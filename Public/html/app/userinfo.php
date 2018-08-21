<?php
    include 'inc/top.php';
?>
<div class="cont">
	<div class="tit"><a href="#" onclick="window.history.go(-1);"><返回</a>帐号信息</div>
	<hr>
	<div class="inp">
		　　姓名：<input name="username" value="赵钱孙" type="text"/><br/>
		手机号/帐号：13910533527　　　　　　　　　<input class="bt bt_s" value="重置密码" type="button"/><br/>
		帐号状态： 正常
	</div>
	<hr>
	<div class="inp">
		营业执照：<img id="licepho" src="#"/>　　　　　　　(重新上传)<br/><br/><br/>
			公司名称：<input name="cpname" value="辽宁省XX粮食公司" type="text"/>
			联系地址：<select><option>辽宁</option></select> <select><option>沈阳</option></select> <select><option>和平区</option></select>
			　　　　　<input name="cpaddress" value="XXX街XX号" type="text"/>
	</div>
	<hr>
	<input class="bt " value="保存修改" type="button"/>
</div>
<?php
    include 'inc/bot.php';
?>