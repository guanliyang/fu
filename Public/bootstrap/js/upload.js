//扩展API完成后执行的操作
function plusReady(){
    //给选中的li增加判别class
    $(".list li").on("tap",".imageup",function(){
//                  alert('11');
        var $li = $(this).parents("li");
        console.log($($li).text())
        $li.addClass("selectLi");
        $li.siblings().removeClass("selectLi");
        page.imgUp();
    })
}

//弹出系统按钮选择框
var page=null;
page={
    imgUp:function(){
        var m=this;
        /* console.log(m);*/
        plus.nativeUI.actionSheet({cancel:"取消",buttons:[
            {title:"拍照"},
            {title:"从相册中选择"}
        ]}, function(e){
            switch(e.index){
                case 1:appendByCamera();break;
                case 2:appendByGallery();break;
            }
        });
    }
}

// 拍照添加文件
function appendByCamera(){
    plus.camera.getCamera().captureImage(function(e){
        console.log("e is" +  e);
        plus.io.resolveLocalFileSystemURL(e, function(entry) {
            var path = entry.toLocalURL();
            var indexa = liIndex()
            console.log(indexa);
            $(".headimg")[indexa].src = path;
        }, function(e) {
            mui.toast("读取拍照文件错误：" + e.message);
        });

    });
}
// 从相册添加文件
function appendByGallery(){
    plus.gallery.pick(function(path){
        var indexa = liIndex();
        console.log(indexa);
        $(".headimg")[indexa].src = path;
    });
}


//服务端接口路径
var server = "http://39.104.166.224/a.php";
//获取图片元素
var files = document.getElementById('headimg');
// 上传文件
function upload(){
    var wt=plus.nativeUI.showWaiting();
    var task=plus.uploader.createUpload(server,
        {method:"POST"},
        function(t,status){ //上传完成
            if(status==200){
                //alert("上传成功：");
                wt.close(); //关闭等待提示按钮
            }else{
                //alert("上传失败：");
                wt.close();//关闭等待提示按钮
            }
        }
    );
    //添加其他参数
    task.addData("name","test");
    task.addFile(files.src,{key:"file"});
    task.start();
}



//判断点击的是上传的第几个li
function liIndex(){
    var lis = $(".list").children();
    console.log(lis.length)
    for(var i = 0; i < lis.length;i++){
        console.log($(lis[i]).attr("class"))
        var lisClass = $(lis[i]).attr("class").split(" ");
        if(lisClass[2] == "selectLi"){
            console.log(i);
            return i;
        }
    }
}


//扩展API是否准备好，如果没有准备好则监听plusReady
if(window.plus){
    plusReady();
}
else {
    document.addEventListener("plusready",plusReady,false);
}