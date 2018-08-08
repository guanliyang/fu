<?php
    include 'inc/top.php';
?>
<script type="text/javascript">
	pSet('3');
	onload = function(){cpay();}
	function cpri(cval){
		var epri = eval(document.getElementById('rpri').innerText.replace(',', ''))+20;
		var pri1 = eval(document.getElementById('pri1').innerText.replace(',', ''));
		var npri = pri1+(cval*5);
		if(npri>epri) {
			alert('定价上限不得超出市场价格合理范围。');

		}else{
			document.getElementById('pri1').innerText =  i2s3(npri);
		}
		cpay();
	}
	function cpay(){
		var pri1 = eval(document.getElementById('pri1').innerText.replace(',', ''));
		var weig = document.getElementById('sweight').value;
		var opay = pri1*weig*0.2;
		var spay = pri1*weig*0.01;
		document.getElementById('opay').innerText = i2s3(opay);
		document.getElementById('spay').innerText = i2s3(spay);
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
			<label>:: 预约购买提交 ::</label>　　
		</div>
		<div class="list">
			<<a href="">返回</a>>
			<table>
				<tr>
					<td width="30"></td>
					<td colspan="2">品名：<select><option>玉米</option></select>　 　 年份：<select><option>2018</option></select>　 　 产地：<select><option>辽宁</option></select>　 　 等级：<select><option>一等</option></select>　 　 容重：<select><option>720</option></select>g/l</td>
				</tr>
				<tr>
					<td></td>
					<td width="500">预购单价：<input class="bt inpss" value="-" type="button" onclick="cpri(-1);"/> <label id="pri1">1,700</label> <input class="bt inpss" value="+" type="button" onclick="cpri(1);"/> 元/吨</td>
					<td>今日市场参考价：<br/><label class="fontbig" id="rpri">1,700</label> 元/吨</td>
				</tr>
				<tr>
					<td></td>
					<td>预购重量：<input name="sweight" id="sweight" class="inpsm" value="" type="text" onchange="cpay();"/> 吨</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td>需缴预约金：<label id="opay">0</label> 元 （预约成功后，将直接转为货款)</td>
					<td>需缴服务费：<label id="spay">0</label> 元 （预购货款的1%）</td>
				</tr>
				<tr>
					<th></th>
					<th colspan="2">预约购粮，不代表能立即成交，需等待平台运营人员协调资源后，方可回复是否能够转正式订单。</th>
				</tr>
			</table>
		</div>
		<<a href="viewcont.php">预览预购要约</a>>　　　　<input type="checkbox" class="bt_s"/> 我已阅读并了解要约详细内容，同意签属并确认其法律效力。
		<div class="list_page">
			<input class="bt bt_s" value="正式提交预购" type="button"/>
		</div>
	</div>
</div>
<?php
    include 'inc/bot.php';
?>