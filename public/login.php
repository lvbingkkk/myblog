<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/static/plugins/bootstrap/css/bootstrap.min.css">

    <script type="text/javascript" src="/static/js/jquery.min.js"></script>
    <script type="text/javascript" src="/static/js/UI.js"></script>
    <script type="text/javascript" src="/static/plugins/bootstrap/js/bootstrap.min.js"></script>
    <style type="text/css">
        .title{text-align: center; font-size: 18px;color: orangered  ;}
        .form{margin-top: 35px;}
        .form .input-group{margin:20px 0px;}
    </style>
<title>登陆</title>
</head>
<body>
    <div class="title">魔 法 师 登 陆</div>
    <div class="form">
         <div class="input-group input-group-sm">
             <span class="input-group-addon" >用户名</span>
             <input type="text" name="username" class="form-control" placeholder="请输入用户名" >
         </div>
         <div class="input-group input-group-sm">
             <span class="input-group-addon" >密&nbsp;&nbsp;&nbsp;码</span>
             <input type="password" name="pwd" class="form-control" placeholder="请输入密码" >
         </div>

    </div>
    <button type="button" class="btn btn-primary btn-sm btn-block " onclick="login()">登&nbsp;&nbsp;&nbsp 陆</button>
    <div style="clear:both;"></div>
    <div style=" margin-top:80px;padding:10px 0px; background-color: #edf5fe;  ">
        <div style="margin-left: 185px">还没有账号？？👉
            <a href="/register.php" target="_blank">&nbsp;&nbsp;注 &nbsp;册</a>
        </div>
    </div>




</body>
</html>
<script type="text/javascript">
    //登陆
    function login() {
        var username = $.trim( $('input[name="username"]').val());
        var pwd = $.trim( $('input[name="pwd"]').val());
        if (username == '') {

            UI.alert({title:'系统消息',msg:'用户名不能为空',icon:'error'});
            return;
        }
        if (pwd == '') {
            UI.alert({title:'系统消息',msg:'密码不能为空',icon:'error'});
            return;
        }
        //提交验证
        $.post('/service/dologin.php',{username:username,pwd:pwd},function (res) {
            if (res.code > 0) {
                UI.alert({title:'系统消息',msg:res.msg,icon:'error'});
            }else {
                UI.alert({title:'系统消息',msg:res.msg,icon:'ok'});
                setTimeout(function () {
                    parent.window.location.reload();

                },1500)
            }

        },'json');


    }

</script>