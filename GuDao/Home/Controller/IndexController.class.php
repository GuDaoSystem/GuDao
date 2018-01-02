<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\UserModel;
use Home\Model\NoticeModel;
use Home\Model\WantModel;
use Home\Model\ShowModel;
use Home\Model\SupportModel;
use Home\Model\BandModel;
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




    /* -------------------- 登录页面 -------------------- */

    // 登录
    public function doLogin() {
        $param["email"] = $_POST["email"];
        $param["password"] = md5($_POST["password"]);
        $user = new UserModel();
        $data = $user->login($param)[0];
        if($data) {
            if($_POST["autoLogin"]) {
                $data["token"] = md5($_POST["email"].time().md5($_POST["password"]));
            } else {
                $data["token"] = null;
            }
            $user->setToken($data["user_id"], $data["token"]);
            $result["code"] = 200;
            $result["msg"] = "登录成功";
            $result["data"] = $data;
        } else {
            $result["code"] = 201;
            $result["msg"] = "登录失败";
        }
        $this->ajaxReturn($result);
    }

    // 自动登录
    function autoLogin() {
        $param["user_id"] = $_POST["id"];
        $param["token"] = $_POST["token"];
        $user = new UserModel();
        $data = $user->checkToken($param)[0];
        if($data) {
            $data["token"] = md5($data["email"].time().$data["password"]);
            $result["code"] = 200;
            $result["msg"] = "自动登录成功";
            $result["data"] = $data;
        } else {
            $data["token"] = null;
            $result["code"] = 201;
            $result["msg"] = "自动登录失败";
        }
        $user->setToken($_POST["id"], $data["token"]);
        $this->ajaxReturn($result);
    }



    /* -------------------- 注册页面 -------------------- */

    // 1. 发送验证码
    public function sendCode() {
        $email = $_POST["email"];
        $user = new UserModel();
        if($user->checkEmail($email)) {
            $result["code"] = 201;
            $result["msg"] = "邮箱已注册";
        } else {
            $title = "孤岛验证码";
            $code = rand(1000, 9999);
            $content = "验证码为 <strong>{$code}</strong> 。你正在注册孤岛账号，欢迎加入孤岛！";
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

    // 2. 注册并登录
    public function doRegister() {
        $data["email"] = $_POST["email"];
        $data["password"] = md5($_POST["password"]);
        $user = new UserModel();
        if($user->register($data)) {
            $this->doLogin();
        } else {
            $result["code"] = 201;
            $result["msg"] = "注册失败";
        }
        $this->ajaxReturn($result);
    }


    /* -------------------- 首页 -------------------- */

    // 获取通知
    public function getNotice() {
        $notice = new NoticeModel();
        $data = $notice->getNoticeByPage(0, 7);
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

    // 获取演出时间表
    public function getShowCalendar() {
        $show = new ShowModel();
        $data = $show->getDateByShowNum($_POST["month"]);
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

    // 获取最新演出
    public function getRecentShow() {
        $show = new ShowModel();
        $data = $show->getShowByPage(0, 4, "show_time desc");
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

    // 获取热门演出
    public function getHotShow() {
        $want = new WantModel();
        $wantList = $want->sortShowByUserNum(0, 4);
        if(!$wantList) {
            $result["code"] = 201;
            $result["msg"] = "查询失败";
        } else {
            for($i = 0; $i < count($wantList); $i++) {
                $show = new ShowModel();
                $showList[$i] = $show->getShowByID($wantList[$i]["show_id"]);
                if(!$showList[$i]) {
                    $result["code"] = 201;
                    $result["msg"] = "查询失败";
                    $this->ajaxReturn($result);
                }
            }
            if($showList) {
                $result["code"] = 200;
                $result["msg"] = "查询成功";
                $result["data"] = $showList;
            } else {
                $result["code"] = 201;
                $result["msg"] = "查询失败";
            }
        }
        $this->ajaxReturn($result);
    }

    // 获取热门乐队
    public function getHotBand() {
        $support = new SupportModel();
        $supportList = $support->sortBandByUserNum(0, 4);
        if(!$supportList) {
            $result["code"] = 201;
            $result["msg"] = "查询失败";
        } else {
            for($i = 0; $i < count($supportList); $i++) {
                $band = new BandModel();
                $bandList[$i] = $band->getBandByID($supportList[$i]["band_id"]);
                if(!$bandList[$i]) {
                    $result["code"] = 201;
                    $result["msg"] = "查询失败";
                    $this->ajaxReturn($result);
                }
            }
            if($bandList) {
                $result["code"] = 200;
                $result["msg"] = "查询成功";
                $result["data"] = $bandList;
            } else {
                $result["code"] = 201;
                $result["msg"] = "查询失败";
            }
        }
        $this->ajaxReturn($result);
    }
}