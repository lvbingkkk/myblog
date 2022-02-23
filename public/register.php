<?php
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>IKOENG&nbsp;|&nbsp;魔法学院注册</title>

    <script type="text/javascript" src="/static/js/jquery.min.js"></script>
    <script type="text/javascript" src="/static/js/UI.js"></script>

    <link href="/static/css/slide-unlock.css" rel="stylesheet">
    <script src="/static/js/jquery.slideunlock.js"></script>



    <style type="text/css">
        *{margin:0px;padding:0px;}

        /*响应式布局*/
        /*@media screen and (max-width: 1150px) {*/
        /*    .yincang {*/
        /*        display: none;*/
        /*    }*/
        /*}*/
    </style>

</head>
<body>
<div>
    <div style="width: 100%;">

        <div style=" position: fixed;left: 0px;right: 0px;top:0px;bottom: 0px;
                     background: #666666 url('/static/lib/image/wuyaowang.jpeg')  no-repeat ;
                     background-size: cover;">
<!--            用<img>标签效果不好-->
<!--            <img src="/static/lib/image/wuyaowang.jpeg">-->
        </div>
        <div>
            <div style="position: fixed;left: 70px;top:80px;">
                <div><p style=" color: orange;font-size: 35px">&nbsp;<a href = "http://r31484338u.qicp.vip/" style=" color: orange;text-decoration:none;">IKOENG</a>

                    <canvas id="myCanvas1" width="70" height="55"  style="margin-bottom: -24px;"  ></canvas>

                    <script>
                        var canvas = document.getElementById('myCanvas1');
                        var contex = canvas.getContext('2d');

                        contex.beginPath();
                        contex.moveTo(32,5);
                        contex.bezierCurveTo(100,30,50,55,30,30);
                        contex.bezierCurveTo(15,10,38,28,8,40);
                        contex.bezierCurveTo(22,25,20,12,10,5);
                        contex.bezierCurveTo(30,28,40,5,52,30);
                        contex.bezierCurveTo(50,12,75,0,32,5);

                        contex.closePath();
                        contex.lineWidth =2;
                        contex.strokeStyle = '#3ef';
                        contex.stroke();
                    </script>

                    <canvas  id="myCanvas" width="70" height="55"  style="margin-bottom: -24px;"></canvas>

                    <script>
                        var canvas = document.getElementById('myCanvas');
                        var contex = canvas.getContext('2d');

                        contex.beginPath();
                        contex.moveTo(38,5);
                        contex.bezierCurveTo(-30,30,20,55,40,30);
                        contex.bezierCurveTo(55,10,32,28,62,40);
                        contex.bezierCurveTo(48,25,50,12,60,5);
                        contex.bezierCurveTo(40,28,30,5,18,30);
                        contex.bezierCurveTo(20,12,-5,0,38,5);

                        contex.closePath();
                        contex.lineWidth =2;
                        contex.strokeStyle = '#3ef';
                        contex.stroke();
                    </script>
                </p></div>
            </div>
            <div class="yincang" style="position: fixed;left: 220px;top:335px;">
                <h3  style="font-size: 54px; color: #ffe; font-weight: 700;letter-spacing: 0px;">用魔法</h3>
                <p style="position: relative; font-size: 32px;letter-spacing: 3.81px;font-weight: 300;color: #eee">让复杂的世界变简单</p>
            </div>
            <div>
                <p style="position: fixed;left: 70px;bottom: 57px;color: white;font-size: 14px;">
                   <span >
                       <a style="text-decoration:none; color:#ffffff;" href="./index.html" >帮助中心&nbsp;&nbsp;|</a>
                   </span>
                    <span style="font-size: 12px;color:#fff;margin-left: 30px;"> 2019-<?php echo date('Y')?>&nbsp;©️IKOENG</span>
                </p>
            </div>
        </div>
        <div style="position:absolute;right: 139px;top:50%; width: 480px;height: 680px; margin-top: -340px;background: rgba(255,255,255,0.9);
                        border-radius: 12px;overflow: hidden; ">
            <div style="margin:60px 35px;font-size: 30px;">
                <h3>欢迎注册</h3>
                <p style="font-size: 14px;color: #666666;">
                    已有账号？
                    <a style="text-decoration:none; color: #1e88e5;" href="/index.php">登 陆</a>
                </p>
            </div>
            <div style="margin:30px 35px;">
                <span style="margin-right: 15px; color:#333;">用户名</span>
                <input id="nameValue" style="padding:12px 10px;border:1px solid #e0e0e0; border-radius: 4px;
                    width: 280px;font-size:14px;  background:#fff;" type="text" value="" name="username" onblur="check();" placeholder="请设置用户名">
                <p style="padding-left: 60px;margin-top: 5px;" id="name"></p>
            </div>

            <div style="margin:30px 35px;">
                <span style="margin-right: 15px; color:#333;">密&nbsp;&nbsp;&nbsp;码</span>
                <input style="padding:12px 10px;border:1px solid #e0e0e0; border-radius: 4px;
                           width: 280px;    font-size:14px;  background:#fff;" type="password" value="" name="password" placeholder="请设置登陆密码">
            </div>
            <div id="slider" >

                <div id="slider_bg"></div>

                <span id="label">>></span> <span id="labelTip">拖动滑块验证</span>

            </div>
            <div>
                <input  style="margin:80px 38px;; padding:12px 10px;border:1px solid #e0e0e0; border-radius: 14px;
                           width: 400px;    font-size:18px;  background:#bdcefc;" type="submit"onclick="doreg()" value="注 册">
            </div>


        </div>

    </div>
</div>

</body>
</html>
<script type="text/javascript">
    //判断长度
    var ok ='';
    function check() {

        var oNamev =document.getElementById('nameValue');
        var oName =document.getElementById('name');
       var oValue = oNamev.value;
        if (oValue.length<6 || oValue.length > 15) {
            oName.innerHTML = "❗️ 用户名长度应在6～15个字符之间";
            ok='';
        }else {
            // oName.innerHTML = "✅ ️ 该用户名可以使用";
            // alert('1');
            $.ajax ({
                method:'post',
                url:'/service/ajax.php',
                data:{username:oValue},

                dataType: "json",
                success: function (res) {

                    // var obj = JSON.parse(res);
                    //
                    // if (obj.code>0) {
                    //
                    //     oName.innerHTML =obj.msg;
                    //     ok='';
                    //
                    // }else {
                    //     oName.innerHTML =obj.msg;
                    //     ok=1;
                    // }

                    //与$.post不同，不转码不行啊
                    //如果写了data.Type:'json',就不能转码了。。❗️
                    //还是直接用$.post方便啊❗️

                    if (res.code>0) {

                        oName.innerHTML =res.msg;
                        ok='';


                    }else {

                        oName.innerHTML =res.msg;
                        ok=1;
                    }

                },
                error: function (msg) {
                    alert(msg);
                }

            } );
        }



    }

    function doreg() {
        var username=$.trim($('input[name="username"]').val());
        var password = $.trim($('input[name="password"]').val());
        var oValue =document.getElementById('name');

        if (!ok) {
            alert('❗️ 用户名不符合要求！');
            return;
        }

        if (!username ){
            alert('用户名不能为空的');
            return ;
        }
        if (!password ){
            alert('密码不能空');
            return ;
        }
        if (numTime==0) {
            alert('请拖动滑块验证');
            return;
        }
        $.post('/service/doregister.php', {username:username,pwd:password}, function (res) {

            if (res.code>0) {
                alert(res.msg);
                window.location.reload();

            }else {
                alert(res.msg);
                setTimeout(function () {
                    // parent.window.location.reload();
                    window.location.href= "/index.php";

                },2000)
            }

        },'json');

    }
</script>
<script type="text/javascript">

    var startTime = 0;

    var endTime = 0;

    var numTime = 0;

    $(function () {

        var slider = new SliderUnlock("#slider",{

            successLabelTip : "欢迎注册"

        },function(){

            var  sli_width = $("#slider_bg").width();

            alert("验证成功，点击注册进行注册");

            endTime = nowTime();

            numTime = endTime-startTime;

            endTime = 0;

            startTime = 0;

            // 获取到滑动使用的时间 滑动的宽度

            // alert( numTime );

            // alert( sli_width );

        });

       slider.init();



    })



    /**

     * 获取时间精确到毫秒

     * @type

     */

    function nowTime(){

        var myDate = new Date();

        var H = myDate.getHours();//获取小时

        var M = myDate.getMinutes(); //获取分钟

        var S = myDate.getSeconds();//获取秒

        var MS = myDate.getMilliseconds();//获取毫秒

        var milliSeconds = H * 3600 * 1000 + M * 60 * 1000 + S * 1000 + MS;

        return milliSeconds;

    }

</script>
