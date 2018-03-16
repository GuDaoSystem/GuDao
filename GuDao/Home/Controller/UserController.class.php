<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\UserModel;
use Home\Model\WantModel;
use Home\Model\SupportModel;
use Home\Model\ShowModel;
use Home\Model\BandModel;
use Home\Model\CommentModel;
use Home\Model\ReplyModel;
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




    /* -------------------- 忘记密码 -------------------- */

    // 1. 发送验证码
    public function sendCode() {
        $email = $_POST["email"];
        $title = "孤岛验证码";
        $code = rand(1000, 9999);
        $content = "验证码为 <strong>{$code}</strong> 。你正在重新设置密码，若非本人操作请注意账号安全！";
        if(sendMail($email, $title, $content)) {
            S($email, $code, 60);
            $result["code"] = 200;
            $result["msg"] = "发送验证码成功";
            // setcookie("code", $code, time() + 60, "/");
        } else {
            $result["code"] = 201;
            $result["msg"] = "发送验证码失败";
        }
        $this->ajaxReturn($result);
    }

    // 2. 重设密码
    public function resetPassword() {
        $map["email"] = $_POST["email"];
        $param["password"] = md5($_POST["password"]);
        $user = new UserModel();
        $data = $user->resetPassword($map, $param);
        if($data) {
            $result["code"] = 200;
            $result["msg"] = "重设密码成功";
        } else {
            $result["code"] = 201;
            $result["msg"] = "重设密码失败";
        }
        $this->ajaxReturn($result);
    }

    // 校验验证码
    public function checkCode() {
        $email = $_POST["email"];
        $code = $_POST["code"];
        if(S($email) == $code) {
            S($email, null);
            $result["code"] = 200;
            $result["msg"] = "验证码正确";
        } else {
            $result["code"] = 201;
            $result["msg"] = "验证码错误";
        }
        $this->ajaxReturn($result);
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
        $activity = [];

        // 获取想看的演出
        $want = new WantModel();
        $wantList = $want->getShowByUser($_GET["id"]);
        if(!$wantList) {
            $result["code"] = 201;
            $result["msg"] = "查询失败";
            $this->ajaxReturn($result);
        }
        $result["data"]["want"] = count($wantList);
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
            array_push($activity, $tem);
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
        $result["data"]["support"] = count($supportList);
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
            array_push($activity, $tem);
        }

        // 按数组中的指定字段排序
        foreach($activity as $dataItem) {
            $sort[] = $dataItem["time"];
        }
        array_multisort($sort, SORT_DESC, $activity);

        $result["code"] = 200;
        $result["msg"] = "查询成功";
        $result["data"]["activity"] = $activity;
        $this->ajaxReturn($result);
    }

    // 获取演出时间表
    // public function getShowCalendar() {
    //     $data = array();
    //     $want = new WantModel();
    //     $wantList = $want->getShowByUser($_GET["id"]);
    //     if(!$wantList) {
    //         $result["code"] = 201;
    //         $result["msg"] = "查询失败";
    //         $this->ajaxReturn($result);
    //     }
    //     for($i = 0; $i < count($wantList); $i++) {
    //         if(!$wantList[$i]) {
    //             $result["code"] = 201;
    //             $result["msg"] = "查询失败";
    //             $this->ajaxReturn($result);
    //         }
    //         $show = new ShowModel();
    //         $tem = $show->getShowByID($wantList[$i]["show_id"]);
    //         if(!$tem) {
    //             $result["code"] = 201;
    //             $result["msg"] = "查询失败";
    //             $this->ajaxReturn($result);
    //         }
    //         array_push($data, $tem);
    //     }

    //     // 按数组中的指定字段排序
    //     foreach($data as $dataItem) {
    //         $sort[] = $dataItem["show_time"];
    //     }
    //     array_multisort($sort, SORT_ASC, $data);

    //     $result["code"] = 200;
    //     $result["msg"] = "查询成功";
    //     $result["data"] = $data;
    //     $this->ajaxReturn($result);
    // }

    // 获取用户发出的评论
    // public function getCommentByUser() {
    //     $comment = new CommentModel();
    //     $data = $comment->getCommentByUser($_GET["id"]);
    //     if($data) {
    //         $result["code"] = 200;
    //         $result["msg"] = "查询成功";
    //         $result["data"] = $data;
    //     } else {
    //         $result["code"] = 201;
    //         $result["msg"] = "查询失败";
    //     }
    //     $this->ajaxReturn($result);
        
    // }

    // 修改用户信息
    public function modifyUserInfo() {
        // $id = $_POST["id"];
        // if($_POST["email"]) {
        //     $data["email"] = $_POST["email"];
        // }
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
        if($user->modifyUserInfo($_POST["id"], $data)) {
            $result["code"] = 200;
            $result["msg"] = "修改成功";
        } else {
            $result["code"] = 201;
            $result["msg"] = "修改失败";
        }
        $this->ajaxReturn($result);
    }


    // 获取用户收到的回复
    public function getReplyByUser() {
        $reply = new ReplyModel();
        $data = $reply->getReplyByTarget($_GET["id"]);
        if(!$data) {
            $result["code"] = 201;
            $result["msg"] = "查询失败1";
            $this->ajaxReturn($result);
        }
        for($i = 0; $i < count($data); $i++) {
            if(!$data[$i]) {
                $result["code"] = 201;
                $result["msg"] = "查询失败2";
                $this->ajaxReturn($result);
            }
            $user = new UserModel();
            $data[$i]["user"] = $user->getUserBasicInfo($data[$i]["user_id"]);
            if(!$data[$i]["user"]) {
                $result["code"] = 201;
                $result["msg"] = "查询失败3";
                $this->ajaxReturn($result);
            }
        }
        $result["code"] = 200;
        $result["msg"] = "查询成功";
        $result["data"] = $data;
        $this->ajaxReturn($result);
    }


    // 检查是否有未读消息
    public function hasUnreadMessage() {
        $reply = new ReplyModel();
        $data = $reply->hasUnreadMessage($_GET["id"]);
        if($data) {
            $result["code"] = 200;
            $result["msg"] = "查询成功";
        } else {
            $result["code"] = 201;
            $result["msg"] = "查询失败";
        }
        $this->ajaxReturn($result);
    }

    // 回复消息
    public function replyMessage() {
        $data["comment_id"] = $_POST["comment_id"];
        $data["reply_content"] = $_POST["content"];
        $data["reply_type"] = $_POST["type"];
        $data["reply_time"] = $_POST["time"];
        $data["user_id"] = $_POST["user_id"];
        $data["target_id"] = $_POST["target_id"];
        $reply = new ReplyModel();
        $data = $reply->replyComment($data);
        if($data) {
            $result["code"] = 200;
            $result["msg"] = "回复成功";
        } else {
            $result["code"] = 201;
            $result["msg"] = "回复失败";
        }
        $this->ajaxReturn($result);
    }

    // 已读消息
    public function readMessage() {
        $reply = new ReplyModel();
        $data = $reply->readMessage($_POST["id"]);
        if($data) {
            $result["code"] = 200;
            $result["msg"] = "已读成功";
        } else {
            $result["code"] = 201;
            $result["msg"] = "已读失败";
        }
        $this->ajaxReturn($result);
    }
}