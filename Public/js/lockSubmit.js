function codePost(){
    document.getElementById('mobi_code').disabled = '';
    document.getElementById('mobi_code').value = '';
    document.getElementById('mobi_code').focus();
    var eTime = Math.round(new Date().getTime()/1000)+60;
    var tTime = setInterval(ActiCodeGetTime,1000);
    function ActiCodeGetTime(){
        var nTime = Math.round(new Date().getTime()/1000);
        var t =eTime - nTime;
        if (t <= 0) {
            document.getElementById("code_bt").value = '重新发送';
            document.getElementById("code_bt").disabled = '';
            document.getElementById("code_bt").setAttribute("class", 'bt bt_s');
            clearInterval(tTime);
        }else{
            document.getElementById("code_bt").value = t + "秒重发";
            document.getElementById("code_bt").disabled = 'disabled';
            document.getElementById("code_bt").setAttribute("class", 'bt_dis bt_s');
        }
    }
}