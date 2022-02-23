<?php
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>IKOENG-百度搜索</title>
    <link rel="stylesheet" type="text/css" href="/static/plugins/bootstrap/css/bootstrap.min.css">
</head>
<body>

<div class="container " style="margin-top: 25px;">
    <input  id="input" placeholder="输入搜索内容" oninput="put();"  />
    <button  onclick="search();" href="">搜索</button>
    <div >
    <span id="search"></span>
    </div>
</div>

</body>
</html>
<script>
    function search() {
        var oInput = document.getElementById('input');
        var input =oInput.value;
        window.open("https://www.baidu.com/s?wd="+input,'_blank');


    }
</script>
<script>


    function down(data) {
        var oSearch = document.getElementById('search');

        str =``;
        for (var i = 0; i < data.s.length; i++) {
            str +=`
            <a target="_blank" href='https://www.baidu.com/s?wd=${data.s[i]}'>${data.s[i]}</a> <br>`;
        }
         oSearch.innerHTML =str;

    }
</script>
<script>
    function put() {

        var oSearch = document.getElementById('search');
        var oInput = document.getElementById('input');
        var input =oInput.value;
        if (!input) {
            oSearch.innerHTML='';
        }
        var oScript = document.createElement('script');
        oScript.src =`http://suggestion.baidu.com/su?wd=${input}&cb=down`;
        document.body.appendChild(oScript);

    }









</script>