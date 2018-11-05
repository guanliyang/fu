$.ajax({
    type: 'POST',
    url: '/Home/Index/getPirJson',
    dataType: 'json',
    timeout: 10000,
    success: function(data){
        var priArr = data;

        var ind = 0;

        if(priArr[ind]) {
            changePri();
            var tTime = setInterval(changePri,3000);
        }
        function changePri(){
            document.getElementById('pri_g').innerText=priArr[ind]['port'];
            document.getElementById('pri_r').innerText=priArr[ind]['rz'];
            document.getElementById('pri_p').innerText=i2s3(priArr[ind]['price']);
            ind++;
            if(priArr[ind]==null) ind=0;
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
            return reStr ;
        }
    },
    error: function(xhr, type){
        alert('抱歉,加载失败!');
    }
});