<?php
require_once ("../vendor/autoload.php");
interface upload{public function upload();}
class Qiniu implements upload {
    public function upload(){
        \Itxiao6\Upload\Upload::set_driver('Qiniu');
        # 定义accessKey
        $accessKey = '02LH5empdwhamkt95R7C-rwvQKJ9AU3XQ8ydXXXX';
        # 定义secretKey
        $secretKey = 'V_jjyFDuNgKZqbOS5bWGgCIXj9BMwHyLZQmXXXX';
        # 定义桶的名字
        $Bucket_Name = 'liaosp';
//        $_FILES = Common::madeFile('test.jpg');  //如果想上传本地文件
        # 定义外网访问路径
        $host = 'http://img.liaosp.top/';

        # 启动上传组件
        \Itxiao6\Upload\Upload::start($accessKey,$secretKey,$Bucket_Name,$host);
        $data =\Itxiao6\Upload\Upload::upload($_FILES['file']);
        # 判断是否上传成功
        if($data!=false){
            # 输出图片
            echo "<img src='".$data."'>";
        }else{
            # 输出错误信息
            echo \Itxiao6\Upload\Upload::get_error_message($_FILES['file']['name']);
        }
    }
}
class Local implements upload{
    public function upload(){
        \Itxiao6\Upload\Upload::set_driver('Local');
        # 本地文件存储器
        # 定义上传的文件夹
        $directory = __DIR__.'/upload/';
        # 定义上传完的webUrl
        $webUrl = '/cloud/upload/';
//        $_FILES = Common::madeFile('test.jpg');
        # 启动上传组件
        \Itxiao6\Upload\Upload::start($directory,$webUrl);
        $data = \Itxiao6\Upload\Upload::upload($_FILES['file']);
        # 判断是否上传成功
        if($data!=false){
            # 输出图片
            echo "<img src='".$data."'>";
        }else{
            # 输出错误信息
            echo \Itxiao6\Upload\Upload::get_error_message($_FILES['file']['name']);
        }
    }
}
class Oss implements upload{
    public function upload(){
        \Itxiao6\Upload\Upload::set_driver('Alioss');
        $bucket_name = 'liaosp-public';
        # 您选定的OSS数据中心访问域名 参考(https://help.aliyun.com/document_detail/31837.html?spm=5176.doc32100.2.4.QQpTvt)
        $data_host = 'oss-cn-beijing.aliyuncs.com';
        # 阿里云的secretKey
        $accessKey = 'LTAIav8ceNlYXXX';
        # 阿里云的secretKey
        $secretKey = 'v9EP8Q3qjnM6La0vZISRm8ngXXXXX';
        \Itxiao6\Upload\Upload::start($accessKey,$secretKey,$bucket_name,$data_host);
        $data =\Itxiao6\Upload\Upload::upload($_FILES['file']);
        # 判断是否上传成功
        if($data!=false){
            # 输出图片
            echo "<img src='".$data."'>";
        }else{
            # 输出错误信息
            echo \Itxiao6\Upload\Upload::get_error_message($_FILES['file']['name']);
        }
    }
}
if(!empty($_POST)){
    $obj = new Oss();
    $obj->upload();
}
class Common {
    public static function madeFile($path){
        $array['file'] = [
                'name'=>'test.jpg',
                'type'=>'image/jpeg',
                'tmp_name'=>$path,
                'error'=>0,
                 'size'=>11
        ];
        return $array;
    }
}
?>

<html>
<body>
<form action="" method='post'
      enctype="multipart/form-data">
    <label for="file">文件名:</label>
    <input type="file" name="file" id="file" />
    <br />
    <input type="submit" name="submit" value="提交" />
</form>
</body>
</html>
