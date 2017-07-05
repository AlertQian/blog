<?php
namespace app\myadmin\controller;
use think\Session;
use think\Cookie;
use think\Controller;
use think\Request;

use app\myadmin\model\Info;
use app\myadmin\model\Admin;

class Login extends Controller
{   
    public function index()
    {   
        return $this->fetch();
    }
    //登录
    public function loginsave(){
        $cookieTime=3600*24*7;
        $name=trim(input('name'));
        $pwd=md5(trim(input('pwd')));    
        $check=input('check');
        if($check && !ctype_digit($check)){
            return $this->redirect(url('index/error'));
        }
        $admin=new Admin;
        $row=$admin::where(['uname'=>$name,'pwd'=>$pwd])->find();
        if($row){
            Cookie::set('name',$name);
            Cookie::set('pwd',$pwd);
            if($check == 1){
                Cookie::set('name',$name,['expire'=>$cookieTime]);
                Cookie::set('pwd',$pwd,['expire'=>$cookieTime]);
            }
            return $this->success("登入成功");
          
        }else{
            return $this->error("用户名或密码不正确");
        }
        
    }
    //退出
    public function loginout(){
        cookie('name', null);
        cookie('pwd', null);
        session("name",null);
        return $this->redirect('login/index');
    }
}
