<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\AttendModel;
use Home\Model\BandModel;
use Home\Model\CommentModel;
use Home\Model\PictureModel;
use Home\Model\ReplyModel;
use Home\Model\ShowModel;
use Home\Model\SupportModel;
use Home\Model\UserModel;
class BandController extends Controller {
	// 渲染页面
    public function index(){
    	$this->display();
    }
    public function detail(){
    	$this->display();
    }



    /* -------------------- 乐队列表页 -------------------- */

    // 获取所有乐队首字母
    public function getInitial() {
        $band = new BandModel();
        $data = $band->getInitial();
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

    // 按页获取乐队列表
    public function getBandByPage() {
        $startIndex = ($_GET["pageIndex"] - 1) * $_GET["pageSize"];
        $pageLength = $_GET["pageSize"];
        if($_GET["initial"]) {
            $condition["band_initial"] = $_GET["initial"];
        }

        $band = new BandModel();
        $data = $band->getBandByPage($startIndex, $pageLength, $condition);
        if(!$data) {
            $result["code"] = 201;
            $result["msg"] = "查询失败";
            $this->ajaxReturn($result);
        }
        // 按乐队获取支持数量
        for($i = 0; $i < count($data); $i++) {
            if(!$data[$i]) {
                $result["code"] = 201;
                $result["msg"] = "查询失败";
                $this->ajaxReturn($result);
            }
            $support = new SupportModel();
            $data[$i]["support"] = $support->getUserNumByBand($data[$i]["band_id"]);
        }
        // 按字段排序
        foreach ($data as $key => $item) {
            $key1[$key] = $item["support"];
            $key2[$key] = $item["band_name"];
        }
        array_multisort($key1, SORT_DESC, $key2, SORT_ASC, $data);

        $result["code"] = 200;
        $result["msg"] = "查询成功";
        $result["data"] = $data;
        $this->ajaxReturn($result);
    }


    /* -------------------- 乐队详细页面 -------------------- */

    // 按ID获取指定乐队
    public function getBandByID() {
    	$band = new BandModel();
    	$data = $band->getBandByID($_GET["id"]);
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

    // 获取乐队支持的用户数量
    public function getSupportUserNum() {
        $support = new SupportModel();
        $data = $support->getUserNumByBand($_GET["id"]);
        $result["code"] = 200;
        $result["msg"] = "查询成功";
        if($data) {
            $result["data"] = $data;
        } else {
            $result["data"] = 0;
        }
        $this->ajaxReturn($result);
    }

    // 检测是否想看
    public function checkSupport() {
        $data["user_id"] = $_POST["user_id"];
        $data["band_id"] = $_POST["band_id"];

        $support = new SupportModel();
        if($support->checkSupport($data)) {
            $result["code"] = 200;
            $result["msg"] = "已支持";
        } else {
            $result["code"] = 201;
            $result["msg"] = "未支持";
        }
        $this->ajaxReturn($result);
    }

    // 新增想看
    public function addSupport() {
        $data["user_id"] = $_POST["user_id"];
        $data["band_id"] = $_POST["band_id"];
        $data["support_time"] = $_POST["time"];

        $support = new SupportModel();
        if($support->addSupport($data)) {
            $result["code"] = 200;
            $result["msg"] = "新增支持记录成功";
        } else {
            $result["code"] = 201;
            $result["msg"] = "新增支持记录失败";
        }
        $this->ajaxReturn($result);
    }

    // 删除想看
    public function deleteSupport() {
        $data["user_id"] = $_POST["user_id"];
        $data["band_id"] = $_POST["band_id"];

        $support = new SupportModel();
        if($support->deleteSupport($data)) {
            $result["code"] = 200;
            $result["msg"] = "删除支持记录成功";
        } else {
            $result["code"] = 201;
            $result["msg"] = "删除支持记录失败";
        }
        $this->ajaxReturn($result);
    }

    // 获取乐队演出经历
    public function getExperience() {
        $attend = new AttendModel();
        $showID = $attend->getShowByBand($_GET["id"]);
        if(!$showID) {
            $result["code"] = 201;
            $result["msg"] = "查询失败";
            $this->ajaxReturn($result);
        }
        // 获取演出
        for($i = 0; $i < count($showID); $i++) {
            if(!$showID[$i]) {
                $result["code"] = 201;
                $result["msg"] = "查询失败";
                $this->ajaxReturn($result);
            }
            $show = new ShowModel();
            $data[$i] = $show->getShowByID($showID[$i]);
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

    // 按乐队获取图片
    public function getPictureByBand() {
        $picture = new PictureModel();
        $data = $picture->getPictureByBand($_GET["id"]);
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
            // 按评论获取评论者
            $user = new UserModel();
            $data[$i]["user"] = $user->getUserBasicInfo($data[$i]["user_id"]);
            if(!$data[$i]["user"]) {
                $result["code"] = 201;
                $result["msg"] = "查询失败";
                $this->ajaxReturn($result);
            }
            // 按评论获取回复
            $reply = new ReplyModel();
            $data[$i]["reply"] = $reply->getReplyByComment($data[$i]["comment_id"]);
            if($data[$i]["reply"]) {
                for($j = 0; $j < count($data[$i]["reply"]); $j++) {
                    $user = new UserModel();
                    // 按回复获取回复用户
                    $data[$i]["reply"][$j]["user"] = $user->getUserBasicInfo($data[$i]["reply"][$j]["user_id"]);
                    if(!$data[$i]["reply"][$j]["user"]) {
                        $result["code"] = 201;
                        $result["msg"] = "查询失败";
                        $this->ajaxReturn($result);
                    }
                    // 按回复获取被回复用户
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