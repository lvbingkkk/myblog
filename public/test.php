<?php
//echo '<pre>';
//print_r($_SERVER);
//die();

require_once __DIR__.'/lib/Db.php';
//查询
$db = new Db();
//$res = $db->table('article')->order('cid desc')->limit(3)->where('id>2')->where(['cid'=>3,'pv'=>0])->field('title,id')->lists();

//添加
//$data = array('cid'=>3,'title'=>'数据库添加','pv'=>'0','desc'=>'添加');
//$res = $db->table('article')->insert($data);
//echo '<pre>';
//print_r($res);

//return phpinfo();

//删除
//$res = $db->table('article')->where(['cid'=>3,'title'=>5,'pv'=>0])->delete();
//var_dump($res);

//更新
//$date = ['cid'=>40,'title'=>'数据更新','pv'=>'29'];
//$res = $db->table('article')->where('id=28')->update($date);
//var_dump($res);

//分页查询
$page = $_GET['page'];
$cid = $_GET['cid'];
$pageSize =2;


$res = $db->table('article')->field('id,title')->where('id<111')->pages($page, $pageSize,'/test.php');
//echo json_encode($res);
//echo '<pre>';
//print_r($res);
//echo '共查询出'.$res['total'].'条数据<br>';
//foreach ($res['data'] as $key => $value) {
//    echo $value['title'].'<br>';
//    echo $key.'<br>';
//}
//"select * from article where id>1 limit 0,3";
//"select * from article where id>1 limit 3,3";
//"select * from article where id>1 limit 6,3";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/static/plugins/bootstrap/css/bootstrap.min.css">

    <title>分页</title>
</head>
<body>
    <div class="container" style="margin-top: 30px">
    <p>共查询出<?php echo $res['total']?>条数据啊 <a href="/index.php">&nbsp;&nbsp;👉返回首页</a> </p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                 <th>标题</th>
             </tr>
        </thead>
        <tbody>
             <?php foreach ($res['data']  as $article) {?>
            <tr>
                 <td><?php echo $article['id']?></td>
                 <td><?php echo $article['title']?></td>
             </tr>

             <?php }?>
        </tbody>
    </table>
<!--        分页-->
        <div>
            <?php echo $res['pages']?>
        </div>

    </div>
</body>
</html>
