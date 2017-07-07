<?php
namespace app\myadmin\controller;
use think\Controller;
use think\Request;

class Article extends Basic
{   
	  //所有文章
    public function artall()
    {   
        	
       return $this->fetch();
    }
    //添加文章
    public function artadd()
    {    	
       return $this->fetch();
    }
    //分类目录
    public function classitem()
    {    	
       return $this->fetch();
    }  
}
