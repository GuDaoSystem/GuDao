<?php
namespace Admin\Model;
use Think\Model;
class UserModel extends Model {

    // 按页获取用户
    public function getUsers($startIndex, $pageLength) {
        $user = new UserModel();
        $map["password"] = array("neq", "");
        $result = $user->where($map)->limit($startIndex, $pageLength)->field("user_id, email, username, gender, birthday, headshot, intro")->select();
        return $result;
    }

    // 修改用户
    public function modifyUser($id, $param) {
        $user = new UserModel();
        $map["user_id"] = $id;
        $result = $user->where($map)->save($param);
        return $result;
    }
}