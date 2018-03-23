<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\ShowModel;
use Home\Model\WantModel;
use Home\Model\AttendModel;
use Home\Model\BandModel;
use Home\Model\CommentModel;
use Home\Model\ReplyModel;
use Home\Model\UserModel;
class ShowController extends Controller {
	// 渲染页面
    public function index(){
    	$this->display();
    }
    public function detail(){
    	$this->display();
    }



    /* -------------------- 演出列表页 -------------------- */

    // 获取所有演出地点
    public function getShowPlace() {
        $show = new ShowModel();
        $data = $show->getShowPlace();
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

    // 按页获取演出列表
    public function getShowByPage() {
        $startIndex = ($_GET["pageIndex"] - 1) * $_GET["pageSize"];
        $pageLength = $_GET["pageSize"];
        if($_GET["place"]) {
            $condition["show_place"] = $_GET["place"];
        }
        if($_GET["state"] > 0) {
            $condition["show_state"] = $_GET["state"];
        }
        $show = new ShowModel();
        $data = $show->getShowByCondition($startIndex, $pageLength, $condition);
        if(!$data) {
            $result["code"] = 201;
            $result["msg"] = "查询失败";
            $this->ajaxReturn($result);
        }
        for($i = 0; $i < count($data); $i++) {
            if(!$data[$i]) {
                $result["code"] = 201;
                $result["msg"] = "查询失败";
                $this->ajaxReturn($result);
            }

            $want = new WantModel();
            $data[$i]["want"] = $want->getUserNumByShow($data[$i]["show_id"]);
            if(!$data[$i]["want"]) {
                $data[$i]["want"] = 0;
            }

            $attend = new AttendModel();
            $bandID = $attend->getBandIDByShow($data[$i]["show_id"]);
            if(!$bandID) {
                $result["code"] = 201;
                $result["msg"] = "查询失败";
                $this->ajaxReturn($result);
            }
            for($j = 0; $j < count($bandID); $j++) {
                if(!$bandID[$j]) {
                    $result["code"] = 201;
                    $result["msg"] = "查询失败";
                    $this->ajaxReturn($result);
                }
                $band = new BandModel();
                $data[$i]["band"][$j] = $band->getBandByID($bandID[$j]);
                if(!$data[$i]["band"][$j]) {
                    $result["code"] = 201;
                    $result["msg"] = "查询失败";
                    $this->ajaxReturn($result);
                }
            }
        }
        $result["code"] = 200;
        $result["msg"] = "查询成功";
        $result["data"] = $data;
        if($_GET["sort"] == "hot") {
            foreach($result["data"] as $dataItem) {
                $sort[] = $dataItem["want"];
            }
            array_multisort($sort, SORT_DESC, $result["data"]);
        }
        $this->ajaxReturn($result);
    }



    /* -------------------- 演出详细页 -------------------- */

    // 按ID获取指定演出
    public function getShowByID() {
    	$show = new ShowModel();
    	$data = $show->getShowByID($_GET["id"]);
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

    // 获取演出参演乐队
    public function getBandByShow() {
        $attend = new AttendModel();
        $bandID = $attend->getBandIDByShow($_GET["id"]);
        if(!$bandID) {
            $result["code"] = 201;
            $result["msg"] = "查询失败";
            $this->ajaxReturn($result);
        }
        for($i = 0; $i < count($bandID); $i++) {
            if(!$bandID[$i]) {
                $result["code"] = 201;
                $result["msg"] = "查询失败";
                $this->ajaxReturn($result);
            }
            $band = new BandModel();
            $data[$i] = $band->getBandByID($bandID[$i]);
            if(!$data[$i]) {
                $result["code"] = 201;
                $result["msg"] = "查询失败";
                $this->ajaxReturn($result);
            }
        }

        $result["code"] = 200;
        $result["msg"] = "查询成功";
        $result["data"] = $data;
        $this->ajaxReturn($result);
    }

    // 获取演出想看的用户数量
    public function getWantUserNum() {
        $want = new WantModel();
        $data = $want->getUserNumByShow($_GET["id"]);
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

    // 检测是否想看
    public function checkWant() {
        $data["user_id"] = $_POST["user_id"];
        $data["show_id"] = $_POST["show_id"];
        $want = new WantModel();
        if($want->checkWant($data)) {
            $result["code"] = 200;
            $result["msg"] = "已想看";
        } else {
            $result["code"] = 201;
            $result["msg"] = "未想看";
        }
        $this->ajaxReturn($result);
    }

    // 新增想看
    public function addWant() {
        $data["user_id"] = $_POST["user_id"];
        $data["show_id"] = $_POST["show_id"];
        $data["want_time"] = $_POST["time"];
        $want = new WantModel();
        if($want->addWant($data)) {
            $result["code"] = 200;
            $result["msg"] = "新增想看记录成功";
        } else {
            $result["code"] = 201;
            $result["msg"] = "新增想看记录失败";
        }
        $this->ajaxReturn($result);
    }

    // 删除想看
    public function deleteWant() {
        $data["user_id"] = $_POST["user_id"];
        $data["show_id"] = $_POST["show_id"];
        $want = new WantModel();
        if($want->deleteWant($data)) {
            $result["code"] = 200;
            $result["msg"] = "删除想看记录成功";
        } else {
            $result["code"] = 201;
            $result["msg"] = "删除想看记录失败";
        }
        $this->ajaxReturn($result);
    }

    // 获取评论及回复
    public function getCommentNReply() {
        $data["comment_target"] = $_GET["target"];
        $data["target_id"] = $_GET["id"];
        $comment = new CommentModel();
        $data = $comment->getCommentByTarget($data);
        if(!$data) {
            $result["code"] = 201;
            $result["msg"] = "查询失败";
            $this->ajaxReturn($result);
        }
        for($i = 0; $i < count($data); $i++) {
            if(!$data[$i]) {
                $result["code"] = 201;
                $result["msg"] = "查询失败";
                $this->ajaxReturn($result);
            }

            $user = new UserModel();
            $data[$i]["user"] = $user->getUserBasicInfo($data[$i]["user_id"]);
            if(!$data[$i]["user"]) {
                $result["code"] = 201;
                $result["msg"] = "查询失败";
                $this->ajaxReturn($result);
            }

            $reply = new ReplyModel();
            $data[$i]["reply"] = $reply->getReplyByComment($data[$i]["comment_id"]);
            if($data[$i]["reply"]) {
                for($j = 0; $j < count($data[$i]["reply"]); $j++) {
                    $user = new UserModel();
                    $data[$i]["reply"][$j]["user"] = $user->getUserBasicInfo($data[$i]["reply"][$j]["user_id"]);
                    if(!$data[$i]["reply"][$j]["user"]) {
                        $result["code"] = 201;
                        $result["msg"] = "查询失败";
                        $this->ajaxReturn($result);
                    }
                    $data[$i]["reply"][$j]["target"] = $user->getUserBasicInfo($data[$i]["reply"][$j]["target_id"]);
                    if(!$data[$i]["reply"][$j]["target"]) {
                        $result["code"] = 201;
                        $result["msg"] = "查询失败";
                        $this->ajaxReturn($result);
                    }
                }
                
            }
        }

        $result["code"] = 200;
        $result["msg"] = "查询成功";
        $result["data"] = $data;
        $this->ajaxReturn($result);
    }

    // 发送评论
    public function sendComment() {
        $data["comment_content"] = $_POST["content"];
        $data["user_id"] = $_POST["user_id"];
        $data["comment_time"] = $_POST["time"];
        $data["comment_target"] = $_POST["target"];
        $data["target_id"] = $_POST["target_id"];
        $comment = new CommentModel();
        $data = $comment->sendComment($data);
        if($data) {
            $result["code"] = 200;
            $result["msg"] = "评论成功";
        } else {
            $result["code"] = 201;
            $result["msg"] = "评论失败";
        }
        $this->ajaxReturn($result);
    }

    // 回复评论
    public function replyComment() {
        $data["comment_id"] = $_POST["comment_id"];
        $data["reply_content"] = $_POST["content"];
        $data["reply_time"] = $_POST["time"];
        $data["user_id"] = $_POST["user_id"];
        $data["target_id"] = $_POST["target_id"];
        $data["isRead"] = 0;
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
}