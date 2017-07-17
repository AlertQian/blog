<?php
namespace app\index\controller;
use think\Controller;
use think\Request;

use app\myadmin\model\Article;
use app\myadmin\model\Info;
use app\myadmin\model\ClassItem;
class Index extends Controller
{
	public function _initialize(){
		$info = new Info;
		$ret  = $info->find();
		$this->assign('ret',$ret);
	} 
    public function index()
    {
        $request=Request::instance();
        $param=$request->param();
        $keyword=$request->param('keyword','','trim');
        $where="";
        if($keyword){
        	$where="title like '%$keyword%'";
        }
        $art  = new Article;
        $item = new ClassItem;
        $artlist=$art::order('addtime desc')->where($where)->paginate(20,false,['query'=>$param]);
        $itemlist=$item::order('addtime desc')->select();
        if($artlist->count()){
	        $count=$art->where($where)->count();
	        $page=$artlist->render();
	        $this->assign('page',$page);
	        $this->assign('count',$count);
	        $this->assign('artlist',$artlist);
        }
        if($itemlist){
        	foreach ($itemlist as $key => $value) {
        		$id=$value['id'];
        		$num=$art::where('item',$id)->count();
        		$itemlist[$key]['num']=$num;
        	}
        	$this->assign('itemlist',$itemlist);
        }
        return $this->fetch();
    }
    public function detail(){
    	$id=input('id');
    	$art  = new Article;
    	$detail=$art::where('id',$id)->find();
    	$this->assign('detail',$detail);
    	return $this->fetch();
    }
}
