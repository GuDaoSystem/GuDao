<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\NoticeModel;
class NoticeController extends Controller {
    public function index(){
        $this->display();
    }

    // 按页获取通知列表
    public function getNoticeByPage() {
    	$startIndex = ($_GET["pageIndex"] - 1) * $_GET["pageSize"];
    	$pageLength = $_GET["pageSize"];
    	$notice = new NoticeModel();
        $data = $notice->getNoticeByPage($startIndex, $pageLength);
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

    // 按类型获取通知列表
    public function getNoticeByType() {
        $startIndex = ($_GET["pageIndex"] - 1) * $_GET["pageSize"];
        $pageLength = $_GET["pageSize"];
    	$notice = new NoticeModel();
        $data = $notice->getNoticeByType($startIndex, $pageLength, $_GET["type"]);
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