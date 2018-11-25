<?php

namespace app\index\controller;

use think\Controller;

class Register extends Controller{
  public function index(){
    return $this->fetch();
  }
  //用户注册
  public function doRegister(){
    $param=input('post.');
    //验证前端表单提交的数据
	if(empty($param['user_name'])){
                $this->error('用户名不能为空');
    }
    if(empty($param['user_pwd'])){
                $this->error('密码不能为空');
    }
    if(empty($param['user_pwd_cfm'])){
                $this->error('确认密码不能为空');
    }
    if($param['user_pwd']!=$param['user_pwd_cfm']){
      			$this->error('两次输入密码不一致');
    }  
    //写入数据库
    $data = ['user_name' => input('user_name'),'user_pwd' => md5(input('user_name')),];
	if(db('users') -> insert($data)){		
		 $this->redirect(url('index/index'));	
	}else{
		return $this->error('添加用户失败');
	}
  }
}