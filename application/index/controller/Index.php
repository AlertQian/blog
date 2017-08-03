<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Session;

use app\myadmin\model\Article;
use app\myadmin\model\Info;
use app\myadmin\model\ClassItem;
class Index extends Controller
{
	public function _initialize(){
		$info = new Info;
		$arts  = new Article;
        $item = new ClassItem;
        $newart=$arts::order('addtime desc')->limit(0,5)->select();
        $count=$arts->count();
        /*统计访问次数*/
        $request=Request::instance(); 
        $ip=$request->ip();
        $time=time()+3600*2;
        if($ip){
        	session('visitorip',$ip);
        	$visitorip=session('visitorip');
        } 
        if ($visitorip && (session('time') < time())) {
        	$up=$info::where('id',1)->setInc('visitors_num');
        	session('time',$time);
        }

        if($count){
        	$this->assign('newart',$newart);
        	$this->assign('count',$count);
        }
        $itemlist=$item::order('addtime desc')->select();
        if($itemlist){
        	foreach ($itemlist as $key => $value) {
        		$id=$value['id'];
        		$num=$arts::where('item',$id)->count();
        		$itemlist[$key]['num']=$num;
        	}
        	$this->assign('itemlist',$itemlist);
        }
		$ret  = $info->find();
		$this->assign('ret',$ret);
	} 
    public function index()
    {
        $request=Request::instance();        
        $param=$request->param();
        $keyword=$request->param('keyword','','trim');
        $item=input('item');
        $where="";
        $whereitem="";
        if($keyword){
        	$where="title like '%$keyword%'";
        }
        if($item){
        	$whereitem=[
        	'item'=>$item
        	];
        }
        $art  = new Article;
        $artlist=$art::order('addtime desc')->where($where)->where($whereitem)->paginate(20,false,['query'=>$param]);
        if($artlist->count()){
	        $page=$artlist->render();
	        $this->assign('page',$page);
	        $this->assign('artlist',$artlist);
        }
        return $this->fetch();
    }
    public function detail(){
    	$id=input('id');
    	$art  = new Article;
    	$visitorip=session('visitorip');
    	$dirm=$visitorip.$id;
    	$artviewtime=time()+3600*2;
    	if ((session('strsession') !== $dirm) || ((session('strsession') == $dirm) && (session('artviewtime') < time()))) {
        	$up=$art::where('id',$id)->setInc('view_num');
        	session('artviewtime',$artviewtime);
        	session('strsession',$dirm);
        }
    	$detail=$art::where('id',$id)->find();
    	$title=$detail->title;
    	$this->assign('title',$title);
    	$this->assign('detail',$detail);
    	return $this->fetch();
    }
}
