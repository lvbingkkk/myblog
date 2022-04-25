<?php

$test = new Image();
$test->water('./upload/wuyao.jpeg', './upload/gif.png', 0, 50);

class Image{
    //路径
    protected $path;
    //是否启用随机名字
    protected $isRandName;
    //要保存的图像类型
    protected $type;

    public function __construct($path = './upload/', $isRandName = true, $type = 'png')
    {
        $this->path = $path;
        $this->isRandName = $isRandName;
        $this->type = $type;
    }

    //对外公开的水印方法 
    //$image:源图片
    //$water:水印图片
    //$postion:水印图片位置
    //$tmd:水印图片透明度
    //$prefix:图片前缀
    public function water($image, $water, $position, $tmd = 100, 
        $prefix = 'water_')
    {
        //1.判断这两个图片是否存在
        if((!file_exists($image)) || (!file_exists($water)))
        {
            die('图片资源不存在');
        }
        //2.得到源图片的宽度和高度以及水印图片的宽度和高度
        $imageInfo = self::getImageInfo($image);
        $waterInfo = self::getImageInfo($water);
        //3.判断水印图片能否贴上来
        if(!$this->checkImage($imageInfo, $waterInfo))
        {
            exit('水印图片太大');
        }
        //4.打开图片
        $imageRes = self::openAnyImage($image);
        $waterRes = self::openAnyImage($water);
        //5.根据水印图片的位置计算水印图片坐标
        $pos = $this->getPosition($position, $imageInfo, $waterInfo);
        //6.将水印图片粘贴过来
        imagecopymerge($imageRes, $waterRes, $pos['x'], $pos['y'], 0, 0,
            $waterInfo['width'], $waterInfo['height'], $tmd);
        //7.得到要保存图片的文件名
        $newName = $this->createNewName($image, $prefix);
        //8.得到保存图片的路径
        $newPath = rtrim($this->path, '/').'/'.$newName;
        //9.保存图片
        $this->saveImage($imageRes, $newPath);
        //10.销毁资源
        imagedestroy($imageRes);
        imagedestroy($waterRes);

        return $newPath;
    }

    protected function saveImage($imageRes, $newPath)
    {
        //imagepng imagegif  imagewbmp
        $func = 'image'.$this->type;
        //通过变量函数进行保存
        $func($imageRes, $newPath);
    }

    protected function createNewName($image, $prefix)
    {
        if($this->isRandName)
        {
            $name = $prefix.uniqid().'.'.$this->type;
        }else{
            $name = $prefix.pathinfo($image)['filename'].'.'.$this->type;    
        }
        return $name;
    }

    //根据位置计算水印图片的坐标
    protected function getPosition($position, $imageInfo, $waterInfo)
    {
        switch ($position)
        {
            case 1:
                $x = 0;
                $y = 0;
                break;
            case 2:
                $x = ($imageInfo['width'] - $waterInfo['width']) / 2;
                $y = 0;
                break;
            case 3:
                $x = ($imageInfo['width'] - $waterInfo['width']);
                $y = 0;
                break;
            case 4:
                $x = 0;
                $y = ($imageInfo['height'] - $waterInfo['height']) / 2;
                break;
            case 5:
                $x = ($imageInfo['width'] - $waterInfo['width']) / 2;
                $y = ($imageInfo['height'] - $waterInfo['height']) / 2;
                break;
            case 6:
                $x = ($imageInfo['width'] - $waterInfo['width']);
                $y = ($imageInfo['height'] - $waterInfo['height']) / 2;
                break;
            case 7:
                $x = 0;
                $y = ($imageInfo['height'] - $waterInfo['height']);
                break;
            case 8:
                $x = ($imageInfo['width'] - $waterInfo['width']) / 2;
                $y = ($imageInfo['height'] - $waterInfo['height']);
                break;
            case 9:
                $x = ($imageInfo['width'] - $waterInfo['width']);
                $y = ($imageInfo['height'] - $waterInfo['height']);
                break;
            case 0:
                $x = mt_rand(0, ($imageInfo['width'] - $waterInfo['width']));
                $y = mt_rand(0, ($imageInfo['height'] - $waterInfo['height']));
                break;
        }
        return ['x' => $x, 'y' => $y];
    }

    protected function checkImage($imageInfo, $waterInfo)
    {
        if(($waterInfo['width'] > $imageInfo['width']) || 
            ($waterInfo['height'] > $imageInfo['height']))
        {
            return false;
        }
        return true;
    }

    //对外公开的缩放方法
    //$image:需要缩放的图片
    //$width:缩放后的宽度
    //$height:缩放后的高度
    //$prefix:前缀
    public function suofang($image, $width, $height, $prefix = 'sf_')
    {
        //1.得到图片原来的宽高
        $info = self::getImageInfo($image);
        //2.根据图片原来的宽高和最终要缩放的宽高,计算图片不变形的宽高.
        $size = $this->getNewSize($width, $height, $info);
        //3.打开图片资源
        $imageRes = self::openAnyImage($image);
        //4.进行缩放
        $newRes = $this->kidOfImage($imageRes, $size, $info);
        //5.保存图片
        $newName = $this->createNewName($image, $prefix);
        $newPath = rtrim($this->path, '/').'/'.$newName;
        $this->saveImage($newRes, $newPath);
        //6.销毁资源
        imagedestroy($imageRes);
        imagedestroy($newRes);
    }

    //静态方法,根据图片的路径得到图片的信息,宽度、高度、mime类型
    static function getImageInfo($imagePath)
    {
        //得到图片信息
        $info = getimagesize($imagePath);
        // var_dump($info);
        $data['width'] = $info[0];
        $data['height'] = $info[1];
        $data['mime'] = $info['mime'];
        return $data;
    }

    static function openAnyImage($imagePath)
    {
        //得到图片mime
        $mime = self::getImageInfo($imagePath)['mime'];
        //根据不同mime用不同函数打开
        switch($mime)
        {
            case 'image/png':
                $image = imagecreatefrompng($imagePath);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($imagePath);
                break;
            case 'image/jpeg':
                $image = imagecreatefromjpeg($imagePath);
                break;
            case 'image/wbmp':
                $image = imagecreatefromwbmp($imagePath);
                break;
        }
        return $image;
    }
}