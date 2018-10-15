<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <style>
    	body{margin:0px;text-align:center;}
		div{max-width:720px;margin:0px auto;}
		.info{width:100%;height:100%;background:#333;position:absolute;margin-top:-25%;opacity:0.8;color:#FFF;text-align:right;}
		.logo{margin:25% auto;}
		.logo img{max-width:50%;}
		.dl img{max-width:60%;margin-bottom:5%;}
		.co img{max-width:60%;margin-top:10%;}
		.ft img{width:100%;}
	</style>
</head>
<body>
	<div class="info" id="info">请点击右上角 [ ... ]&nbsp;<br/>选择 [ 在浏览器打开 ]&nbsp;</div>
	<div class="logo"><img src="img/logo.png"/></div>
	<div class="dl"><a href="1liangbao.apk"><img src="img/and.png"/></a></div>
	<div class="co"><img src="img/cologo.png"/></div>
	<div class="ft" id="ft"><img src="img/bt.png"/></div>
</body>
</html>
<script type="text/javascript">
	window.onload = function(){
	 	footerM();
	 	if(!is_weixin()) document.getElementById("info").style['display']="none";
	}
	window.onresize = function(){
	 	footerM();
	}
	function footerM(){
		document.getElementById("ft").style["margin-top"] = "0px";
		obj = document.getElementById("ft");
		fmargin = document.documentElement.clientHeight - obj.offsetTop - obj.offsetHeight;
		if(fmargin<=0){
			document.getElementById("ft").style["margin-top"] = "0px";
		}else{
			document.getElementById("ft").style["margin-top"] = fmargin+"px";
		}
	}
	function is_weixin() {
		var ua = navigator.userAgent.toLowerCase();
		if (ua.match(/MicroMessenger/i) == "micromessenger") {
			return true;
		}else{
			return false;
		}
	}
</script>