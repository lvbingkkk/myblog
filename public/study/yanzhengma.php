
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ikoeng-双色球生成器</title>

    <script type="text/javascript" src="/static/js/jquery.min.js"></script>
    <script type="text/javascript">
        //随机生成n位0-9的数-
        function unmTestCode(n) {
            var arr=[];
            for (i = 0; i < n; i++) {
                var num = parseInt( Math.random()*10);
                arr.push(num);
            }

            return arr.join('');


        }

        // alert(unmTestCode(6));

        //随机生成n位0-9，a-z(97~122)，A-Z(65~90)，的字符串
        function testCode(n) {
            var arr=[];
            for (i=0;i<n;i++) {
                var num = parseInt(Math.random() * 123);
                if(num>=0 && num<=9){
                    arr.push(num);
                }
                else if (num>=65&&num<=90 || num>=97&&num<=122) {
                    arr.push(String.fromCharCode(num));
                }else{
                    i--;
                }
            }
            return arr.join('');

        }

        // alert(testCode(6));

        //双色球？？
        function caipiao(n) {
            var arr=[];
            for (i = 0; i < n; i++) {
                var num = parseInt( Math.random()*34);
                if (num > 0 && !arr.includes(num)) {
                    arr.push(num);
                }else {i--;}

            }

            document.getElementById("p1").innerText = arr.join('   ');
            // return arr.join('  ');
            $.post('/service/shuangseqiu.php',  function (res) {

                document.getElementById("hit").innerHTML = "已预测过"+res.hit+"次了～";

            },'json');

        }
        // alert('红色球是：'+ caipiao(6));

//蓝色球
        function lanqiu(n) {
            var arr=[];
            for (i = 0; i < n; i++) {
                var num = parseInt( Math.random()*17);
                if (num > 0 && !arr.includes(num)) {
                    arr.push(num);
                }else {i--;}

            }
            //给元素里的内容赋值
            document.getElementById("p2").innerHTML = arr.join('   ');
            $.post('/service/shuangseqiu.php', function (res) {

                document.getElementById("hit").innerHTML = "已预测过"+res.hit+"次了～";

            },'json');




// return arr.join('  ');

        }
        // alert('蓝色球是：'+ lanqiu(1));
    </script>

</head>
<body style="background: #bbc;">



<div style="margin:30px 20px;position:relative;">
    <input style="color:orangered;font-size: 16px;padding:10px 10px;background: linear-gradient(360deg, #aff, transparent) ;border-radius: 6px;" type="button" value="生成红色球号码" onclick="caipiao(6)">
    <input style="color:darkblue;font-size: 16px;padding:10px 10px; background: linear-gradient(360deg, #aff, transparent);border-radius: 6px; " type="button" value="生成蓝色球号码" onclick="lanqiu(1)">
    <hr>
    <p  style="color:orangered;">红色球是：<span id="p1"><script> caipiao(6);</script></span></p>
    <p  style="color:darkblue;">蓝色球是：<span id="p2"><script> lanqiu(1);</script></span></p>
    <hr>
    <p style="color:#A3F;" id="hit"></p>

</div>
<div>
    <a href="http://r31484338u.qicp.vip/">返回首页</a>
</div>

</body>
</html>