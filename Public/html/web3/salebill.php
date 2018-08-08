<?php
    include 'inc/top.php';
?>
<script type="text/javascript">
	pSet('1');
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
			<label>:: 货单号：S101101101 ::</label>　　<<a href="">返回</a>>
		</div>
		<div class="list">
			<table>
				<tr>
					<th width="30" rowspan="5"></th>
					<th width="230" rowspan="5"><img src="" width="200" height="200" /></th>
					<th width="20"></th>
					<th colspan="3">品名：玉米　　年份：2016　　产地：吉林　　等级：一等　　</th>
				</tr>
				<tr>
					<th></th>
					<th colspan="3">容重：715g/l　　霉变：1.2%　　水份：13%　　杂质：2.2%　　呕吐毒素：1000μg/kg</th>
				</tr>
				<tr>
					<th></th> 
					<th width="200">单价：<label class="hot">1,690</label> 元/吨</th>
					<th width="200">净重：<label class="hot">200</label> 吨</th>
					<th></th>
				</tr>
				<tr>
					<th colspan="4">&nbsp;</th>
				</tr>
				<tr>
					<th></th>
					<th colspan="3"><a href=""><下载装货视频></a></th>
				</tr>
				<tr id="tr2121112" class="selc cool" onclick="iSel(2121112);">
					<td></td>
					<td><input type="checkbox" name="buyid" id="2121112" class="bt_s" value="2121112" onclick="iSel(2121112);">　　货组编号：2121112</td>
					<td></td>
					<td colspan="2">2箱　(毛重：60吨　皮重：10吨　净重：50吨)</td>
					<td>货款：<label class="hot" id="pay2121112">84,500</label>元</td>
				</tr>
				<tr id="tr2121113" class="selc cool" onclick="iSel(2121113);">
					<td></td>
					<td><input type="checkbox" name="buyid" id="2121113" class="bt_s" value="2121113" onclick="iSel(2121113);">　　货组编号：2121113</td>
					<td></td>
					<td colspan="2">2箱　(毛重：60吨　皮重：10吨　净重：50吨)</td>
					<td>货款：<label class="hot" id="pay2121113">84,500</label>元</td>
				</tr>
				<tr id="tr2121114" class="selc cool" onclick="iSel(2121114);">
					<td></td>
					<td><input type="checkbox" name="buyid" id="2121114" class="bt_s" value="2121114" onclick="iSel(2121114);">　　货组编号：2121114</td>
					<td></td>
					<td colspan="2">2箱　(毛重：60吨　皮重：10吨　净重：50吨)</td>
					<td>货款：<label class="hot" id="pay2121114">84,500</label>元</td>
				</tr>
				<tr id="tr2121115" class="selc cool" onclick="iSel(2121115);">
					<td></td>
					<td><input type="checkbox" name="buyid" id="2121115" class="bt_s" value="2121115" onclick="iSel(2121115);">　　货组编号：2121115</td>
					<td></td>
					<td colspan="2">2箱　(毛重：60吨　皮重：10吨　净重：50吨)</td>
					<td>货款：<label class="hot" id="pay2121115">84,500</label>元</td>
				</tr>
				<tr>
					<th></th>
					<th colspan="5">已选 <label id="selsum" class="hot">0</label> 组货物　　　　货款合计：<label id="selpay" class="hot">0</label> 元　(首付 <label id="selpay0" class="hot">0</label> 元即可购买)</th>
				</tr>
			</table>
		</div>
		<div class="list_page">
			<input class="bt bt_s" value="勾选加入购物车" type="button"/>
		</div>
	</div>
</div>
<?php
    include 'inc/bot.php';
?>