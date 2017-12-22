<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\UserModel;
use Home\Model\WantModel;
use Home\Model\SupportModel;
use Home\Model\ShowModel;
use Home\Model\BandModel;
class UserController extends Controller {
    public function index(){
        $this->display();
    }
    public function forgetPassword(){
        $this->display();
    }
    public function user(){
        $this->display();
    }



    /* -------------------- 个人页面 -------------------- */

    // 获取用户信息
    public function getUserBasicInfo() {
        $user = new UserModel();
        $data = $user->getUserBasicInfo($_GET["id"]);
        if($data) {
            $result["code"] = 200;
            $result["msg"] = "查询成功";
            $result["data"] = $data;
        } else {
            $result["code"] = 201;
            $result["msg"] = "查询失败";
        }
        $this->ajaxReturn($result);
    }

    // 获取用户动态
    public function getUserActivity() {
        $data = array();

        // 获取想看的演出
        $want = new WantModel();
        $wantList = $want->getShowByUser($_GET["id"]);
        if(!$wantList) {
            $result["code"] = 201;
            $result["msg"] = "查询失败";
            $this->ajaxReturn($result);
        }
        for($i = 0; $i < count($wantList); $i++) {
            if(!$wantList[$i]) {
                $result["code"] = 201;
                $result["msg"] = "查询失败";
                $this->ajaxReturn($result);
            }
            $tem["time"] = $wantList[$i]["time"];
            $tem["type"] = "show";
            $show = new ShowModel();
            $tem["show"] = $show->getShowByID($wantList[$i]["show_id"]);
            if(!$tem["show"]) {
                $result["code"] = 201;
                $result["msg"] = "查询失败";
                $this->ajaxReturn($result);
            }
            array_push($data, $tem);
        }

        $tem = null;

        // 获取支持的乐队
        $support = new SupportModel();
        $supportList = $support->getBandByUser($_GET["id"]);
        if(!$supportList) {
            $result["code"] = 201;
            $result["msg"] = "查询失败";
            $this->ajaxReturn($result);
        }
        for($i = 0; $i < count($supportList); $i++) {
            if(!$supportList[$i]) {
                $result["code"] = 201;
                $result["msg"] = "查询失败";
                $this->ajaxReturn($result);
            }
            $tem["time"] = $supportList[$i]["time"];
            $tem["type"] = "band";
            $band = new BandModel();
            $tem["band"] = $band->getBandByID($supportList[$i]["band_id"]);
            if(!$tem["band"]) {
                $result["code"] = 201;
                $result["msg"] = "查询失败";
                $this->ajaxReturn($result);
            }
            array_push($data, $tem);
        }

        // 按数组中的指定字段排序
        foreach($data as $dataItem) {
            $sort[] = $dataItem["time"];
        }
        array_multisort($sort, SORT_DESC, $data);

        $result["code"] = 200;
        $result["msg"] = "查询成功";
        $result["data"] = $data;
        $this->ajaxReturn($result);
    }

    // 获取演出时间表
    public function getShowCalendar() {
        $data = array();
        $want = new WantModel();
        $wantList = $want->getShowByUser($_GET["id"]);
        if(!$wantList) {
            $result["code"] = 201;
            $result["msg"] = "查询失败";
            $this->ajaxReturn($result);
        }
        for($i = 0; $i < count($wantList); $i++) {
            if(!$wantList[$i]) {
                $result["code"] = 201;
                $result["msg"] = "查询失败";
                $this->ajaxReturn($result);
            }
            $show = new ShowModel();
            $tem = $show->getShowByID($wantList[$i]["show_id"]);
            if(!$tem) {
                $result["code"] = 201;
                $result["msg"] = "查询失败";
                $this->ajaxReturn($result);
            }
            array_push($data, $tem);
        }

        // 按数组中的指定字段排序
        foreach($data as $dataItem) {
            $sort[] = $dataItem["show_time"];
        }
        array_multisort($sort, SORT_ASC, $data);

        $result["code"] = 200;
        $result["msg"] = "查询成功";
        $result["data"] = $data;
        $this->ajaxReturn($result);
    }

    // 修改用户信息
    public function modifyUserInfo() {
        $id = $_POST["id"];
        if($_POST["email"]) {
            $data["email"] = $_POST["email"];
        }
        if($_POST["password"]) {
            $data["password"] = md5($_POST["password"]);
        }
        if($_POST["username"]) {
            $data["username"] = $_POST["username"];
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


    /* -------------------- 重设邮箱 -------------------- */

    // 1. 检查原始密码
    public function checkPassword() {
        $data["user_id"] = $_POST["id"];
        $data["password"] = md5($_POST["password"]);
        $user = new UserModel();
        if($user->checkPassword($data)) {
            $result["code"] = 200;
            $result["msg"] = "密码正确";
        } else {
            $result["code"] = 201;
            $result["msg"] = "密码错误";
        }
        $this->ajaxReturn($result);
    }

    // 2. 发送重设邮箱验证码
    public function sendResetEmailCode() {
        $email = $_POST["email"];
        $user = new UserModel();
        if($user->checkEmail($email)) {
            $result["code"] = 201;
            $result["msg"] = "邮箱已存在";
        } else {
            $title = "孤岛验证码";
            $code = rand(1000, 9999);
            $content = "验证码为 <strong>{$code}</strong> 。你正在重新设置邮箱，若非本人操作请注意账号安全！";
            if(sendMail($email, $title, $content)) {
                setcookie("code", $code, time() + 60, "/");
                $result["code"] = 200;
                $result["msg"] = "发送验证码成功";
            } else {
                $result["code"] = 201;
                $result["msg"] = "发送验证码失败";
            }
        }
        $this->ajaxReturn($result);
    }

    // 3. 重设邮箱：$this->modifyUserInfo();


    /* -------------------- 重设密码 -------------------- */

    // 1. 检查原始密码: $this->checkPassword();

    // 2. 重设密码：$this->modifyUserInfo();


    /* -------------------- 忘记密码页面 -------------------- */

    // 1. 发送忘记密码验证码
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

    // 2. 重设密码：$this->modifyUserInfo();


    /* -------------------- 用户页面 -------------------- */

    // 获取用户信息：$this->getUserBasicInfo();

    // 获取用户动态：$this->getUserActivity();
}