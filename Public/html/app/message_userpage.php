<?php
    include 'inc/top.php';
?>
<script type="text/javascript">
	onload = function(){
		document.getElementById('list1').style['display'] = 'none';
		document.getElementById('list2').style['display'] = 'none';
		document.getElementById('list3').style['display'] = 'none';
		document.getElementById('ft1').style['display'] = 'none';
		document.getElementById('ft2').style['display'] = 'none';
		document.getElementById('ft3').style['display'] = 'none';
		var itemval = GetQueryString('item');
		if(itemval==null) itemval=1;
		document.getElementById('list'+itemval).style['display'] = '';
		document.getElementById('ft'+itemval).style['display'] = '';
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
	<div class="ind">
		<label><a href="userinfo.php">赵钱孙</a></label>
		<a href="sysmsg.php">系统通知(8)</a>
	</div>
	<div class="pboard">
		<h4>高品质玉米：</h4>
		<h5>今日市场参考价</h5>
		<h6>锦州港　容重<b>720</b>g/l　生霉<b>1.2</b>%　　　　　　　　　元/吨</h6>
		<h2>1,700</h2>
	</div>
</div>
<div class="cont">
	<div class="item_tit">
		<a href="?item=1" id="item1">买粮(56)</a><a href="?item=2" id="item2">预购(2)</a><a href="?item=3" id="item3">卖粮(4)</a>
	</div>
</div>
<div class="item_list" id="list1">
	<div class="item" onclick="location.href='buyinfo.php'">
		<div class="info1">
			B101101101<label>2018/07/19 12:21:35</label>
		</div>
		<div class="info2">玉米　　2018年/辽宁/一等　　容重：720g/l</div>
		<div class="info3"><b>100</b>吨　　<b>1,700</b>元/吨<label><b>待办事项...</b></label></div>
	</div>
	<div class="item" onclick="location.href='buyinfo.php'">
		<div class="info1">
			B101101101<label>2018/07/19 12:21:35</label>
		</div>
		<div class="info2">玉米　　2018年/辽宁/一等　　容重：720g/l</div>
		<div class="info3"><b>100</b>吨　　<b>1,700</b>元/吨<label>订单详情...</label></div>
	</div>
	<div class="item" onclick="location.href='buyinfo.php'">
		<div class="info1">
			B101101101<label>2018/07/19 12:21:35</label>
		</div>
		<div class="info2">玉米　　2018年/辽宁/一等　　容重：720g/l</div>
		<div class="info3"><b>100</b>吨　　<b>1,700</b>元/吨<label><b>待办事项...</b></label></div>
	</div>
	<div class="item" onclick="location.href='buyinfo.php'">
		<div class="info1">
			B101101101<label>2018/07/19 12:21:35</label>
		</div>
		<div class="info2">玉米　　2018年/辽宁/一等　　容重：720g/l</div>
		<div class="info3"><b>100</b>吨　　<b>1,700</b>元/吨<label>订单详情...</label></div>
	</div>
	<div class="item" onclick="location.href='buyinfo.php'">
		<div class="info1">
			B101101101<label>2018/07/19 12:21:35</label>
		</div>
		<div class="info2">玉米　　2018年/辽宁/一等　　容重：720g/l</div>
		<div class="info3"><b>100</b>吨　　<b>1,700</b>元/吨<label><b>待办事项...</b></label></div>
	</div>
	<div class="item" onclick="location.href='buyinfo.php'">
		<div class="info1">
			B101101101<label>2018/07/19 12:21:35</label>
		</div>
		<div class="info2">玉米　　2018年/辽宁/一等　　容重：720g/l</div>
		<div class="info3"><b>100</b>吨　　<b>1,700</b>元/吨<label>订单详情...</label></div>
	</div>
	<div class="item" onclick="location.href='buyinfo.php'">
		<div class="info1">
			B101101101<label>2018/07/19 12:21:35</label>
		</div>
		<div class="info2">玉米　　2018年/辽宁/一等　　容重：720g/l</div>
		<div class="info3"><b>100</b>吨　　<b>1,700</b>元/吨<label><b>待办事项...</b></label></div>
	</div>
	<div class="item" onclick="location.href='buyinfo.php'">
		<div class="info1">
			B101101101<label>2018/07/19 12:21:35</label>
		</div>
		<div class="info2">玉米　　2018年/辽宁/一等　　容重：720g/l</div>
		<div class="info3"><b>100</b>吨　　<b>1,700</b>元/吨<label>订单详情...</label></div>
	</div>
	<div class="item" onclick="location.href='buyinfo.php'">
		<div class="info1">
			B101101101<label>2018/07/19 12:21:35</label>
		</div>
		<div class="info2">玉米　　2018年/辽宁/一等　　容重：720g/l</div>
		<div class="info3"><b>100</b>吨　　<b>1,700</b>元/吨<label><b>待办事项...</b></label></div>
	</div>
	<div class="item" onclick="location.href='buyinfo.php'">
		<div class="info1">
			B101101101<label>2018/07/19 12:21:35</label>
		</div>
		<div class="info2">玉米　　2018年/辽宁/一等　　容重：720g/l</div>
		<div class="info3"><b>100</b>吨　　<b>1,700</b>元/吨<label>订单详情...</label></div>
	</div>
</div>

<div class="item_list" id="list2">
	<div class="item" onclick="location.href='offerinfo.php'">
		<div class="info1">
			R101101101<label>2018/07/19 12:21:35</label>
		</div>
		<div class="info2">玉米　　2018年/辽宁/一等　　容重：720g/l</div>
		<div class="info3"><b>100</b>吨<label>预约采购中...</label></div>
	</div>
	<div class="item" onclick="location.href='offerinfo.php'">
		<div class="info1">
			R101101101<label>2018/07/19 12:21:35</label>
		</div>
		<div class="info2">玉米　　2018年/辽宁/一等　　容重：720g/l</div>
		<div class="info3"><b>100</b>吨<label><b>待支付预约金...</b></label></div>
	</div>
</div>

<div class="item_list" id="list3">
	<div class="item" onclick="location.href='saleinfo.php'">
		<div class="info1">
			S101101101<label>2018/07/19 12:21:35</label>
		</div>
		<div class="info2">玉米　　2018年/辽宁/一等　　容重：720g/l</div>
		<div class="info3"><b>100</b>吨　　<b>1,700</b>元/吨<label><b>待办事项...</b></label></div>
	</div>
	<div class="item" onclick="location.href='saleinfo.php'">
		<div class="info1">
			S101101102<label>2018/07/19 12:21:35</label>
		</div>
		<div class="info2">玉米　　2018年/辽宁/一等　　容重：720g/l</div>
		<div class="info3"><b>100</b>吨　　<b>1,700</b>元/吨<label>货单详情...</label></div>
	</div>
	<div class="item" onclick="location.href='saleinfo.php'">
		<div class="info1">
			S101101101<label>2018/07/19 12:21:35</label>
		</div>
		<div class="info2">玉米　　2018年/辽宁/一等　　容重：720g/l</div>
		<div class="info3"><b>100</b>吨　　<b>1,700</b>元/吨<label><b>待办事项...</b></label></div>
	</div>
	<div class="item" onclick="location.href='saleinfo.php'">
		<div class="info1">
			S101101102<label>2018/07/19 12:21:35</label>
		</div>
		<div class="info2">玉米　　2018年/辽宁/一等　　容重：720g/l</div>
		<div class="info3"><b>100</b>吨　　<b>1,700</b>元/吨<label>货单详情...</label></div>
	</div>
</div>
<div class="item_ft" id="footer">
	<div id="ft1">
		<div><a href="salelist.php">在售粮源</a></div>
		<div><a href="cart.php">购物车(8)</a></div>
	</div>
	<div id="ft2">
		<div><a href="offersub.php">我要预购</a></div>
	</div>
	<div id="ft3">
		<div><a href="salesub.php">我要卖粮</a></div>
	</div>
</div>
<?php
    include 'inc/bot.php';
?>
<script type="text/javascript">
	footerM();
	window.onresize = function(){
	 	footerM();
	}
	function footerM(){
		document.getElementById('footer').style['top'] = document.documentElement.clientHeight-60+'px';
		var itemval = GetQueryString('item');
		if(itemval==null) itemval=1;
		document.getElementById('list'+itemval).style['min-height'] = document.documentElement.clientHeight-230+'px';
	}
</script>