<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\UserModel;
class UserController extends Controller {
    public function index(){
        $this->display();
    }


    // 按页获取用户
    public function getUsers() {
        $startIndex = ($_GET["pageIndex"] - 1) * $_GET["pageSize"];
        $pageLength = $_GET["pageSize"];

        $user = new UserModel();
        $data = $user->getUsers($startIndex, $pageLength);

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

    // 删除用户
    public function deleteUser() {
        $id = $_POST["id"];
        $param["email"] = "用户已注销";
        $param["password"] = null;
        $param["headshot"] = null;
        $param["token"] = null;
        $param["expire"] = null;

        $user = new UserModel();
        $data = $user->modifyUser($id, $param);

        if($data) {
            $result["code"] = 200;
            $result["msg"] = "删除成功";
        } else {
            $result["code"] = 201;
            $result["msg"] = "删除失败";
        }

        $this->ajaxReturn($result);
    }
}