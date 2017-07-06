<?php
namespace app\myadmin\controller;
use think\Controller;
use think\Request;

class Index extends Basic
{
    public function index()
    {  
       $uname=session('username');
       $this->assign('uname',$uname);	
       return $this->fetch();
    }

      
}
