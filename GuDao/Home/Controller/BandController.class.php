<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\BandModel;
use Home\Model\SupportModel;
use Home\Model\AttendModel;
use Home\Model\ShowModel;
use Home\Model\PictureModel;
use Home\Model\CommentModel;
use Home\Model\ReplyModel;
class BandController extends Controller {
	// 渲染页面
    public function index(){
    	$this->display();
    }
    public function detail(){
    	$this->display();
    }



    /* -------------------- 乐队列表页面 -------------------- */

    // 按支持度获取所有乐队
    public function getBandBySupport() {
    	$startIndex = ($_GET["pageIndex"] - 1) * $_GET["pageSize"];
    	$pageLength = $_GET["pageSize"];

        $support = new SupportModel();
        $supportList = $support->sortBandByUserNum($startIndex, $pageLength);
        if(!$supportList) {
            $result["code"] = 200;
            $result["msg"] = "查询失败";
        } else {
            for($i = 0; $i < count($supportList); $i++) {
                if(!$supportList[$i]) {
                    $result["code"] = 200;
                    $result["msg"] = "查询失败";
                }
                $band = new BandModel();
                $data[$i] = $band->getBandByID($supportList[$i]["band_id"]);
                if(!$data[$i]) {
                    $result["code"] = 200;
                    $result["msg"] = "查询失败";
                }
            }
        }

    	$result["code"] = 200;
    	$result["msg"] = "查询成功";
        $result["data"] = $data;
    	$this->ajaxReturn($result);
    }

    // 按名称获取所有乐队
    public function getBandByName() {
        $startIndex = ($_GET["pageIndex"] - 1) * $_GET["pageSize"];
        $pageLength = $_GET["pageSize"];
        $band = new BandModel();
        $data = $band->getBandByName($startIndex, $pageLength);
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

    // 按首字母获取乐队
    public function getBandByInitial() {
        $startIndex = ($_GET["pageIndex"] - 1) * $_GET["pageSize"];
        $pageLength = $_GET["pageSize"];
        $initial = $_GET["initial"];
        $band = new BandModel();
        $data = $band->getBandByInitial($startIndex, $pageLength, $initial);
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

    // 点击支持/取消支持
    public function toggleSupport() {
        $data["user_id"] = $_POST["user_id"];
        $data["band_id"] = $_POST["band_id"];
        $support = new SupportModel();
        // 取消支持
        if($support->checkSupport($data)) {
            if($support->deleteSupport($data)) {
                $result["code"] = 200;
                $result["msg"] = "删除支持记录成功";
            } else {
                $result["code"] = 201;
                $result["msg"] = "删除支持记录失败";
            }
        }
        // 想看
        else {
            $data["support_time"] = $_POST["time"];
            if($support->addSupport($data)) {
                $result["code"] = 200;
                $result["msg"] = "新增支持记录成功";
            } else {
                $result["code"] = 201;
                $result["msg"] = "新增支持记录失败";
            }
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
            $reply = new ReplyModel();
            $data[$i]["reply"] = $reply->getReplyByComment($data[$i]["comment_id"]);
        }

        $result["code"] = 200;
        $result["msg"] = "查询成功";
        $result["data"] = $data;
        $this->ajaxReturn($result);
    }
}