<?php

$username = $_POST['username'];
$pwd = md5($_POST['pwd']);


require_once  __DIR__ .'/../lib/Db.php';
$db = new Db();
//验证用户名是否重复
$user =$db->table('user')->where(array('username'=>$username))->item();
if ($user) {
    exit(json_encode(array('code'=>1,'msg'=>'用户名重复')));
}

//保存新用户
$db = new Db();
$res = $db->table('user')->insert(['username'=>$username,'pwd'=>$pwd]);
if (!$res) {
    exit(json_encode(array('code'=>1,'msg'=>'保存失败')));

}
exit(json_encode(array('code'=>0,'msg'=>'恭喜注册成功！请按确认键跳转。')));