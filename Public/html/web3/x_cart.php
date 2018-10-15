<?php
    include 'inc/top.php';
?>
<script type="text/javascript">
	pSet('3');
	function iSel(selid){
		objSel = document.getElementById(selid);
		if(objSel.checked){
			objSel.checked =false;
			document.getElementById('tr'+selid).setAttribute("class", 'selc cool');
		}else{
			objSel.checked =true;
			document.getElementById('tr'+selid).setAttribute("class", 'selc');
		}
		iSet();
	}
	onload = function(){iSet();}
	function iSet(){
		var eventdx = document.getElementsByTagName('input');
		var selpay = 0;
		var selsum = 0;
		for (var i=0;i<eventdx.length;i++){
			if(eventdx[i].name=='buyid' && eventdx[i].checked){
				document.getElementById('tr'+eventdx[i].value).setAttribute('class', 'selc');
				selsum++;
				selpay += eval(document.getElementById('pay'+eventdx[i].value).innerText.replace(',', ''));
			}
		}
		selpay0 = selpay*0.2;
		document.getElementById('selsum').innerText = selsum;
		document.getElementById('selpay').innerText = i2s3(selpay);
		document.getElementById('selpay0').innerText = i2s3(selpay0);
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
			<label>:: 购物车 ::</label>
		</div>
		<div class="list">
			<table>
				<tr>
					<th width="60"></th>
					<th class="tdlock">玉米　2018年　辽宁　一等　容重720g/l</th>
					<th>单价：<label>1,700</label>元</th>
					<th width="120"><a href="">查看粮源详情</a></th>
				</tr>
				<tr id="tr100101" class="selc cool" onclick="iSel(100101);">
					<td><input type="checkbox" name="buyid" id="100101" class="bt_s" value="100101" onclick="iSel(100101);"></td>
					<td>2箱　(毛重：60吨　皮重：10吨　净重：50吨)</td>
					<td>货款：<label id="pay100101">85,000</label>元</td>
					<td></td>
				</tr>
				<tr id="tr100203" class="selc cool" onclick="iSel(100203);">
					<td><input type="checkbox" name="buyid" id="100203" class="bt_s" value="100203" onclick="iSel(100203);"></td>
					<td>2箱　(毛重：60吨　皮重：10吨　净重：50吨)</td>
					<td>货款：<label id="pay100203">85,000</label>元</td>
					<td></td>
				</tr>
				<tr>
					<th width="60"></th>
					<th>玉米　2016年　吉林　一等　容重715g/l</th>
					<th>单价：<label>1,690</label>元</th>
					<th width="120"><a href="">查看粮源详情</a></th>
				</tr>
				<tr id="tr230211" class="selc cool" onclick="iSel(230211);">
					<td><input type="checkbox" name="buyid" id="230211" class="bt_s" value="230211" onclick="iSel(230211);"></td>
					<td>2箱　(毛重：60吨　皮重：10吨　净重：50吨)</td>
					<td>货款：<label id="pay230211">84,500</label>元</td>
					<td></td>
				</tr>
				<tr id="tr212297" class="selc cool" onclick="iSel(212297);">
					<td><input type="checkbox" name="buyid" id="212297" class="bt_s" value="212297" onclick="iSel(212297);"></td>
					<td>2箱　(毛重：60吨　皮重：10吨　净重：50吨)</td>
					<td>货款：<label id="pay212297">84,500</label>元</td>
					<td></td>
				</tr>		
			</table>
			<table>
				<tr>
					<td width="60"></td>
					<td class="tdlock">已选 <label id="selsum">0</label> 组货物</td>
					<td>合计：<label id="selpay">0</label>元<br/>(首付<label id="selpay0">0</label>元即可购买)</td>
					<td width="120"></td>
				</tr>
			</table>
		</div>
		<div class="list_page">
			<input class="bt bt_s" value="进入订单结算" type="button"/>
		</div>
	</div>
</div>
<?php
    include 'inc/bot.php';
?>