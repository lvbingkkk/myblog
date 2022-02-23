<?php

//
$search = $_POST['search'];

require_once __DIR__ . '/../lib/Db.php';
$db = new Db();

//注意模糊查询where都写法。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。
$res = $db->table('article')->field('title,id,pv,add_time')->where("title like '%$search%'")->order('pv desc')->lists();
if (!$res) {
    exit(json_encode(array('code'=>1,'msg'=>'没有相关咒语')));

}
//var_dump($res);

exit(json_encode(array('code'=>0,'data'=>$res)));


