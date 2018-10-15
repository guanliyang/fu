<?php
    include 'inc/top.php';
?>
<script type="text/javascript">
	pSet('3');
	onload = function(){iSet();}
	function iSet(){
		var pri1 = eval(document.getElementById('pri1').innerText.replace(',', ''));
		var eventdx = document.getElementsByTagName('label');
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
						str = '溢价合计：<label>'+i2s3(diff)+'</label> 元';
					}else{
						str = '跌价合计：<label>-'+i2s3(Math.abs(diff))+'</label> 元';
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

<div class="bdiv cont">
	<div class="content">
		<div class="list_item">
			<label>:: 货单号：S101101101 - 修改单价 ::</label>　　<<a href="">返回</a>>
		</div>
		<div class="list">
			<table>
				<tr>
					<th></th>
					<th>(2) 在售货组：</th>
					<th colspan="4">出售单价：<input class="bt inpss" value="-" type="button" onclick="cpri(-1);"/> <label id="pri1">1,690</label> <input class="bt inpss" value="+" type="button" onclick="cpri(1);"/> 元/吨</th>
					<th>今日市场参考价：<label class="fontbig" id="rpri">1,700</label> 元/吨</th>
				</tr>
				<tr>
					<td></td>
					<td>货组编号：2121112</td>
					<td width="90"><label id="wei2121112">50</label>吨(2箱)</td>
					<td width="180"><label id="sum2121112">0</label>元</td>
					<td width="60">已回款：</td>
					<td><label id="rem2121112">85,000</label>元 (计息85元)</td>
					<td id="diff2121112">0</td>
				</tr>
				<tr>
					<td></td>
					<td>货组编号：2121115</td>
					<td><label id="wei2121115">50</label>吨(2箱)</td>
					<td><label id="sum2121115">0</label>元</td>
					<td>已回款：</td>
					<td><label id="rem2121115">85,000</label>元 (计息85元)</td>
					<td id="diff2121115">0</td>
				</tr>
			</table>
		</div>
		<div class="list_page">
				<input class="bt bt_s" value="保存修改" type="button"/>　　<input class="bt bt_s" value="取消返回" type="button"/>
		</div>
	</div>
</div>
<?php
    include 'inc/bot.php';
?>