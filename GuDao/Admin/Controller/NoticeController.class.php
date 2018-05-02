<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\NoticeModel;
class NoticeController extends Controller {
    public function index(){
        $this->display();
    }


    // 按页获取通知
    public function getNotices() {
        $startIndex = ($_GET["pageIndex"] - 1) * $_GET["pageSize"];
        $pageLength = $_GET["pageSize"];

        $notice = new NoticeModel();
        $data = $notice->getNotices($startIndex, $pageLength);

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

    // 新增通知
    public function addNotice() {
        if($_POST["type"]) {
            $param["notice_type"] = $_POST["type"];
        }
        $param["notice_time"] = $_POST["time"];
        $param["notice_content"] = $_POST["content"];
        $param["show_id"] = $_POST["show"];

        $notice = new NoticeModel();

        if($notice->addNotice($param)) {
            $result["code"] = 200;
            $result["msg"] = "新增成功";
        } else {
            $result["code"] = 201;
            $result["msg"] = "新增失败";
        }

        $this->ajaxReturn($result);
    }

    // 删除通知
    public function deleteNotice() {
        $notice = new NoticeModel();

        if($notice->deleteNotice($_POST["id"])) {
            $result["code"] = 200;
            $result["msg"] = "删除成功";
        } else {
            $result["code"] = 201;
            $result["msg"] = "删除失败";
        }

        $this->ajaxReturn($result);
    }

    // 修改通知
    public function modifyNotice() {
        $id = $_POST["id"];
        if($_POST["type"]) {
            $param["notice_type"] = $_POST["type"];
        }
        $param["notice_time"] = $_POST["time"];
        if($_POST["content"]) {
            $param["notice_content"] = $_POST["content"];
        }
        if($_POST["show"]) {
            $param["notice_show"] = $_POST["show"];
        }

        $notice = new NoticeModel();

        if($notice->modifyNotice($id, $param)) {
            $result["code"] = 200;
            $result["msg"] = "修改成功";
        } else {
            $result["code"] = 201;
            $result["msg"] = "修改失败";
        }
        
        $this->ajaxReturn($result);
    }
}