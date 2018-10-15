<?php
    include 'inc/top.php';
?>
<script type="text/javascript">
	onload = function(){cpay();}
	function cpri(cval){
		var epri = eval(document.getElementById('rpri').innerText.replace(',', ''))-20;
		var pri1 = eval(document.getElementById('pri1').innerText.replace(',', ''));
		var npri = pri1+(cval*5);
		if(npri<epri) {
			alert('报价下限不得低于市场价格合理范围。');
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

<div class="cont">
	<div class="tit"><a href="#" onclick="window.history.go(-1);"><返回修改</a>预购提交</div>
	<hr>
	<div class="bill_item">一等玉米　<select><option>2018</option></select><select><option>辽宁</option></select><select><option>720</option></select>g/l</div>
	<div class="bill_item">预购单价：<input class="bt inpss" value="-" type="button" onclick="cpri(-1);"/> <b><span id="pri1">1,700</span></b> <input class="bt inpss" value="+" type="button" onclick="cpri(1);"/> 元/吨
		<br/>&nbsp;<label>市场参考价：<b id="rpri">1,700</b>元/吨</label></div>
	<div class="bill_item">预购重量：<input name="sweight" id="sweight" class="inpsm" value="" type="text" onchange="cpay();"/> 吨</div>
	<div class="bill_item">需缴预约金：<label><span><b id="opay">0</b></span> 元</label><br/>&nbsp;<label>（预约成功后，直接转为货款)</label></div>
	<div class="bill_item">需缴服务费：<label><span><b id="spay">0</b></span> 元</label><br/>&nbsp;<label>(预购货款的1%）</label></div>
	<div class="bill_info" style="text-align:left;">预约购粮，不代表立即成交，需等待运营人员协调资源后，回复是否能够转正式订单。</div>
</div>
<div class="cont">
	<<a href="viewcont.php">预览预购要约</a>><br/><input type="checkbox" class="bt_s"/> 我已阅读并了解要约详细内容，同意签属并确认其法律效力。
	<hr>
	<input class="bt bt_s" value="正式提交预购" type="button"/>
</div>

<?php
    include 'inc/bot.php';
?>