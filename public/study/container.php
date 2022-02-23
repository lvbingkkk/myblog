<?php

class Luntai
{
       function roll (){
           echo '轮胎在滚动00<br/>';
       }
}

class Chibang
{
    function roll()
    {
        echo '翅膀在空中飞行<br>';
    }
}

class Car
{

    protected $luntai;

    function __construct($luntai)
    {
        $this->luntai = $luntai;
    }

    function run()
    {
        $this->luntai->roll();
        echo '汽车在轮胎上文素狗<br>';
    }
}

class Container
{
    static $register = [];

    static function bind($name, Closure $closure)
    {
        self::$register[$name] = $closure;

    }

    static function make($name)
    {
        $clo = self::$register[$name];
        return $clo();
    }
}

Container::bind('luntai', function () {
    return new Luntai();
});

Container::bind('jiyi',function (){
    return new Chibang();
});

Container::bind('car',function (){
    return new Car(Container::make('jiyi'));
});

$car = Container::make('car');
//$data = $car->run();
//$car->run();

class Test
{
    function test()
    {
         $clo = function (){return new Luntai();};
//         print_r($clo);
        return $clo();
    }
}
(new Test())->test()->roll();

?>
<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">



    <title>容器练习</title>

</head>
<body>

<div id="user">
    <?php /*echo $data ; */?>
</div>

<button id="anniu" >显示</button>
</body>
</html>-->
