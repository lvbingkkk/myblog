<?php
//
//$callback = $_GET['callback'];//得到回调函数名
//$data = array('a', 'b', 'c');//要返回的数据
//echo $callback."(". json_encode($data) .")";//输出


date_default_timezone_set('PRC');
echo "<hr>";

print_r( ( getdate(time() )));
echo "<hr>";

//$data = ( getdate(time() )['mon']);
echo "<br>";
echo "<hr>";
echo( getdate(time() ));
echo "<hr>";

echo $tody = date('今天是 ：Y-m-d-jS-D-周N-l-今年中的第z天,第W周，-F-M,本月有t天， A H:i:s',time())." ～ "
;
echo "<hr>";

echo "<br>";
echo "时间戳 ".time()." ～ Il"
;
echo "<br>";
echo "<hr>";

echo strtotime('now')." ～ "
;
echo "<br>";
echo "<hr>";

echo $data =  date('创造时间点 ：Y-m-d-jS-D-星期N-l-今年中的第z天,第W周，-F-M,本月有t天， A H:i:s', mktime(12,33,99,9,23,2222))." ～ "
;
echo "<br>";
$d = idate('Y-m-d',time());
echo '$d:'.$d.'$d';
echo "<hr>";
echo 'localtime:';
print_r( localtime(time()));
echo '<hr>';
echo ( localtime());

?>
<!DOCTYPE html>
<body bgcolor="#ddd">
<?php echo "<p style='color:#299;' id='pa'>$data</p>" ?>
<?php echo $data  ?>
<?php echo "<p style='color:#0bb;' id='pa2'>$tody</p>" ?>
<div id="shi"><i>sss</i></div>
</body>



<script>
  /*  var data = document.getElementById('pa');
    // console.log(data.innerHTML);

    // console.log(data.innerHTML);

    var data2 = document.getElementsByTagName('p');
    console.log(data2);

    console.log(data2[1].innerHTML);*/

  var date = document.getElementById('shi');
  var date2 = document.createElement('span');
  var d = new Date();
  var h = d.getHours();
  var  uh = d.getUTCHours();
  var m = d.getMinutes();
  var s = d.getSeconds();
  date.innerHTML =`<i> ` + h +`:` + m + `:` + s + `  UTC时间: `+uh +`:`+m+`:`+s +`</i><br>`;

  date2.innerText =`<i> ` + h +`:` + m + `:` + s + `  UTC时间: `+uh +`:`+m+`:`+s +`</i>`;
  date.appendChild (date2);

</script>