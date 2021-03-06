<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\BandModel;
use Home\Model\NoticeModel;
use Home\Model\ShowModel;
use Home\Model\SupportModel;
use Home\Model\UserModel;
use Home\Model\WantModel;
class IndexController extends Controller {
    // 渲染页面
    public function index(){
        $this->display();
    }
    public function home(){
        $this->display();
    }
    public function login(){
        $this->display();
    }
    public function register(){
        $this->display();
    }
    public function search(){
        $this->display();
    }



    /* -------------------- 通用 -------------------- */

    // 检查是否登录
    public function checkLogin() {
        $user = new UserModel();

        if(cookie("GuDaoUser")) {
            $param["user_id"] = cookie("GuDaoUser")[0];
            $param["token"] = cookie("GuDaoUser")[1];
            $data = $user->checkToken($param)[0];
            $param = null;
            if($data) {
                $param["token"] = md5($data["email"].time().$data["password"]);
                $param["expire"] = $data["expire"];
                if($user->setAutoLogin($data["user_id"], $param)) {
                    cookie("GuDaoUser", array($data["user_id"], $param["token"]), (strtotime($data["expire"]) - time()), "/");
                }
                session("user", $data["user_id"]);
            } else {
                $param["token"] = null;
                $param["expire"] = null;
                $user->setAutoLogin(cookie("GuDaoUser")[0], $param);
                cookie("GuDaoUser", null);
            }
        }
    	
    	$data = $user->getUserBasicInfo(session("user"));
    	if($data) {
    		$result["code"] = 200;
    		$result["msg"] = "已登录";
    		$result["data"] = $data;
    	} else {
    		$result["code"] = 201;
    		$result["msg"] = "未登录";
    	}
    	$this->ajaxReturn($result);
    }

    // 退出登录
    public function logout() {
        $user = new UserModel();
        $param["token"] = null;
        $param["expire"] = null;
        $data = $user->setAutoLogin(session("user"), $param);
    	session("user", null);
        cookie("GuDaoUser", null);
    }


    /* -------------------- 首页 -------------------- */

    // 获取通知列表
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
            $this->ajaxReturn($result);
        }
        // 按想看数量获取演出
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
        $this->ajaxReturn($result);
    }

    // 获取热门乐队
    public function getHotBand() {
        $support = new SupportModel();
        $supportList = $support->sortBandByUserNum(0, 4);
        if(!$supportList) {
            $result["code"] = 201;
            $result["msg"] = "查询失败";
            $this->ajaxReturn($result);
        }
        // 按支持数量获取乐队
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
        $this->ajaxReturn($result);
    }


    /* -------------------- 登录页面 -------------------- */

    // 登录
    public function doLogin() {
        $param["email"] = $_POST["email"];
        $param["password"] = md5($_POST["password"]);

        $user = new UserModel();
        $data = $user->login($param)[0];
        if($data) {
            // 自动登录
            if($_POST["autoLogin"] == "true") {
                $param = null;
                $param["token"] = md5($_POST["email"].time().md5($_POST["password"]));
                $param["expire"] = date("Y-m-d H:i:s", strtotime("+5 day"));
                if($user->setAutoLogin($data["user_id"], $param)) {
                    cookie("GuDaoUser", array($data["user_id"], $param["token"]), 60 * 60 * 24 * 5, "/");
                }
            }
            // 存储用户登录信息
            session("user", $data["user_id"]);

            $result["code"] = 200;
            $result["msg"] = "登录成功";
        } else {
            $result["code"] = 201;
            $result["msg"] = "登录失败";
        }
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
                S($email, $code, 60);
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
        $email = $_POST["email"];
        $code = $_POST["code"];

        // 校验验证码
        if(S($email) == $code) {
            $data["email"] = $email;
            $data["password"] = md5($_POST["password"]);
            $data["username"] = "孤岛没有名字";
            $data["intro"] = "孤岛没有简介";

            $user = new UserModel();
            if($user->register($data)) {
                $this->doLogin();
            } else {
                $result["code"] = 201;
                $result["msg"] = "注册失败";
            }
        } else {
            $result["code"] = 201;
            $result["msg"] = "验证码错误";
        }
        S($email, null);
        $this->ajaxReturn($result);
    }


    /* -------------------- 搜索页面 -------------------- */

    // 搜索通知
    public function searchNotice() {
        $startIndex = ($_GET["pageIndex"] - 1) * $_GET["pageSize"];
        $pageLength = $_GET["pageSize"];

        $notice = new NoticeModel();
        $data = $notice->searchNoticeByContent($startIndex, $pageLength, $_GET["key"]);
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

    // 搜索演出
    public function searchShow() {
        $startIndex = ($_GET["pageIndex"] - 1) * $_GET["pageSize"];
        $pageLength = $_GET["pageSize"];

        $show = new ShowModel();
        $data = $show->searchShowByName($startIndex, $pageLength, $_GET["key"]);
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

    // 搜索乐队
    public function searchBand() {
        $startIndex = ($_GET["pageIndex"] - 1) * $_GET["pageSize"];
        $pageLength = $_GET["pageSize"];
        
        $band = new BandModel();
        $data = $band->searchBandByName($startIndex, $pageLength, $_GET["key"]);
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
}