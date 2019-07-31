<?php
namespace app\admin\controller;

use app\admin\model\User;
use think\Controller;

class Login extends Controller{

    public function login(){
        return $this->fetch();
    }

    public function checkLogin(){
        $data=input('post.');
        $userModel=new User;
        $userData=$userModel->where(['username'=>$data['username']])->find();
        $salt=$userData['salt'];
        $password=md5($data['password'].$salt);
        $condition=[
            'username'=>$userData['username'],
            'password'=>$password
        ];
        $result=$userModel->where($condition)->find();
        if($result){
            session('username',$result['username']);
            $this->redirect('admin/index/index');
        }else{
            $this->error('登录失败！请重试');
        }
    }
}