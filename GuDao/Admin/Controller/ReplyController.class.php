<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\ReplyModel;
class ReplyController extends Controller {
    public function index(){
        $this->display();
    }


    // 按页获取回复
    public function getReplys() {
        $startIndex = ($_GET["pageIndex"] - 1) * $_GET["pageSize"];
        $pageLength = $_GET["pageSize"];

        $reply = new ReplyModel();
        $data = $reply->getReplys($startIndex, $pageLength);

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

    // 删除回复
    public function deleteReply() {
    	$reply = new ReplyModel();

    	if($reply->deleteReply($_POST["id"])) {
    		$result["code"] = 200;
    		$result["msg"] = "删除成功";
    	} else {
    		$result["code"] = 201;
    		$result["msg"] = "删除失败";
    	}
    	
    	$this->ajaxReturn($result);
    }
}