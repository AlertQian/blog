<?php
namespace app\myadmin\controller;
use think\Session;
use think\Cookie;
use think\Controller;
use think\Request;
use app\myadmin\model\Admin;

class Basic extends Controller
{	
	/**
    *初始化
    */
    public function _initialize(){

    	$request=Request::instance();
    	$name=$request->cookie('name');
    	$pwd=$request->cookie('pwd');
        if(empty($name) || empty($pwd)){
        	    session('username',null);
        }else{
        	$admin=new Admin;
	        $row=$admin::where(['uname'=>$name,'pwd'=>$pwd])->find();
	        if($row){
	            session('username',$name);
	        }else{
	        	session('username',null);
	        }
        }
        $username=session('username');
        if(!$username){          
            return $this->redirect(url('login/index'));
        }
    }
}