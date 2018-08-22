<?php
    include 'inc/top.php';
?>
<script type="text/javascript">
	onload = function(){cwei();}
	function cpri(cval){
		var epri = eval(document.getElementById('rpri').innerText.replace(',', ''))+20;
		var pri1 = eval(document.getElementById('pri1').innerText.replace(',', ''));
		var npri = pri1+(cval*5);
		if(npri>epri) {
			alert('定价上限不得超出市场价格合理范围。');

		}else{
			document.getElementById('pri1').innerText =  i2s3(npri);
		}
		ctotal();
	}
	function cwei(){
		var weig = document.getElementById('sweight').value;
		var bsum = Math.ceil(weig/26);
		document.getElementById('bsum').innerText = bsum;
		var tfrei = eval(document.getElementById('tfrei').innerText.replace(',', ''));
		var tsum =  Math.ceil(bsum/2);
		var freight = tfrei*tsum;
		document.getElementById('freight').innerText = i2s3(freight);
		document.getElementById('tsum').innerText = tsum;
		ctotal();
	}
	function ctotal(){
		var pri1 = eval(document.getElementById('pri1').innerText.replace(',', ''));
		var weig = document.getElementById('sweight').value;
		var frei = eval(document.getElementById('freight').innerText.replace(',', ''));
		var total = pri1*weig;
		var depo = total*0.2;
		var pay = depo + frei;
		document.getElementById('total').innerText = i2s3(total);
		document.getElementById('depo').innerText = i2s3(depo);
		document.getElementById('pay').innerText = i2s3(pay);
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
	<div class="tit"><a href="#" onclick="window.history.go(-1);"><返回修改</a>卖粮提交</div>
	<hr>
	<div class="bill_info"><img src="" width="200" height="200" /><br/>粮食近照 (点击上传)</div>
	<div class="bill_item">一等玉米　<select><option>2018</option></select><select><option>辽宁</option></select><select><option>720</option></select>g/l</div>
	<div class="bill_item">霉变：<input name="mbvalue" value="" type="text" class="inpss" />%　水份：<input name="sfvalue" value="" type="text" class="inpss" />%</div>
	<div class="bill_item">杂质：<input name="zzvalue" value="" type="text" class="inpss" />%　呕吐毒素：<input name="otvalue" value="" type="text" class="inpsm" />μg/kg</div>
	<div class="bill_item">出售单价：<input class="bt inpss" value="-" type="button" onclick="cpri(-1);"/> <b><span id="pri1">1,700</span></b> <input class="bt inpss" value="+" type="button" onclick="cpri(1);"/> 元/吨
		<br/><label>市场参考价：<b id="rpri">1,700</b>元/吨</label><br/>(提交后也可以随时调价)</div>
	<div class="bill_item">出售重量：<input name="sweight" id="sweight" class="inpsm" value="" type="text" onchange="cwei();"/> 吨<label>(约需<b id="bsum">0</b>个集装箱)</label><br/>&nbsp;<label>入港运费：<b id="freight">0</b> 元</label><br/>&nbsp;<label>(<b id="tfrei">1,200</b> 元/车，需要 <b id="tsum">0</b> 车)</label></div>
	<div class="bill_item">需缴保证金：<label><b id="depo">0</b> 元</label><br/>(货款<b id="total">0</b>元的20%，成交后即退保证金)</div>
	<div class="bill_item">装货地址：<select><option>辽宁</option></select><select><option>沈阳</option></select><select><option>和平区</option></select><br/>　　　　　<input name="lpaddress" value="xx街道xx号" type="text" /><br/>　联系人：<input name="lpcont" value="赵钱孙" type="text"/><br/>　手机号：<input name="lpmobi" value="13910533527" type="text"/></div>
	<div class="bill_item">提交后需付款：<label><b id="pay">0</b> 元</label></div>
</div>
<div class="cont">
	<<a href="viewcont.php">预览出售合同</a>><br/><input type="checkbox" class="bt_s"/> 我已阅读并了解合同详细内容，同意签属并确认其法律效力。
	<hr>
	<input class="bt bt_s" value="正式提交货单" type="button"/>
</div>

<?php
    include 'inc/bot.php';
?>