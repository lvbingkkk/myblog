<?php
//echo '<pre>';
//print_r($GLOBALS);


//上传图片
//上传发生错误
if ($_FILES['fileName']['error']>0) {
    exit(json_encode(array('errno'=>1,'data'=>[])));
}

//检查文件原始扩展名
$fi = new  finfo(FILEINFO_MIME_TYPE);
$mime_type = $fi->file($_FILES['fileName']['tmp_name']);

//限制图片大小和类型
$allows = array('image/jpeg','image/png');
if (!in_array($mime_type, $allows)) {
    exit(json_encode(array('errno'=>1,'data'=>[])));
}
//不靠谱
//$info = pathinfo($_FILES['fileName']['name']);
//return $info['extension'];
//exit($info['extension']);







//保存图片到本地

move_uploaded_file($_FILES['fileName']['tmp_name'], __DIR__.'/image/'.$_FILES['fileName']['name']);
exit(json_encode(array('errno'=>0,'data'=>['/image/'.$_FILES['fileName']['name']])));
