<?php
session_start();
$user = isset($_SESSION['user'])?$_SESSION['user']:false;

if (!$user) {
    exit(json_encode(array('code'=>1,'msg'=>'还未登陆')));
}

//接收提交到数据
$data['uid'] = $user['id'];
$data['title']= trim($_POST['title']);
$data['desc'] = trim($_POST['desc']);
$data['keywords'] = trim($_POST['keywords']);
$data['cid'] = (int)$_POST['cid'];
$data['add_time']=time();
$datac['contents'] = htmlspecialchars(trim($_POST['contents']),true);
//echo '<pre>';
//print_r($datac['contents']);
if (!$data['title'] ) {
    exit(json_encode(array('code'=>1,'msg'=>'文章标题不得为空啊')));

}

//保存数据
require_once  __DIR__ .'/../lib/Db.php';

$db = new Db();
$res = $db->table('article')->insert($data);
$datac['aid'] = $res;
$con = $db->table('article_contents')->insert($datac);

if (!$con) {
    exit(json_encode(array('code'=>1,'msg'=>'保存失败')));
}
    exit(json_encode(array('code'=>0,'msg'=>'保存成功！')));
