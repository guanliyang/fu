<?php
    include 'inc/top.php';
?>
<script type="text/javascript">
	onload = function(){iSet();}
	function iSet(){
		var eventdx = document.getElementsByTagName('input');
		var total = eval(document.getElementById('total').innerText.replace(',', ''));
		var npay = 0;
		var epay = 0;
		var pay = 0;
		for (var i=0;i<eventdx.length;i++){
			if(eventdx[i].name=='payment' && eventdx[i].checked){
				if(eventdx[i].value=='1'){
					document.getElementById('tr20pay').style['display'] = '';
					npay = total*0.2;
					epay = total-npay;
					var dinte = eval(document.getElementById('dinte').innerText);
					document.getElementById('epay').innerText = i2s3(epay);
					document.getElementById('epayi').innerText = i2s3(epay);
					document.getElementById('dipay').innerText = i2s3(epay*dinte);
				}else{
					document.getElementById('tr20pay').style['display'] = 'none';
					npay = total;
					
				}
			}
			document.getElementById('npay').innerText = i2s3(npay);
			if(eventdx[i].name=='recmode' && eventdx[i].checked){
				if(eventdx[i].value=='1'){
					var freight = eval(document.getElementById('freight').innerText.replace(',', ''));
					document.getElementById('trRadd').style['display'] = '';
					document.getElementById('trRcon').style['display'] = '';
					document.getElementById('tr1info').style['display'] = '';
					document.getElementById('tr2info').style['display'] = 'none';
					pay = npay+freight;
				}else{
					document.getElementById('trRadd').style['display'] = 'none';
					document.getElementById('trRcon').style['display'] = 'none';
					document.getElementById('tr1info').style['display'] = 'none';
					document.getElementById('tr2info').style['display'] = '';
					pay = npay;
				}
			}
			document.getElementById('pay').innerText = i2s3(pay);
		}
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
	<div class="tit"><a href="#" onclick="window.history.go(-1);"><返回修改</a>订单结算</div>
	<hr>
	<div class="bill_info"><label>玉米</label><label>2016</label><label>吉林</label><label>一等</label><label>1,690元/吨</label><label>1组(2箱　净重50吨)</label><label>合计：84,500元</label></label></div>
	<div class="bill_info"><label>玉米</label><label>2018</label><label>辽宁</label><label>一等</label><label>1,700元/吨</label><label>2组(4箱　净重100吨)</label><label>合计：170,000元</label></label></div>

	<div class="bill_item">货款合计：<label><b id="total">254,000</b> 元</label></div>
	<div class="bill_item">
		<table>
			<tr>
				<td width="80">付款方式：</td>
				<td><input type="radio" name="payment" class="bt_s" value="1" checked onclick="iSet();" />20%首付</td>
			</tr>
			<tr>
				<td></td>
				<td><input type="radio" name="payment" class="bt_s" value="2" onclick="iSet();"/>全款</td>
			</tr>
			<tr id="tr20pay">
				<td colspan="2" class="tdright">尾款：<label><b id="epay">0</b> 元</label><br/>* 到岸支付尾款，尾款计息，按实际天数收取。<br/>(<b id="epayi">0</b>x<b id="dinte">0.0002</b>日利率)=日利息：<b id="dipay">0</b>元
				</td>
			</tr>
		</table>
	</div>
	<div class="bill_item">即付货款：<label><b id="npay">0</b> 元</label></div>
	<div class="bill_item">
		<table>
			<tr>
				<td width="80">收货方式：</td>
				<td><input type="radio" name="recmode" class="bt_s" value="1" checked  onclick="iSet();"/>送货到门　　<input type="radio" name="recmode" class="bt_s" value="2"  onclick="iSet();"/>自行提货</td>
			</tr>
			<tr id="tr1info">
				<td></td>
				<td>沈阳(3车)运费：<label><b id="freight">3,600</b> 元</label></td>
			</tr>
			<tr id="tr2info">
				<td></td>
				<td>* 提货即视为确认收货</td>
			</tr>
		</table>
		<table id="trRadd">
			<tr>
				<td width="80">收货地址：</td>
				<td><select><option>辽宁</option></select><select><option>沈阳</option></select><select><option>和平区</option></select></td>
			</tr>
			<tr>
				<td></td>
				<td><input name="cpaddress" value="xx街道xx号" type="text"/></td>
			</tr>
		</table>
		<table id="trRcon">
			<tr>
				<td width="80">　联系人：</td>
				<td><input name="cpcont" value="赵钱孙" type="text"/></td>
			</tr>
			<tr id="trRcon">
				<td>　手机号：</td>
				<td><input name="cpmobi" value="13910533527" type="text"/></td>
			</tr>
		</table>
	</div>
	<div class="bill_item">提交后需付款：<label><b id="pay">0</b> 元</label></div>
</div>
<div class="cont">
	<<a href="viewcont.php">预览购买合同</a>><br/><input type="checkbox" class="bt_s"/> 我已阅读并了解合同详细内容，同意签属并确认其法律效力。
	<hr>
	<input class="bt bt_s" value="正式提交订单" type="button"/>
</div>
<?php
    include 'inc/bot.php';
?>