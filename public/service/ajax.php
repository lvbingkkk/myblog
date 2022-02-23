<?php
$username = $_POST['username'];

require_once  __DIR__ .'/../lib/Db.php';
$db = new Db();
//验证用户名是否重复
$user =$db->table('user')->where(array('username'=>$username))->item();
if ($user) {
    exit(json_encode(array('code'=>1,'msg'=>'❗️ 用户名重复')));
}
exit(json_encode(array('code'=>0,'msg'=>'✅ ️ 该用户名可以使用')));