<?php
    include 'inc/top.php';
?>
<script type="text/javascript">
	onload = function(){iSet();}
	function iSet(){
		var pri1 = eval(document.getElementById('pri1').innerText.replace(',', ''));
		var eventdx = document.getElementsByTagName('b');
		for (var i=0;i<eventdx.length;i++){
			if(eventdx[i].id.substr(0,3)=='wei'){
				var iid = eventdx[i].id.substr(3);
				var weig = eval(eventdx[i].innerText.replace(',', ''));
				var sum = pri1*weig;
				document.getElementById('sum'+iid).innerText = i2s3(sum);
				var rem = eval(document.getElementById('rem'+iid).innerText.replace(',', ''));
				var diff = sum-rem;
				var str = '';
				if(diff!=0){
					if(diff>0){
						str = '溢价：<span><b>'+i2s3(diff)+'</b></span>元';
					}else{
						str = '跌价：<span><b>-'+i2s3(Math.abs(diff))+'</b></span>元';
					}					
				}
				document.getElementById('diff'+iid).innerHTML = str;
			}
		}
	}
	function cpri(cval){
		var epri = eval(document.getElementById('rpri').innerText.replace(',', ''))+20;
		var pri1 = eval(document.getElementById('pri1').innerText.replace(',', ''));
		var npri = pri1+(cval*5);
		if(npri>epri) {
			alert('定价上限不得超出市场价格合理范围。');

		}else{
			document.getElementById('pri1').innerText =  i2s3(npri);
		}
		iSet();
	}
	function i2s3(intval){
		var reStr = '';
		var strval = String(intval).split('.');
		var ilen = strval[0].length;
		var slen = ilen%3;
		var tlen = parseInt(ilen/3);
		var tsum = 0;
		if (slen>0) {
			reStr = strval[0].substr(0,slen);
			tsum = slen;
		}
		for(var i=0;i<tlen;i++){
			if(reStr==''){
				reStr = strval[0].substr(tsum,3);
			}else{
				reStr += ','+strval[0].substr(tsum,3);
			}
			tsum += 3;
		}
		if(strval.hasOwnProperty(1)) reStr += '.'+strval[1];
		return reStr ;
	}
</script>

<div class="cont">
	<div class="tit"><a href="#" onclick="window.history.go(-1);"><返回</a>修改售价</div>
	<hr>
	<div class="bill_info"><label>货单号: S20183225485965</label></div>
	<div class="bill_info">售价：<input class="bt inpss" value="-" type="button" onclick="cpri(-1);"/> <span><b id="pri1">1,690</b></span> <input class="bt inpss" value="+" type="button" onclick="cpri(1);"/> 元/吨<br/>今日市场参考价：<b id="rpri">1,700</b> 元/吨</div>
	<div class="order_info" style="text-align:left;">(2)在售货组</div>
	<div class="order_item">
		&#8470;.1021112<label><b id="wei1021112">50</b>吨(2箱)　售款<span><b id="sum1021112">0</b></span>元</label>
		<br/>回款：<b id="rem1021112">85,000</b>元(计息<b>85</b>元)<label id="diff1021112"></label>
	</div>
	<div class="order_item">
		&#8470;.1021115<label><b id="wei1021115">51</b>吨(2箱)　售款<span><b id="sum1021115">0</b></span>元</label>
		<br/>回款：<b id="rem1021115">86,700</b>元(计息<b>85</b>元)<label id="diff1021115"></label>
	</div>
	<hr>
	<input class="bt bt_s" value="保存修改" type="button"/>　　<input class="bt bt_s" value="取消返回" type="button"/>
</div>
<?php
    include 'inc/bot.php';
?>