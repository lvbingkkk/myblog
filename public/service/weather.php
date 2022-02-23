<?php
require_once  __DIR__ .'/../lib/Db.php';

$db = new Db();
$res = $db->table('click')->where('id=3')->item();
$hit =$res['hit']+1;


$db->table('click')->where('id=3')->update(['hit' => $hit]);
$res = $db->table('click')->where('id=3')->item();
$hit =$res['hit'];
exit(json_encode(array('hit'=>$hit)));