<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\CommentModel;
class CommentController extends Controller {
    public function index(){
        $this->display();
    }


    // 按页获取评论
    public function getComments() {
        $startIndex = ($_GET["pageIndex"] - 1) * $_GET["pageSize"];
        $pageLength = $_GET["pageSize"];

        $comment = new CommentModel();
        $data = $comment->getComments($startIndex, $pageLength);

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

    // 删除评论
    public function deleteComment() {
        $comment = new CommentModel();
        
        if($comment->deleteComment($_POST["id"])) {
            $result["code"] = 200;
            $result["msg"] = "删除成功";
        } else {
            $result["code"] = 201;
            $result["msg"] = "删除失败";
        }

        $this->ajaxReturn($result);
    }
}