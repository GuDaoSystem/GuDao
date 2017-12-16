<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\UserModel;
class IndexController extends Controller {
    public function index(){
        $user = new UserModel();
        $data = '{"username": "NgWingLam", "password": "wuyinglin"}';
        //var_dump($user->login($data));
        $this->display();
    }
}