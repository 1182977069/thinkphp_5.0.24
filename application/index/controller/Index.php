<?php
namespace app\index\controller;

use think\Controller;
use app\admin\model\User;
class Index extends Controller
{
    public function index()
    {
        return $this->view->fetch();
    }

    public function test(){

        return $this->fetch();
    }


    public function t(){
        $username=input('get.username');
//        $username='admin';
        $userModel=new User();
        $sql="SELECT id,username from dh_user WHERE username LIKE '%".$username."%'";
//        $condition['username']=['like',$username];
        $results=$userModel->query($sql);
//        halt($results);
        if($results){
            foreach($results as $v){
                $result[]=$v['username'];
            }
            echo json_encode($result);
        }
    }
}
