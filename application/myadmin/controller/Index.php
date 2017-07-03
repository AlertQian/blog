<?php
namespace app\myadmin\controller;
use think\Session;
use think\Cookie;
use think\Controller;
use think\Request;

use app\myadmin\model\Info;
use app\myadmin\model\Admin;

class Index extends Basic
{
    public function index()
    {    
    	
        echo "后台";
    }

     public function system()
    {    
    	
        echo "系统";
    }
    
}
