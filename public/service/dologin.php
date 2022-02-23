<?php
//登陆验证
$username = $_POST['username'];
$pwd = $_POST['pwd'];

require_once  __DIR__ .'/../lib/Db.php';
$db = new Db();

$user =$db->table('user')->where(array('username'=>$username))->item();
if (!$user) {
    exit(json_encode(array('code'=>1,'msg'=>'该用户不存在')));
}
//密码验证
if ($user['pwd'] != md5($pwd)) {
    exit(json_encode(array('code'=>1,'msg'=>'密码不正确')));
}

//保存session
session_start();
$_SESSION['user']= $user;
exit(json_encode(array('code'=>0,'msg'=>'登陆成功')));