<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\ShowModel;
use Home\Model\WantModel;
use Home\Model\AttendModel;
use Home\Model\BandModel;
use Home\Model\CommentModel;
use Home\Model\ReplyModel;
class ShowController extends Controller {
	// 渲染页面
    public function index(){
    	$this->display();
    }
    public function detail(){
    	$this->display();
    }



    /* -------------------- 演出列表页面 -------------------- */

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
                $result["code"] = 201;
                $result["msg"] = "查询失败";
                $this->ajaxReturn($result);
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



    /* -------------------- 演出详细页面 -------------------- */

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

    // 点击想看/取消想看
    public function toggleWant() {
        $data["user_id"] = $_POST["user_id"];
        $data["show_id"] = $_POST["show_id"];
        $want = new WantModel();
        // 取消想看
        if($want->checkWant($data)) {
            if($want->deleteWant($data)) {
                $result["code"] = 200;
                $result["msg"] = "删除想看记录成功";
            } else {
                $result["code"] = 201;
                $result["msg"] = "删除想看记录失败";
            }
        }
        // 想看
        else {
            $data["want_time"] = $_POST["time"];
            if($want->addWant($data)) {
                $result["code"] = 200;
                $result["msg"] = "新增想看记录成功";
            } else {
                $result["code"] = 201;
                $result["msg"] = "新增想看记录失败";
            }
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