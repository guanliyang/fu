<?php
    include 'inc/top.php';
?>
<script type="text/javascript">
	function iSel(selid){
		objSel = document.getElementById(selid);
		if(objSel.checked){
			objSel.checked =false;
			document.getElementById('tr'+selid).setAttribute("class", 'bill_item cool');
		}else{
			objSel.checked =true;
			document.getElementById('tr'+selid).setAttribute("class", 'bill_item');
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
				document.getElementById('tr'+eventdx[i].value).setAttribute('class', 'bill_item');
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

<div class="cont"  style="margin-bottom:60px;">
	<div class="tit"><a href="#" onclick="window.history.go(-1);"><返回</a>购物车</div>
	<hr>
	<div class="bill_info"><label>玉米</label><label>2016</label><label>吉林</label><label>一等</label><label>1,690元/吨</label></div>
	<div class="bill_item cool" id="tr2121112" onclick="iSel(2121112);">
		<input type="checkbox" name="buyid" id="2121112" class="bt_s" value="2121112" onclick="iSel(2121112);"/> 组号：2121112<label><b id="pay2121112">84,500</b>元</label><br/>2箱 (毛重：60吨　皮重：10吨　净重：50吨)
	</div>
	<div class="bill_item cool" id="tr2121113" onclick="iSel(2121113);">
		<input type="checkbox" name="buyid" id="2121113" class="bt_s" value="2121113" onclick="iSel(2121113);"/> 组号：2121113<label><b id="pay2121113">84,500</b>元</label><br/>2箱 (毛重：60吨　皮重：10吨　净重：50吨)
	</div>
	<div class="bill_info"><label>玉米</label><label>2018</label><label>辽宁</label><label>一等</label><label>1,690元/吨</label></div>
	<div class="bill_item cool" id="tr2121114" onclick="iSel(2121114);">
		<input type="checkbox" name="buyid" id="2121114" class="bt_s" value="2121114" onclick="iSel(2121114);"/> 组号：2121114<label><b id="pay2121114">84,500</b>元</label><br/>2箱 (毛重：60吨　皮重：10吨　净重：50吨)
	</div>
	<div class="bill_item cool" id="tr2121115" onclick="iSel(2121115);">
		<input type="checkbox" name="buyid" id="2121115" class="bt_s" value="2121115" onclick="iSel(2121115);"/> 组号：2121115<label><b id="pay2121115">84,500</b>元</label><br/>2箱 (毛重：60吨　皮重：10吨　净重：50吨)
	</div>
</div>
<div class="bill_ft" id="footer">
	已选 <label id="selsum">0</label> 组货物<br/>货款合计：<label id="selpay" >0</label> 元　(首付 <label id="selpay0" >0</label> 元即可购买)<br/>
	<input class="bt bt_s" value="进入结算" type="button"/>
</div>
<?php
    include 'inc/bot.php';
?>
<script type="text/javascript">
	footerM();
	window.onresize = function(){
	 	footerM();
	}
	function footerM(){
		document.getElementById('footer').style['top'] = document.documentElement.clientHeight-120+'px';
	}
</script>