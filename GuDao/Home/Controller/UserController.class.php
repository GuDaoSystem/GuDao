<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\UserModel;
class UserController extends Controller {
    public function index(){
    	$this->display();
    }

    

    // 发送忘记密码验证码
    public function sendForgetPasswordCode() {
        $email = $_POST["email"];
        $title = "孤岛验证码";
        $code = rand(1000, 9999);
        $content = "验证码为 <strong>{$code}</strong> 。你正在重新设置密码，若非本人操作请注意账号安全！";
        if(sendMail($email, $title, $content)) {
            $result["code"] = 200;
            $result["msg"] = "发送验证码成功";
            setcookie("code", $code, time() + 60, "/");
        } else {
            $result["code"] = 201;
            $result["msg"] = "发送验证码失败";
        }
        $this->ajaxReturn($result);
    }
    
    // 获取用户信息
    public function getUserInfo() {
        $user = new UserModel();
        $data = $user->getUserInfo($_GET["id"]);
        if($data) {
            $result["code"] = 200;
            $result["msg"] = "查询成功";
        } else {
            $result["code"] = 201;
            $result["msg"] = "查询失败";
        }
        $result["data"] = $data;
        $this->ajaxReturn($result);
    }

    // 修改用户信息
    public function modifyUserInfo() {
        $id = $_POST["id"];
        if($_POST["username"]) {
            $data["username"] = $_POST["username"];
        }
        if($_POST["password"]) {
            $data["password"] = md5($_POST["password"]);
        }
        if($_POST["gender"]) {
            $data["gender"] = $_POST["gender"];
        }
        if($_POST["birthday"]) {
            $data["birthday"] = $_POST["birthday"];
        }
        if($_POST["headshot"]) {
            $data["headshot"] = $_POST["headshot"];
        }
        if($_POST["intro"]) {
            $data["intro"] = $_POST["intro"];
        }
        $user = new UserModel();
        if($user->modifyUserInfo($id, $data)) {
            $result["code"] = 200;
            $result["msg"] = "修改成功";
        } else {
            $result["code"] = 201;
            $result["msg"] = "修改失败";
        }
        $this->ajaxReturn($result);
    }
}