<?php

session_start();
$user =isset( $_SESSION['user'])?$_SESSION['user']:false;

//读取博客列表
require_once __DIR__ . '/lib/Db.php';
$db = new Db();
$path = 'hot.php';
$page = isset($_GET['page'])?(int)$_GET['page']:1;
$pageSize=7;
$cid = isset($_GET['cid'])?(int)$_GET['cid']:0;
$where = [];
if ($cid) {
    $where['cid']=$cid;
    $path .= "?cid={$cid}";
    $db = new Db();
    $cate = $db->table('cate')->where(['id'=>$cid])->item();
}

$art = $db->table('article')->field('id,title,pv,add_time')->where($where)->order('pv desc')->pages($page,$pageSize,$path);
$db = new Db();
$cates = $db->table('cate')->lists();

//访问量
$db = new Db();
$res = $db->table('click')->item();
date_default_timezone_set('PRC');

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>欢迎来到我的魔法学院</title>
	<link rel="stylesheet" type="text/css" href="/static/plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/static/css/site.css">
    <link rel="icon" href=" /favicon.ico"  type="image/x-icon">
	<script type="text/javascript" src="/static/js/jquery.min.js"></script>
	<script type="text/javascript" src="/static/js/UI.js"></script>
	<script type="text/javascript" src="/static/plugins/bootstrap/js/bootstrap.min.js"></script>
    <style>
        .breadcrumb .time{float: right;font-size: 12px;color: orangered;}
    </style>
</head>
<body>
<div style=" position: fixed;left: 0px;right: 0px;top:0px;bottom: 0px; background: #f1f1f1 url('/static/lib/image/wuyaowang.jpeg')  no-repeat ;background-size: cover; z-index: -1;"></div>

	<div class="header">
		<div class="container">
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
			<span class="title" style="color:purple;">IKOENG魔法学院</span>

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
			<div class="search">
				<div class="input-group">
				      <input type="text" class="form-control" placeholder="目前只能在'最新'模块各分类下搜索">
			    	  <span class="input-group-btn">
		 	          <button class="btn btn-default" type="button">搜索</button>
		              </span>
                </div>
			</div>
			<div class="login-reg">

               <?php if($user){?>
                <span style="color: orange"><?php echo $user['username']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><a style="color: orangered" onclick="logout()" href="javascript:;">退出登陆</a>
                <?php }else{?>
                <button type="button" class="btn btn-success"  onclick="login()">登 陆</button>
                <?php }?>


				<button type="button" class="btn btn-warning" onclick="add_article()">发表新咒语</button>
			</div>
		</div>
	</div>
	<div class="main container"style="background: rgba(200,200,220,0.95);">
		<div class="col-lg-3 left-container">
			<p class="cates" style="color: coral;">咒语分类</p>
			<div class="cate-list">
                <?php foreach ($cates as $cates){?>
                    <div class="cate-item"><a href="/hot.php?cid=<?php echo $cates['id']?>"><?php echo $cates['title']?></a></div>
                <?php }?>

                <div class="cate-item"><a href="/hot.php?page=1">全部咒语</a></div>

                <br>
                <br>
                <br>
                <br>



                <br>
                <hr>
                <p class="cates"> 👀 我的微信二维码👉<a href="http://r31484338u.qicp.vip" style="color: blueviolet" target="_blank">我的网站<span></span></a></p>
                <div class="cate-item">
                    <img src="/static/image/wxerwei.png">
                </div>
			</div>


            <br>
            <div style="clear: both;"></div>
		</div>
		<div class="col-lg-9 right-container">
            <ol class="breadcrumb" >
                <li style="margin-top: 10px;"><a href="/hot.php" >学院首页</a></li>
                <li><a href="#"><?php
                        if (!$cate) {
                            echo '全部咒语';
                        }else
                        {echo $cate['title'];} ?></a></li>
                <p><span class="time">学院来访人次：<?php echo $res['hit'];?>&nbsp;&nbsp;<span style="font-style: oblique;text-decoration:line-through">万</span><span style="font-style: italic;">人次</span></span></p>


            </ol>
			<div class="nav">
				<a href="#" class="active">热门</a>
				<a href="/index.php?cid=<?php echo $cate['id']?>" >最新</a>
			</div>

			<div class="content-list">
                <?php foreach ($art['data'] as $article){?>
				<div class="content-item">
                    <img  src="/static/image/touxiang.png">

					<div class="title">
						<p><a href="/hot_article.php?aid=<?php echo $article['id']?>" ><?php echo $article['title']?></a></p>
						<div><span><?php echo $article['pv']?>次浏览</span><span><?php echo date('Y-m-d H:i:s' ,$article['add_time']) ?></span></div>
					</div>
				</div>
                <?php }?>
            </div>
            <div>
                <?php   echo $art['pages']?>
            </div>



			</div>

		</div>
    </div>

</body>
</html>
<script type="text/javascript">

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
        UI.open({title:'发表博客',url:'/add_article.php',width:820,height:680});

    }
</script>
