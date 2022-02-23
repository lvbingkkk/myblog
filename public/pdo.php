<?php

//访问mysql数据库
$dsn = 'mysql:host=127.0.0.1;dbname=myblog';
$username = 'newuser';
$pwd ='bing6117';
$pdo = new PDO($dsn,$username,$pwd);



// $sql = 'select * from article where id=:id';
// $sql = "insert into article(title,cid,keywords,desc,pv,add_time) values (:title,:cid,:keywords,:desc,:pv,:add_time)";
$sql = 'update article set title="鲁班七号" where id=:id';
//$sql ='insert into article(title)value (:title)';
//$sql = "INSERT INTO `article` ( `title`,`cid`, `keywords`, `desc`, `pv`, `add_time`) VALUES ( 'wef', '2','rr', 'rrr', '2', '3')";

$stmt = $pdo->prepare($sql);

//$stmt->bindValue(':title','插入');
$stmt->bindValue(':id','3');
//$stmt->bindValue(':keywords','关键字');
//$stmt->bindValue(':desc','描述');
//$stmt->bindValue(':pv','0');
//$stmt->bindValue(':add_time','3');

$stmt->execute();
//$id = $pdo->lastInsertId();
//$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

//var_dump($id);
echo '<pre>';
//print_r($rows);
