<?php
namespace app\myadmin\controller;
use think\Controller;
use think\Request;

use app\myadmin\model\Info;
use app\myadmin\model\Admin;
class Webset extends Basic
{   
	//管理员
    public function administartor()
    {   
       $uname=session('username');
       $this->assign('uname',$uname);
       return $this->fetch();
    }
    //修改管理员信息
    public function upadmin(){
    	$admin=new Admin;
    	$uname=session('username');
    	$data=input('post.');
    	$newname=strip_tags($data['newname']);
    	$newpwd=md5(strip_tags($data['newpwd']));
    	$oldpwd=md5($data['oldpwd']);

    	if(mb_strlen($newname,'utf-8') > 10){
    		exit('name_toolong');
    	};
    	if(mb_strlen($newpwd,'utf-8') < 6){
    		exit('pwd_wrong');
    	};
    	$ret=$admin::where(['uname'=>$uname,'pwd'=>$oldpwd])->find();
    	if($ret){
    		$updata=[
    		    'uname'=>$newname,
    		    'pwd'=>$newpwd,
    		    'uptime'=>time(),
    		    'type'=>1
    		];
    		$up=$admin->save($updata,['id' => 1]);
    		if($up){
    			exit('ok');
    		}else{
    			exit('error');
    		}
    	}else{
    		exit('pwd_error');
    	}
        
    }
    //系统信息
    public function systeminfo()
    {    	
       return $this->fetch();
    }
    //日志记录
    public function loglist()
    {    	
       return $this->fetch();
    }  
}
