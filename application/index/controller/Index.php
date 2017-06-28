<?php
namespace app\index\controller;
use think\Controller;
class Index extends Controller
{
    public function index()
    {
        return $this->fetch();

		$username=trim($_POST['username']);
		$password=md5(trim($_POST['password']));
		$ref_url=$_GET['req_url'];
		$remember=$_POST['remember'];//是否自动登录标示
		$err_msg='';
		if($username==''||$password==''){
			$err_msg="用户名和密码都不能为空";
		}else{
			$row=getUserInfo($username,$password);
			if(empty($row)){
				$err_msg="用户名和密码都不正确";
			}else{
				$_SESSION['user_info']=$row;
				if(!empty($remember)){//如果用户选择了，记录登录状态就把用户名和加了密的密码放到cookie里面
					setcookie("username",$username,time()+3600*24*365);
					setcookie("password",$password,time()+3600*24*365);
				}
				if(strpos($ref_url,"login.php")===false){
					header("location:".$ref_url);
				}else{
					header("location:main_user.php");
				}
			}
		}
    }
}
