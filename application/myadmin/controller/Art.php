<?php
namespace app\myadmin\controller;
use think\Controller;
use think\Request;

use app\myadmin\model\Article;
use app\myadmin\model\ClassItem;
class Art extends Basic
{   
	  //所有文章
    public function artall()
    {  
       $request=Request::instance();
       $param  =$request->param();
       $keyword=$request->param('keyword','','trim');
       $where="";
       if($keyword){
         $where="title like '%$keyword%'";
       }
       $article=new Article;	
       $ret=$article->order('addtime desc')->where($where)->paginate(10,false,['query' => $param]);
       if($ret->count()){
        foreach ($ret as $key => $value) {
          $item=$value['item'];
          $class=new ClassItem;
          if($item){
            $items=$class::where('id',$item)->value('item');
          }else{
            $items="";
          }
          $ret[$key]['items']=$items;
        }
        $count=$article->where($where)->count();
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
       $class=new ClassItem;
       $ret=$class->select();
       $this->assign('ret',$ret);
       return $this->fetch();
    }
    //删除文章
    public function delart(){
      $strarr=input('strarr');
      if(empty($strarr)){
        return $this->error('参数错误');
      }
      $arr=explode(',', $strarr);
      $article=new Article;
      foreach ($arr as $value) {
        $where['id']=$value;
        $ret=$article->destroy($where);
      }
      if($ret){
          $this->success('删除成功');
       }else{
          $this->error('删除失败');
       }
    }
    //编辑文章
    public function artedit()
    {  
       $article=new Article;
       $class=new ClassItem;
       $list=$class->select();
       $id=input('id');
       if (empty($id) || !ctype_digit($id)) {
          return $this->error('参数错误');
        }
       $ret=$article->where('id',$id)->find();
       $this->assign('list',$list);
       $this->assign('ret',$ret);
       return $this->fetch();
    }
    //保存文章
    public function artsave(){
       $data   =input(); 
       $title  =strip_tags($data['title']);
       $content=$data['content'];
       $author =session('username');
       $item   =$data['item'];
       if(!ctype_digit($item)){
        return $this->error('参数错误');
       }
       $article=new Article;
       $savedata=[
          'title'  =>$title,
          'content'=>$content,
          'author' =>$author,
          'item'   =>$item,
          'addtime'=>time()
       ];
       $ret=$article->save($savedata);
       if($ret){
          $this->success('提交成功');
       }else{
          $this->error('提交失败');
       }
    }
    //编辑保存文章
    public function arteditsave(){
       $data   =input(); 
       $id     =$data['id'];
       $item   =$data['item'];
       if(!ctype_digit($id) || !ctype_digit($item)){
        return $this->error('参数错误');
       }
       $title  =strip_tags($data['title']);
       $content=$data['content'];
       $author =session('username');
       $article=new Article;
       $savedata=[
          'title'  =>$title,
          'content'=>$content,
          'author' =>$author,
          'item'   =>$item,
          'uptime'=>time()
       ];
       $ret=$article->save($savedata,['id'=>$id]);
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
       $class=new ClassItem; 
       $ret=$class->select();
       if($ret){
        foreach ($ret as $key => $value) {
            $parent=$value['parent'];
            if($parent == 0){
              $ret[$key]['bm']="无";
            }else{
              $bm=$class::where('id',$parent)->value('item');
              $ret[$key]['bm']=$bm;
            }
         }
         $this->assign('ret',$ret);
       }
       return $this->fetch();
    } 
    //添加新分类目录
    public function classadd(){
      $name=input('name');
      $item=strip_tags($name);
      $parents=input('parents');
      $class=new ClassItem;
      $data=[
        'item'   => $item,
        'parent' => $parents,
        'addtime'=> time()
      ]; 
      $ret=$class->save($data);
      if($ret){
        $this->success('提交成功');
      }else{
        $this->error('提交失败');
      }
    } 
    //删除文章
    public function delitem(){
      $strarr=input('strarr');
      if(empty($strarr)){
        return $this->error('参数错误');
      }
      $arr=explode(',', $strarr);
      $class=new ClassItem;
      foreach ($arr as $value) {
        $where['id']=$value;
        $ret=$class->destroy($where);
      }
      if($ret){
          $this->success('删除成功');
       }else{
          $this->error('删除失败');
       }
    }
}
