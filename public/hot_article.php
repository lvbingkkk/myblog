<?php
session_start();
$user =isset( $_SESSION['user'])?$_SESSION['user']:false;

//文章详情
$aid =(int) $_GET['aid'];
require_once __DIR__ . '/lib/Db.php';

$db = new Db();
//为何？？下面这两条要有顺序？？只有一个加入field（）条件后？？？？加field要放到下面--->要在new一个Db！！清空字段内容！！
$art = $db->table('article')->field('pv,cid,title,add_time')->where(['id'=>$aid])->item();
//更新点击量
$db->table('article')->where(['id'=>$aid])->update(['pv'=>$art['pv']+1]);
$db = new Db();
$article = $db->table('article_contents')->where(['aid'=>$aid])->item();
$db = new Db();
$cate = $db->table('cate')->where(['id'=>$art['cid']])->item();
//获取所有分类列表
$db = new Db();
$cates = $db->table('cate')->lists();
date_default_timezone_set('PRC');



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>欢迎访问我的学院</title>
    <link rel="stylesheet" type="text/css" href="/static/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/static/css/site.css">

    <link rel="icon" href=" /favicon.ico"  type="image/x-icon">


    <script type="text/javascript" src="/static/js/jquery.min.js"></script>
    <script type="text/javascript" src="/static/js/UI.js"></script>
    <script type="text/javascript" src="/static/plugins/bootstrap/js/bootstrap.min.js"></script>
    <style type="text/css">
        .content-list .title{text-align: center;font-size: 18px;margin:20px 0px;color: chocolate;}
        .content-list .time{float: right;font-size: 12px;color: #1e88e5;}

    </style>
</head>
<body>
<div style=" position: fixed;left: 0px;right: 0px;top:0px;bottom: 0px; background: #f1f1f1 url('/static/lib/image/wuyaowang.jpeg')  no-repeat ;background-size: cover; z-index: -1;"></div>

<div class="header">
    <div class="container">
        <span class="title">IKOENG魔法学院</span>
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
        <p class="cates">咒语分类</p>
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
            <br>
            <br>
            <hr>

            <p class="cates"> 👀 我的微信二维码👉<a href="http://r31484338u.qicp.vip" style="color: blueviolet" target="_blank">我的网站<span></span></a></p>
            <div class="cate-item">
                <img src="/static/image/wxerwei.png">
            </div>
        </div>


        <br>
    </div>
    <div class="col-lg-9 right-container">
        <ol class="breadcrumb">
            <li style="margin-top: 10px;"><a href="/hot.php">学院首页</a></li>
            <li><a href="/hot.php?cid=<?php echo $art['cid']?>"><?php echo $cate['title']?></a></li>
            <li><a href="#"><?php echo $art['title']?></a></li>

        </ol>
        <div class="nav">
            <a href="#" class="active">热门</a>
            <a href="/index.php" >最新</a>
        </div>

        <div class="content-list">
            <p class="title"> <?php echo $art['title']?></p>
            <p><span class="time">发布时间：<?php echo date('Y-m-d H:i:s',$art['add_time'])?></span></p>
        </div>
        <div style="clear: both;"></div>
        <hr>
        <div class="contents">

<!--            //用解码函数解码-->
            <?php echo htmlspecialchars_decode($article['contents'])?>
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
