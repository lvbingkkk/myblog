<?php

// $im = './hong.png';
// // 以字符串格式打开
// $data       = file_get_contents($im);
// $size_info2 = getimagesizefromstring($data);
// // echo $data;
// // var_dump($size_info2);
// // echo '<pre>', var_dump($data), '</pre>';


// echo '<pre>', var_dump(gd_info()), '</pre>';
// echo '<pre>', var_dump($_SERVER), '</pre>';

// echo $_SERVER;

// $url = "http://www.baidu.com:80//index.php?username=laowang";
// $arr = parse_url($url);
// var_dump($arr);

// $str = 'username=laowang&password=123456';
// parse_str($str, $arr);
// var_dump($arr);

// $arr = ['username' => 'laowang', 'password' => '123'];
// $str = http_build_query($arr);
// var_dump($str);

$code = new Code(260, 2, 640, 900);
echo $code->outImage();





// echo $code->outImage();
// echo $code->code;


class Code{

    //验证码 个数
    protected $number;
    //验证码类型
    protected $codeType;
    //验证码高度
    protected $height;
    //验证码宽带
    protected $width;
    //验证码
    protected $code;
    //图像资源
    protected $image;

    public function __construct($number = 4, $codeType = 2, $width = 150, $height = 50)
    {
        //初始化成员属性
        $this->number = $number;
        $this->codeType = $codeType;
        $this->width = $width;
        $this->height = $height;

        //生成验证码
        $this->code = $this->createCode();
        // echo $this->code;
    }

    public function __destruct()
    {
        if($this->image)
        {
            imagedestroy($this->image);
        }
    }

    public function __get($name)
    {
        if($name == 'code')
        {
            return $this->code;
        }
        return false;
    }

    protected function createCode()
    {
        switch($this->codeType)
        {
            case 0:
                $code = $this->getNumberCode();
                break;
            case 1:
                $code = $this->getCharCode();
                break;
            case 2:
                $code = $this->getNumCharCode();
                break;
            default:
                die("不支持这种验证码类型!");

        }

        return $code;
    }

    protected function getNumberCode()
    {
        $str = join('', range(0, 9));
        return substr(str_shuffle($str), 0, $this->number);        
    }

    protected function getCharCode()
    {
        $str = join('', range('a', 'z'));
        $str = $str.strtoupper($str);
        return substr(str_shuffle($str), 0, $this->number);
    }

    protected function getNumCharCode()
    {
        $str = join('', range('a', 'z'));
        $str = $str.strtoupper($str);
        $str = $str.join('', range(0, 9));
        return substr(str_shuffle($str), 0, $this->number);

    }

    protected function createImage()
    {       
        $this->image = imagecreatetruecolor($this->width, $this->height);        
    }

    protected function fillback()
    {
        imagefill($this->image, 0, 0, $this->lightColor());
        
        $text_color = imagecolorallocate($this->image, 233, 14, 91);
        
        imagestring($this->image,5, 15, 18, $this->code, $this->darkColor());

        imagechar($this->image, 5, 5, 10, $this->code[0], $this->darkColor());
        imageellipse(
            $this->image, 155, 155, 100, 60, $this->darkColor()
        );
        imagearc(
            $this->image, 155, 255, 100, 60, 30, 280, $this->darkColor()
        );
        // echo $this->image;
        header('Content-Type:image/png');
        imagepng($this->image);
        imagedestroy($this->image);
        
    }

    protected function lightColor()
    {
        return imagecolorallocate($this->image, mt_rand(130, 255), mt_rand(130,255), mt_rand(130, 255));
    }

    protected function darkColor()
    {
        return imagecolorallocate($this->image, mt_rand(0, 120), mt_rand(0,120), mt_rand(0, 120));
    }

    public function outImage()
    {
        //创建画布
        $this->createImage();
        //填充背景色
        $this->fillback();
    }
}