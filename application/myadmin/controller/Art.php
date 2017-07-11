<?php
namespace app\myadmin\controller;
use think\Controller;
use think\Request;

use app\myadmin\model\Article;
class Art extends Basic
{   
	  //所有文章
    public function artall()
    {  
       $request=Request::instance();

       $article=new Article;	
       $ret=$article::order('addtime desc')->paginate('10');
      
       if($ret){
        $count=$article->count();
        $page=$ret->render();
        $this->assign('ret',$ret);
        $this->assign('count',$count);
        $this->assign('page',$page);
       }
       
       return $this->fetch();
    }
    //添加文章
    public function artadd()
    {  
       return $this->fetch();
    }
    //保存文章
    public function artsave(){
       $data   =input(); 
       $title  =strip_tags($data['title']);
       $content=$data['content'];
       $author =session('username');
       $article=new Article;
       $savedata=[
          'title'  =>$title,
          'content'=>$content,
          'author' =>$author,
          'addtime'=>time()
       ];
       $ret=$article->save($savedata);
       if($ret){
          $this->success('提交成功');
       }else{
          $this->error('提交失败');
       }
    }
    //图片上传
    public function uploadPic(){
       if ($_FILES) {
            if (!$_FILES['file']['error']) {
                //生成的文件名（时间戳，精确到毫秒）
                list($usec, $sec) = explode(" ", microtime());
                $name = ((float)$usec + (float)$sec) * 1000;

                $ext = explode('.', $_FILES['file']['name']);
                $filename = $name . '.' . $ext[1];
                $folder = date("Ymd");
                $targetDir = ROOT_PATH . '/public/imgupload/' . $folder;
                //如果上传的文件夹不存在，则创建之
                if ($targetDir) {
                    @mkdir($targetDir);
                }
                //文件目录
                $targetDir_url = $targetDir . '/article';
                //如果上传的文件夹不存在，则创建之
                if ($targetDir_url) {
                    @mkdir($targetDir_url);
                }
               //图片上传的具体路径就出来了
                $destination = $targetDir_url . DIRECTORY_SEPARATOR . $filename; //change this directory
                //echo $destination;
                $location = $_FILES["file"]["tmp_name"];
                //将图片移动到指定的文件夹****核心代码
                move_uploaded_file($location, $destination);
                echo '/imgupload/' . $folder . '/article' . DIRECTORY_SEPARATOR . $filename;//change this URL
            } else {
                echo $message = 'Ooops!  Your upload triggered the following error:  ' . $_FILES['file']['error'];
            }
        }
    }
    //分类目录
    public function classitem()
    {    	
       return $this->fetch();
    } 
    //添加新分类目录
    public function classadd(){
      $name=input('name');
      $item=strip_tags($name);
      $parents=input('parents');

      echo $item.'/-----/'.$parents;
    } 
}
