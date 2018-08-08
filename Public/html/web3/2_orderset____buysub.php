<?php
    include 'inc/top.php';
?>
<script type="text/javascript">
	pSet('3');
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
					pay = npay+freight;
				}else{
					document.getElementById('trRadd').style['display'] = 'none';
					document.getElementById('trRcon').style['display'] = 'none';
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

<div class="bdiv cont">
	<div class="content">
		<div class="list_item">
			<label>:: 订单结算 ::</label>　　
		</div>
		<div class="list">
			<<a href="">返回购物车</a>>
			<table>
				<tr>
					<th width="60"></th>
					<th class="tdlock">玉米　2018年　辽宁　一等　容重720g/l　单价：<label>1,700</label>元</th>
					<th>1组　(2箱　净重：50吨)</th>
					<th width="150" class="tdright"><label>85,000</label>元</th>
				</tr>
				<tr>
					<th width="60"></th>
					<th>玉米　2016年　吉林　一等　容重715g/l　单价：<label>1,690</label>元</th>
					<th>2组　(4箱　净重：100吨)</th>
					<th width="150" class="tdright"><label>169,000</label>元</th>
				</tr>
			</table>
			<table>
				<tr>
					<td width="60"></td>
					<td colspan="6" class="tdright">订单货款合计：</td>
					<td width="150" class="tdright"><label id="total">254,000</label>元</td>
				</tr>
				<tr>
					<td></td>
					<td width="90">付款方式：</td>
					<td width="30"><input type="radio" name="payment" class="bt_s" value="1" checked onclick="iSet();" /></td>
					<td width="120">20%首付</td>
					<td width="30"><input type="radio" name="payment" class="bt_s" value="2" onclick="iSet();"/></td>
					<td width="120">全款</td>
					<td class="tdright">即付货款：</td>
					<td class="tdright"><label id="npay">0</label>元</td>
				</tr>
				<tr id="tr20pay">
					<td></td>
					<td colspan="6" class="tdright">尾款：<br/>* 到岸支付尾款，尾款计息，按实际天数收取。　　　(<label id="epayi">0</label>x<label id="dinte">0.0002</label>日利率)=日利息：</td>
					<td class="tdright"><label id="epay">0</label>元<br/><label id="dipay">0</label>元</td>
				</tr>
			</table>
			<table>
				<tr>
					<td width="60"></td>
					<td width="90">收货方式：</td>
					<td width="30"><input type="radio" name="recmode" class="bt_s" value="1" checked  onclick="iSet();"/></td>
					<td width="200">平台物流到门(运费：<label id="freight">1,200</label>元)</td>
					<td></td>
					<td width="30"><input type="radio" name="recmode" class="bt_s" value="2"  onclick="iSet();"/></td>
					<td>自行进港提货(提货即视为确认收货)</td>
				</tr>
				<tr id="trRadd">
					<td></td>
					<td>收货地址：</td>
					<td colspan="5"><select><option>辽宁</option></select>　<select><option>沈阳</option></select>　<select><option>和平区</option></select>　<input name="cpaddress" value="xx街道xx号" type="text" class="inpbig" /></td>
				</tr>
				<tr id="trRcon">
					<td width="60"></td>
					<td width="90">　联系人：</td>
					<td colspan="2"><input name="cpcont" value="赵钱孙" type="text"/></td>
					<td width="90">　手机号：</td>
					<td colspan="2"><input name="cpmobi" value="13910533527" type="text"/></td>
				</tr>
			</table>
			<table>
				<tr>
					<td></td>
					<td width="150" class="tdright"><label>提交后需付款：</label></td>
					<td width="150" class="tdright"><label id="pay">0</label>元</td>
				</tr>
			</table>
		</div>
		<<a href="viewcont.php">预览购买合同</a>>　　　　<input type="checkbox" class="bt_s"/> 我已阅读并了解合同详细内容，同意签属并确认其法律效力。
		<div class="list_page">
			<input class="bt bt_s" value="正式提交订单" type="button"/>
		</div>
	</div>
</div>
<?php
    include 'inc/bot.php';
?>