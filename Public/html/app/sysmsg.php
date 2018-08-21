<?php
    include 'inc/top.php';
?>
<script type="text/javascript">
	onload = function(){
		document.getElementById('list1').style['display'] = 'none';
		document.getElementById('list2').style['display'] = 'none';
		var itemval = GetQueryString('item');
		if(itemval==null) itemval=1;
		document.getElementById('list'+itemval).style['display'] = '';
		document.getElementById('item'+itemval).setAttribute('class', 'hot');
	}
	
	function GetQueryString(name)
	{
	     var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
	     var r = window.location.search.substr(1).match(reg);
	     if(r!=null)return  unescape(r[2]); return null;
	}
</script>
<div class="cont">
	<div class="tit"><a href="#" onclick="window.history.go(-1);"><返回</a>系统通知</div>
</div>
<div class="cont">
	<div class="item_tit">
		<a href="?item=1" id="item1">新通知(4)</a><a href="?item=2" id="item2">已读通知</a>
	</div>
</div>
<div class="item_list" id="list1">
	<div class="msgitem" onclick="location.href='buyinfo.php'">
		<div class="info1">
			B101101101<label>2018/07/19 12:21:35</label>
		</div>
		<div class="info2">待办事项：请支付货款(<label>42,500</label>元)/利息(<label>50</label>元)，到合同指定帐号。</div>
	</div>
	<div class="msgitem" onclick="location.href='saleinfo.php'">
		<div class="info1">
			S101101101<label>2018/07/19 12:21:35</label>
		</div>
		<div class="info2">待办事项：请支付保证金(<label>51,500</label>元)/运费(<label>3,600</label>元)，到合同指定帐号。</div>
	</div>
	<div class="msgitem" onclick="location.href='buyinfo.php'">
		<div class="info1">
			R101101101<label>2018/07/19 12:21:35</label>
		</div>
		<div class="info2">待办事项：请支付预约金(<label>42,500</label>元)/服务费(<label>1,500</label>元)，到合同指定帐号。</div>
	</div>
	<div class="msgitem" onclick="location.href='buyinfo.php'">
		<div class="info1">
			B101101101<label>2018/07/19 12:21:35</label>
		</div>
		<div class="info2">待办事项：请支付货款(<label>42,500</label>元)/利息(<label>50</label>元)，到合同指定帐号。</div>
	</div>
</div>

<div class="item_list" id="list2">
	<div class="msgitem" onclick="location.href='buyinfo.php'">
		<div class="info1">
			R101101101<label>2018/07/19 12:21:35</label>
		</div>
		<div class="info4">待办事项：请支付预约金(<label>42,500</label>元)/服务费(<label>1,500</label>元)，到合同指定帐号。</div>
	</div>
	<div class="msgitem" onclick="location.href='buyinfo.php'">
		<div class="info1">
			B101101101<label>2018/07/19 12:21:35</label>
		</div>
		<div class="info4">待办事项：请支付货款(<label>42,500</label>元)/利息(<label>50</label>元)，到合同指定帐号。</div>
	</div>
	<div class="msgitem" onclick="location.href='buyinfo.php'">
		<div class="info1">
			B101101101<label>2018/07/19 12:21:35</label>
		</div>
		<div class="info4">待办事项：请支付货款(<label>42,500</label>元)/利息(<label>50</label>元)，到合同指定帐号。</div>
	</div>
	<div class="msgitem" onclick="location.href='saleinfo.php'">
		<div class="info1">
			S101101101<label>2018/07/19 12:21:35</label>
		</div>
		<div class="info4">待办事项：请支付保证金(<label>51,500</label>元)/运费(<label>3,600</label>元)，到合同指定帐号。</div>
	</div>
	<div class="msgitem" onclick="location.href='buyinfo.php'">
		<div class="info1">
			R101101101<label>2018/07/19 12:21:35</label>
		</div>
		<div class="info4">待办事项：请支付预约金(<label>42,500</label>元)/服务费(<label>1,500</label>元)，到合同指定帐号。</div>
	</div>
	<div class="msgitem" onclick="location.href='buyinfo.php'">
		<div class="info1">
			B101101101<label>2018/07/19 12:21:35</label>
		</div>
		<div class="info4">待办事项：请支付货款(<label>42,500</label>元)/利息(<label>50</label>元)，到合同指定帐号。</div>
	</div>
	<div class="msgitem" onclick="location.href='buyinfo.php'">
		<div class="info1">
			R101101101<label>2018/07/19 12:21:35</label>
		</div>
		<div class="info4">待办事项：请支付预约金(<label>42,500</label>元)/服务费(<label>1,500</label>元)，到合同指定帐号。</div>
	</div>
	<div class="msgitem" onclick="location.href='buyinfo.php'">
		<div class="info1">
			B101101101<label>2018/07/19 12:21:35</label>
		</div>
		<div class="info4">待办事项：请支付货款(<label>42,500</label>元)/利息(<label>50</label>元)，到合同指定帐号。</div>
	</div>
</div>
<?php
    include 'inc/bot.php';
?>