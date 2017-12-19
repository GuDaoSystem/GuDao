<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\UserModel;
class IndexController extends Controller {
    // 渲染页面
    public function index(){
        $this->display();
    }
    public function login(){
        $this->display();
    }
    public function register(){
        $this->display();
    }
    public function home(){
        $this->display();
    }

    // 登录
    public function doLogin() {
        $data["email"] = $_POST["email"];
        $data["password"] = md5($_POST["password"]);
        $user = new UserModel();
        if($user->login($data)) {
            $result["code"] = 200;
            $result["msg"] = "登录成功";
        } else {
            $result["code"] = 201;
            $result["msg"] = "登录失败";
        }
        $this->ajaxReturn($result);
    }

    // 注册
    public function doRegister() {
        $data["email"] = $_POST["email"];
        $data["password"] = md5($_POST["password"]);
        $user = new UserModel();
        if($user->checkEmail($data["email"])) {
            $result["code"] = 201;
            $result["msg"] = "邮箱已注册";
        } else {
            if($user->register($data)) {
                $result["code"] = 200;
                $result["msg"] = "注册成功";
            } else {
                $result["code"] = 201;
                $result["msg"] = "注册失败";
            }
        }
        $this->ajaxReturn($result);
    }

}