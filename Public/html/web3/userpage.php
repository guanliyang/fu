<?php
    include 'inc/top.php';
?>
<script type="text/javascript">
	pSet('3');
	onload = function(){
		document.getElementById('list1').style['display'] = 'none';
		document.getElementById('list2').style['display'] = 'none';
		document.getElementById('list3').style['display'] = 'none';
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
<div class="bdiv cont">
	<div class="content">
		<div class="pboard">
			<h2>高品质玉米：</h2>
			<h5>今日市场参考价</h5>
			<h4>锦州港　容重<b>720</b>g/l　霉变<b>1.2</b>%　　　　　　　　　　元 / 吨</h4>
			<h1>1,700</h1>
		</div>
		<div class="uboard">
			<h3>成交订单： 12,380 笔</h3>
			<h3>注册会员： 32,181 人</h3>
			<div>
				<a href=""><img src="img/bt_buy.png"/></a>
				<a href=""><img src="img/bt_sal.png"/></a>
			</div>
		</div>
	</div>
	<div class="content">
		<div class="list_item">
			您好，<a href="">用户名</a>(<a href="">设置</a>)。 <a href="">8条待处理</a>信息;  <a href="">8组待购买</a>货物。
			<div class="item">
				<a href="?item=3" id="item3">卖粮货单(4)</a>
				<a href="?item=2" id="item2">预购约单(2)</a>
				<a href="?item=1" id="item1">买粮订单(56)</a>
			</div>
		</div>
		<div class="list" id="list1">
			<table>
				<tr onmouseover="this.style['background']='#F0ECE1';"  onmouseout="this.style['background']='#FFF';">
					<td><a href="">订单号：B101101101</a></td>
					<td>2018年07月19日 12:21:35</td>
					<td>玉米</td>
					<td>2018年</td>
					<td>辽宁</td>
					<td>一等</td>
					<td>容重：720g/l</td>
					<td>100吨</td>
					<td>1,700元/吨</td>
					<td><a href="">查看订单详情...</a></td>	
				</tr>
				<tr onmouseover="this.style['background']='#F0ECE1';"  onmouseout="this.style['background']='#FFF';">
					<td><a href="">订单号：B101101101</a></td>
					<td>2018年07月19日 12:21:35</td>
					<td>玉米</td>
					<td>2018年</td>
					<td>辽宁</td>
					<td>一等</td>
					<td>容重：720g/l</td>
					<td>100吨</td>
					<td>1,700元/吨</td>
					<td><a href="" class="hot">待办事项(2)...</a></td>	
				</tr>
				<tr onmouseover="this.style['background']='#F0ECE1';"  onmouseout="this.style['background']='#FFF';">
					<td><a href="">订单号：B101101101</a></td>
					<td>2018年07月19日 12:21:35</td>
					<td>玉米</td>
					<td>2018年</td>
					<td>辽宁</td>
					<td>一等</td>
					<td>容重：720g/l</td>
					<td>100吨</td>
					<td>1,700元/吨</td>
					<td><a href="">查看订单详情...</a></td>	
				</tr>
				<tr onmouseover="this.style['background']='#F0ECE1';"  onmouseout="this.style['background']='#FFF';">
					<td><a href="">订单号：B101101101</a></td>
					<td>2018年07月19日 12:21:35</td>
					<td>玉米</td>
					<td>2018年</td>
					<td>辽宁</td>
					<td>一等</td>
					<td>容重：720g/l</td>
					<td>100吨</td>
					<td>1,700元/吨</td>
					<td><a href="">查看订单详情...</a></td>	
				</tr>
				<tr onmouseover="this.style['background']='#F0ECE1';"  onmouseout="this.style['background']='#FFF';">
					<td><a href="">订单号：B101101101</a></td>
					<td>2018年07月19日 12:21:35</td>
					<td>玉米</td>
					<td>2018年</td>
					<td>辽宁</td>
					<td>一等</td>
					<td>容重：720g/l</td>
					<td>100吨</td>
					<td>1,700元/吨</td>
					<td><a href="">查看订单详情...</a></td>	
				</tr>
				<tr onmouseover="this.style['background']='#F0ECE1';"  onmouseout="this.style['background']='#FFF';">
					<td><a href="">订单号：B101101101</a></td>
					<td>2018年07月19日 12:21:35</td>
					<td>玉米</td>
					<td>2018年</td>
					<td>辽宁</td>
					<td>一等</td>
					<td>容重：720g/l</td>
					<td>100吨</td>
					<td>1,700元/吨</td>
					<td><a href="">查看订单详情...</a></td>	
				</tr>
				<tr onmouseover="this.style['background']='#F0ECE1';"  onmouseout="this.style['background']='#FFF';">
					<td><a href="">订单号：B101101101</a></td>
					<td>2018年07月19日 12:21:35</td>
					<td>玉米</td>
					<td>2018年</td>
					<td>辽宁</td>
					<td>一等</td>
					<td>容重：720g/l</td>
					<td>100吨</td>
					<td>1,700元/吨</td>
					<td><a href="">查看订单详情...</a></td>	
				</tr>
				<tr onmouseover="this.style['background']='#F0ECE1';"  onmouseout="this.style['background']='#FFF';">
					<td><a href="">订单号：B101101101</a></td>
					<td>2018年07月19日 12:21:35</td>
					<td>玉米</td>
					<td>2018年</td>
					<td>辽宁</td>
					<td>一等</td>
					<td>容重：720g/l</td>
					<td>100吨</td>
					<td>1,700元/吨</td>
					<td><a href="">查看订单详情...</a></td>	
				</tr>
				<tr onmouseover="this.style['background']='#F0ECE1';"  onmouseout="this.style['background']='#FFF';">
					<td><a href="">订单号：B101101101</a></td>
					<td>2018年07月19日 12:21:35</td>
					<td>玉米</td>
					<td>2018年</td>
					<td>辽宁</td>
					<td>一等</td>
					<td>容重：720g/l</td>
					<td>100吨</td>
					<td>1,700元/吨</td>
					<td><a href="" class="hot">待办事项(2)...</a></td>	
				</tr>
				<tr onmouseover="this.style['background']='#F0ECE1';"  onmouseout="this.style['background']='#FFF';">
					<td><a href="">订单号：B101101101</a></td>
					<td>2018年07月19日 12:21:35</td>
					<td>玉米</td>
					<td>2018年</td>
					<td>辽宁</td>
					<td>一等</td>
					<td>容重：720g/l</td>
					<td>100吨</td>
					<td>1,700元/吨</td>
					<td><a href="">查看订单详情...</a></td>	
				</tr>				
			</table>
			<div class="list_page"><a href="" class="hot">1</a><a href="">2</a><a href="">3</a><a href="">4</a><a href="">5</a><a href="">>></a></div>
		</div>
		<div class="list" id="list2">
			<table>
				<tr onmouseover="this.style['background']='#F0ECE1';"  onmouseout="this.style['background']='#FFF';">
					<td><a href="">预约号：R101101101</a></td>
					<td>2018年07月19日 12:21:35</td>
					<td>玉米</td>
					<td>2018年</td>
					<td>辽宁</td>
					<td>一等</td>
					<td>容重：720g/l</td>
					<td>100吨</td>
					<td></td>
					<td><a href="">预约采购中...</a></td>	
				</tr>
				<tr onmouseover="this.style['background']='#F0ECE1';"  onmouseout="this.style['background']='#FFF';">
					<td><a href="">预约号：R101101102</a></td>
					<td>2018年07月19日 12:21:35</td>
					<td>玉米</td>
					<td>2018年</td>
					<td>辽宁</td>
					<td>一等</td>
					<td>容重：720g/l</td>
					<td>100吨</td>
					<td></td>
					<td><a href="" class="hot">待支付预约金...</a></td>	
				</tr>			
			</table>
		</div>
		<div class="list" id="list3">
			<table>
				<tr onmouseover="this.style['background']='#F0ECE1';"  onmouseout="this.style['background']='#FFF';">
					<td><a href="">货单号：S101101101</a></td>
					<td>2018年07月19日 12:21:35</td>
					<td>玉米</td>
					<td>2018年</td>
					<td>辽宁</td>
					<td>一等</td>
					<td>容重：720g/l</td>
					<td>100吨</td>
					<td>1,700元/吨</td>
					<td><a href="">查看货单详情...</a></td>	
				</tr>
				<tr onmouseover="this.style['background']='#F0ECE1';"  onmouseout="this.style['background']='#FFF';">
					<td><a href="">货单号：S101101102</a></td>
					<td>2018年07月19日 12:21:35</td>
					<td>玉米</td>
					<td>2018年</td>
					<td>辽宁</td>
					<td>一等</td>
					<td>容重：720g/l</td>
					<td>100吨</td>
					<td>1,700元/吨</td>
					<td><a href="" class="hot">待办事项(2)...</a></td>	
				</tr>
				<tr onmouseover="this.style['background']='#F0ECE1';"  onmouseout="this.style['background']='#FFF';">
					<td><a href="">货单号：S101101103</a></td>
					<td>2018年07月19日 12:21:35</td>
					<td>玉米</td>
					<td>2018年</td>
					<td>辽宁</td>
					<td>一等</td>
					<td>容重：720g/l</td>
					<td>100吨</td>
					<td>1,700元/吨</td>
					<td><a href="">查看订单详情...</a></td>	
				</tr>
				<tr onmouseover="this.style['background']='#F0ECE1';"  onmouseout="this.style['background']='#FFF';">
					<td><a href="">货单号：S101101104</a></td>
					<td>2018年07月19日 12:21:35</td>
					<td>玉米</td>
					<td>2018年</td>
					<td>辽宁</td>
					<td>一等</td>
					<td>容重：720g/l</td>
					<td>100吨</td>
					<td>1,700元/吨</td>
					<td><a href="" class="hot">待办事项(2)...</a></td>	
				</tr>				
			</table>
		</div>
	</div>
</div>
<?php
    include 'inc/bot.php';
?>