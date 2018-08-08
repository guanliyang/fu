<?php
    include 'inc/top.php';
?>
<script type="text/javascript">
	pSet('3');
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
		var total = pri1*weig;
		var depo = total*0.2;
		document.getElementById('total').innerText = i2s3(total);
		document.getElementById('depo').innerText = i2s3(depo);
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
			<label>:: 卖粮货单提交 ::</label>　　
		</div>
		<div class="list">
			<<a href="">返回</a>>
			<table>
				<tr>
					<td width="30" rowspan="5"></td>
					<td width="230" rowspan="5"><img src="" width="200" height="200" /><br/>　粮食近照　　　　(点击上传)</td>
					<td>　品名：<select><option>玉米</option></select>　 年份：<select><option>2018</option></select>　 产地：<select><option>辽宁</option></select>　 等级：<select><option>一等</option></select>　 容重：<select><option>720</option></select>g/l</td>
				</tr>
				<tr>
					<td>　霉变：<input name="mbvalue" value="" type="text" class="inpss" /> %　水份：<input name="sfvalue" value="" type="text" class="inpss" /> %　杂质：<input name="zzvalue" value="" type="text" class="inpss" /> %　呕吐毒素：<input name="otvalue" value="" type="text" class="inpsm" /> μg/kg</td>
				</tr>
				<tr>
					<td>　出售单价：<input class="bt inpss" value="-" type="button" onclick="cpri(-1);"/> <label id="pri1">1,700</label> <input class="bt inpss" value="+" type="button" onclick="cpri(1);"/> 元/吨　　　　　　　　今日市场参考价：<br/>　　　　　（提交后也可以随时调价）　　　　　　　<label class="fontbig" id="rpri">1,700</label> 元/吨</td>
				</tr>
				<tr>
					<td>　出售重量：<input name="sweight" id="sweight" class="inpsm" value="" type="text" onchange="cwei();"/> 吨 (约需 <label id="bsum">0</label> 个集装箱)　　　　入港运费：<label id="freight">0</label> 元 (<label id="tfrei">1,200</label>元/车，需要<label id="tsum">0</label>车)</td>
				</tr>
				<tr>
					<td>　需缴保证金：<label id="depo">0</label> 元 （货款总价<label id="total">0</label>的20%，成交后即退保证金）</td>
				</tr>
			</table>
			<table>
				<tr>
					<td width="40"></td>
					<td>装货地址：</td>
					<td colspan="5"><select><option>辽宁</option></select>　<select><option>沈阳</option></select>　<select><option>和平区</option></select>　<input name="lpaddress" value="xx街道xx号" type="text" class="inpbig" /></td>
				</tr>
				<tr>
					<td ></td>
					<td width="90">　联系人：</td>
					<td width="200"><input name="lpcont" value="赵钱孙" type="text"/></td>
					<td width="30"></td>
					<td width="90">　手机号：</td>
					<td><input name="lpmobi" value="13910533527" type="text"/></td>
				</tr>
			</table>
		</div>
		<<a href="viewcont.php">预览出售合同</a>>　　　　<input type="checkbox" class="bt_s"/> 我已阅读并了解合同详细内容，同意签属并确认其法律效力。
		<div class="list_page">
			<input class="bt bt_s" value="正式提交货单" type="button"/>
		</div>
	</div>
</div>
<?php
    include 'inc/bot.php';
?>