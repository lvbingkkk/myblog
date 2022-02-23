<?php
session_start();
$user =isset( $_SESSION['user'])?$_SESSION['user']:false;
if (!$user) {
    exit('请先登陆，然后书写咒语！！！');
}

require_once  __DIR__ .'/lib/Db.php';
$db = new Db();
$cates = $db->table('cate')->lists();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" type="text/css" href="/static/plugins/bootstrap/css/bootstrap.min.css">

    <script type="text/javascript" src="/static/js/jquery.min.js"></script>
    <script type="text/javascript" src="/static/js/UI.js"></script>
    <script type="text/javascript" src="/static/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/static/plugins/wangeditor/release/wangEditor.min.js"></script>
        <title>博客发表</title>
    <style type="text/css">
        .form{margin-top: 20px;}
        .form .input-group{margin:15px 0px;}
    </style>
</head>
<body >
<div class="form">
    <div class="input-group input-group-sm">
        <span class="input-group-addon" >咒语标题&nbsp</span>
        <input type="text" name="title" class="form-control" placeholder="请输入咒语标题" >
    </div>

    <div class="input-group input-group-sm">
        <span class="input-group-addon" >关&nbsp&nbsp键&nbsp&nbsp字</span>
        <input type="text" name="keywords" class="form-control" placeholder="请输入关键字" >
    </div>

    <div class="input-group input-group-sm">
        <span class="input-group-addon" >咒语描述&nbsp</span>
        <input type="text" name="desc" class="form-control" placeholder="请输入相关描述" >
    </div>

    <div class="input-group input-group-sm">
        <span class="input-group-addon" >咒语分类&nbsp</span>
        <select class="form-control" name="cid">
            <?php foreach($cates as $cates){?>

            <option value="<?php echo $cates['id']?>"> <?php echo $cates['title'];?></option>
            <?php }?>
        </select>
    </div>

    <div class="input-group input-group-sm">
        <span class="input-group-addon" >咒<br>语<br>内<br>容</span>
        <div id="editor" >
<!--            <input type="text" name="desc" class="form-control" placeholder="请输入相关描述" >-->
<!--            <p>欢迎 <b>来到我站</b> 发表咒语</p>-->
        </div>
    </div>
    <br>
    <div></div>

    <button type="button" style="float: right ;margin-right: 25px;" class="btn btn-success" onclick="save()" >保 存</button>





</div>
</body>
</html>
<script type="text/javascript">
    //初始化富文本编辑器
    var editor;
    function initEditor() {
        var E = window.wangEditor;
         editor = new E('#editor');

        // 或者 var editor = new E( document.getElementById('editor') );
        editor.customConfig.uploadImgServer = '/upload.php';
        editor.customConfig.uploadFileName = 'fileName'
        editor.customConfig.zIndex = 1;
        editor.customConfig.customAlert = function (info) {
            // info 是需要提示的内容
            UI.alert({title:'系统消息',msg:info,icon:'error'});

        }
        editor.create();
    }
    initEditor();
    
    //保存发布的博客
    function save() {
        var data = new Object;

        data.title = $.trim($('input[name="title"]').val());
        data.cid = $.trim($('select[name="cid"]').val());
        data.keywords = $.trim($('input[name="keywords"]').val());
        data.desc = $.trim($('input[name="desc"]').val());
        data.contents =editor.txt.html();
        var content = $.trim(editor.txt.html());


        if (data.title == '') {
            UI.alert({title:'系统消息',msg:'请输入咒语标题',icon:'error'});
            return;
        }
        if((content.length)<50){
            UI.alert({title:'系统消息',msg:'内容太少',icon:'error'});
            return;
        }
        $.post('/service/save_article.php',data,function (res) {
            if (res.code > 0) {
                UI.alert({title:'系统消息',msg:res.msg,icon:'error'});
            }else {
                UI.alert({title:'系统消息',msg:res.msg,icon:'ok'});
                setTimeout(function () {
                    parent.window.location.reload();

                },1000)
            }
        },'json');



    }

</script>