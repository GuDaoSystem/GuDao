<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\NoticeModel;
class NoticeController extends Controller {
    public function index(){
        $this->display();
    }



    /* -------------------- 通知列表页面 -------------------- */

    // 按页获取通知列表
    public function getNoticeByPage() {
    	$startIndex = ($_GET["pageIndex"] - 1) * $_GET["pageSize"];
    	$pageLength = $_GET["pageSize"];
        if($_GET["type"]) {
            $condition["notice_type"] = $_GET["type"];
        }

    	$notice = new NoticeModel();
        $data = $notice->getNoticeByPage($startIndex, $pageLength, $condition);
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