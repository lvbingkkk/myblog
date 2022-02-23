<?php
session_start();
$user =isset( $_SESSION['user'])?$_SESSION['user']:false;

//读取博客列表
require_once __DIR__ . '/lib/Db.php';
$db = new Db();
$path = 'index.php';
$page = isset($_GET['page'])?(int)$_GET['page']:1;
$pageSize=7;
$cid = isset($_GET['cid'])?(int)$_GET['cid']:0;

//条件查询
$where = [];
$cate = "";
if ($cid) {
    $where['cid'] = $cid;
    $path .= "?cid={$cid}";
    $db = new Db();
    $cate = $db->table('cate')->where(['id'=>$cid])->item();
}

$art = $db->table('article')->field('click,id,title,pv,add_time')->where($where)->order('add_time desc')->pages($page,$pageSize,$path);
//记录访问量
//echo '<pre>';
//print_r( $_COOKIE);exit();
$db = new Db();
$res = $db->table('click')->item();
if (!$_COOKIE) {
    $hit = $res['hit']+1;
    $db->table('click')->where('id=1')->update(['hit' => $hit]);
}

//获取分类列表
$db = new Db();
$cates = $db->table('cate')->lists();

date_default_timezone_set('PRC');

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>欢迎来到我的魔法基地</title>
	<link rel="stylesheet" type="text/css" href="/static/plugins/bootstrap/css/bootstrap.min.css"> 
	<link rel="stylesheet" type="text/css" href="/static/css/site.css">

    <link rel="icon" href="./favicon.ico"  type="image/x-icon">

	<script type="text/javascript" src="/static/js/jquery.min.js"></script>
	<script type="text/javascript" src="/static/js/UI.js"></script>
	<script type="text/javascript" src="/static/plugins/bootstrap/js/bootstrap.min.js"></script>
    <style>
        .breadcrumb .time{float: right;font-size: 12px;color: #1e88e5;}
    </style>
</head>
<body >
<div >
    <div style=" position: fixed;left: 0px;right: 0px;top:0px;bottom: 0px; background: #f1f1f1 url('/static/lib/image/wuyaowang.jpeg')  no-repeat ;background-size: cover; z-index: -1;"></div>

        <div class="header"  >
            <div class="container"  >

                <canvas  style="float: left;margin-top: 30px;" id="myCanvas" width="70" height="55"></canvas>

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
                <span class="title" style="color:rebeccapurple;">

                    IKOENG魔法学院
                </span>
                <canvas  style="float: left;margin-top: 30px;" id="myCanvas1" width="70" height="55"></canvas>

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

                <div class="search">
                    <div class="input-group">
                          <input type="text" class="form-control" placeholder="输入咒语概要搜索" id="search" oninput="check();" >

                          <span class="input-group-btn">
                          <button class="btn btn-default" type="button" onclick="search();" >搜索</button>
                          </span>
                    </div>
                    <ul id="ul1" style="z-index: 5; width: 246px; position:absolute; display:inline-block;
                     list-style-type: none;line-height: 20px; background:rgba(215,220,238,0.9); border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;
                      margin-top: -32px;;" >

                    </ul>

                </div>

                <div class="login-reg">

                   <?php if($user){?>
                    <span style="color: orange"><?php echo $user['username']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><a style="color: orangered" onclick="logout()" href="javascript:;">退出登陆</a>
                    <?php }else{?>
                    <button style=" box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);" type="button" class="btn btn-success"  onclick="login()">登 陆</button>
                    <?php }?>


                    <button style="  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);" type="button" class="btn btn-warning" onclick="add_article()">发表新咒语</button>
                </div>
                <div style="clear: both;"></div>
            </div>
        </div>
        <div class="main container" style="background: rgba(200,200,220,0.95);" >
            <div class="col-lg-3 left-container">
                <p class="cates"style="color: orangered  ">咒语分类</p>
                <div class="cate-list">
                    <?php foreach ($cates as $cates){?>
                        <div class="cate-item"><a href="/index.php?cid=<?php echo $cates['id']?>"><?php echo $cates['title']?></a></div>
                    <?php }?>
                    <div class="cate-item"><a href="/index.php?page=1">全部咒语</a></div>
                    <hr>
                    <div class="cate-item"><a href="/study/yanzhengma.php" target="_blank" style="color:#09f; background:  linear-gradient(90deg, #ddf, transparent);border-radius: 2px;">做个双色球生成器😂</a></div>
                    <div class="cate-item"><a href="/study/weather.html" target="_blank" style="color:#09f; background:  linear-gradient(90deg, #ddf, transparent);border-radius: 2px;">基于jsonp的天气查询</a></div>
                    <div class="cate-item"><a href="/study/navlist.html" target="_blank" style="color:#09f; background:  linear-gradient(90deg, #ddf, transparent);border-radius: 2px;">API加动效练习</a></div>

                    <div class="cate-item"><a href="/study/list.html" target="_blank" style="color:#09f; background:  linear-gradient(90deg, #ddf, transparent);border-radius: 2px;">你的网络源头。。</a></div>
                    <div class="cate-item"><a href="/study/baidu.php" target="_blank" style="color:#09f; background:  linear-gradient(90deg, #ddf, transparent);border-radius: 2px;">无竞价排名的百度查询</a></div>


                    <hr>



                    <div class="cate-item"><a href="/echarts.php" target="_blank">统计初步展示</a></div>
                    <div class="cate-item"><a href="/echarts/test/aria-line-bar.html" target="_blank">媒体热度统计</a></div>
                    <div class="cate-item"><a href="/echarts/test/aria-pie.html" target="_blank">站点访问来源统计</a></div>
                    <div class="cate-item"><a href="/echarts/test/bmap.html" target="_blank">全国主要城市空气质量</a></div>
                    <div class="cate-item"><a href="/echarts/test/connect2.html" target="_blank">北上广PM2.5</a></div>
                    <div class="cate-item"><a href="/echarts/test/calendar-converter.html" target="_blank">时间都去哪了</a></div>
                    <div class="cate-item"><a href="/echarts/test/calendar-effectScater.html" target="_blank">每天走几步</a></div>
                    <div class="cate-item"><a href="/echarts/test/brush.html" target="_blank">自主区域统计</a></div>
                    <div class="cate-item"><a href="/echarts/test/tree-legend.html" target="_blank">树状分枝</a></div>
                    <div class="cate-item"><a href="/echarts/test/visualMap-continuous.html" target="_blank">世界人口统计</a></div>
                    <div class="cate-item"><a href="/echarts/test/sunburst-book.html" target="_blank">灵魂的组成</a></div>
                    <div class="cate-item"><a href="/echarts/test/sankey.html" target="_blank">桑基能量分流图</a></div>
                    <div class="cate-item"><a href="/echarts/test/geo-lines.html" target="_blank">明天往哪飞</a></div>
                    <div class="cate-item"><a href="/echarts/test/graph.html" target="_blank">这是一个复杂的关系</a></div>


                    <br>
                    <br>
                    <br>
                    <hr>

                    <p class="cates"><a href="./index.html" >👀</a> 我的微信二维码 👉<a href="http://r31484338u.qicp.vip" style="color: blueviolet" target="_blank">我的网站</a></p>
                    <div class="cate-item">
                        <img src="/static/image/wxerwei.png">
                    </div>
                </div>


                <br>
                <div style="clear: both;"></div>
            </div>
            <div class="col-lg-9 right-container">
                <ol class="breadcrumb">
                    <li style="margin-top: 10px;"><a href="/index.php">学院首页</a></li>
                    <li><a href="#"><?php
                            if (!$cate) {
                                echo '全部咒语';
                            }else
                            {echo $cate['title'];} ?></a></li>
                    <p><span class="time">学院来访<i>人次</i><del>  (万)</del> ：<?php echo $res['hit'];?>&nbsp;&nbsp;<span style="font-style: oblique;text-decoration:line-through">万 </span>
                            <span style="font-style: italic;">人次</span></span></p>

                </ol>
                <div class="nav">
                    <a href="/hot.php?cid=<?php echo $cate['id']?>">热门</a>
                    <a href="#" class="active">最新</a>
                </div>

                <div class="content-list" >
                    <div id="title">

                    <?php foreach ($art['data'] as $article){?>
                    <div class="content-item" >
                        <img  src="/static/image/touxiang.png">

                        <div class="title" >
                            <p><a href="/article.php?aid=<?php echo $article['id']?>" ><?php echo $article['title']?></a></p>
                            <div><span><?php echo $article['pv']?>次浏览</span><span><?php echo date('Y-m-d H:i:s' ,$article['add_time']) ?></span></div>
                        </div>
                    </div>
                    <?php }?>

                <div>
                    <?php   echo $art['pages']?>
                </div>


                </div>
                </div>
                </div>
            </div>

</div>

</body>
</html>
<script type="text/javascript">
    //实时查询
    function check() {
        var oUl = document.getElementById('ul1');
        var oSearch = document.getElementById('search');
        var oSearchVal =oSearch.value;
        //每次都要清空
        oUl.innerHTML='';
        if (!oSearchVal) {
            oUl.innerHTML='';

        }else{
            $.post(
                '/service/search.php',
                {search: oSearchVal},
                function (res) {
                    //返回搜索结果如果为空 .length会报错，所有要先判断；
                    if (res.code > 0) {
                        oUl.innerHTML='';
                    } else {
                        for (var i = 0; i < res.data.length; i++) {
                            var newLi = document.createElement('li');
                            var oA = document.createElement('a');
                            oA.innerHTML=res.data[i]['title'];
                            oA.href = '/article.php?aid=' + res.data[i]['id'];
                            newLi.appendChild(oA);
                            oUl.appendChild(newLi);
                        }
                    }

                },
                'json'
            );
        }



    }
    // /时间戳转正常格式
    function timestampToTime(timestamp) {
        var date = new Date(timestamp * 1000);//时间戳为10位需*1000，时间戳为13位的话不需乘1000
        Y = date.getFullYear() + '-';
        M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
        D = date.getDate() + ' ';
        h = date.getHours() + ':';
        m = (date.getMinutes() < 10 ? '0'+(date.getMinutes()) : date.getMinutes()) + ':';
        s = (date.getSeconds() < 10 ? '0'+(date.getSeconds()) : date.getSeconds());
        return Y+M+D+h+m+s;
    }

    function search() {
        var oSearch = $('#search').val();
        var oUl = document.getElementById('ul1');
        oUl.innerHTML='';

        //要得到DOM对象要写.get(0);～～～～～～～
         var title =$('#title').get(0);

         //这样写是得到DOM对象。。
        // var title =document.getElementById('title');
        if (!oSearch) {
            alert('请输入搜索内容')
            return;
        }
        $.ajax({
            method:'post',
            url:'/service/search.php',
            data:{search:oSearch},

            dataType:'json',
            success: function (res) {
                // var obj = JSON.parse(res);
                if (res.code >0) {
                    alert(res.msg);
                }
                else {
                    // alert(title);
                    var str = ``;
                    for (var i = 0; i < res.data.length; i++) {
                        str +=`
                            <div class="content-item" >
                            <img  src="/static/image/touxiang.png">

                             <div class="title" >
                                  <p><a href="/article.php?aid=${res.data[i]['id']}" >${res.data[i]['title']}</a></p>
                                  <div><span>${res.data[i]['pv']}次浏览</span><span>${timestampToTime( res.data[i]['add_time'])}</span></div>
                                  </div>
                             </div>
                        `;

                    }


                    title.innerHTML = str;

                }
            },
            error:function (msg) {
                alert(msg);

            }
        });

    }

	//登陆
	function login(){
		// UI.alert({title:'系统消息',msg:'请输入用户名',icon:'error'});
		UI.open({title:'登陆',url:'/login.php',width:400,height:350});
	}

	//退出登陆
    function logout() {
        if (!confirm('确定要退出登陆吗？')) {
            return;
        }
        $.get('/service/logout.php',{},function (res) {
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

    //  发表博客
    function add_article() {
        UI.open({title:'发表咒语',url:'/add_article.php',width:820,height:680});

    }
</script>
