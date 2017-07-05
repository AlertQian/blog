<?php
namespace app\myadmin\controller;
use think\Controller;
use think\Request;

class Webset extends Basic
{   
	//管理员
    public function administartor()
    {    	
       return $this->fetch();
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
