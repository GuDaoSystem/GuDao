<?php
namespace Home\Model;
use Think\Model;
class UserModel extends Model {
    // 登录
    public function login($param) {
        $user = new UserModel();
        $result = $user->where($param)->field("user_id, username, headshot")->select();
        return $result;
    }

    // 设置token
    // public function setToken($id, $token) {
    //     $user = new UserModel();
    //     $map["user_id"] = $id;
    //     $param["token"] = $token;
    //     $result = $user->where($map)->save($param);
    //     return $result;
    // }
    public function setAutoLogin($id, $param) {
        $user = new UserModel();
        $map["user_id"] = $id;
        $result = $user->where($map)->save($param);
        return $result;
    }

    // 检查token
    public function checkToken($param) {
        $user = new UserModel();
        // $result = $user->where($param)->field("user_id, username, headshot")->select();
        $result = $user->where($param)->select();
        return $result;
    }

    // 修改用户信息
    public function resetPassword($map, $param) {
        $user = new UserModel();
        $result = $user->where($map)->save($param);
        return $result;
    }

    // 查询邮箱是否已存在
    public function checkEmail($email) {
        $user = new UserModel();
        $map["email"] = $email;
        $result = $user->where($map)->select();
        return $result;
    }

    // 注册
    public function register($param) {
     $user = new UserModel();
     $result = $user->add($param);
     return $result;
    }




    // 获取用户基本信息
    public function getUserBasicInfo($id) {
        $user = new UserModel();
        $map["user_id"] = $id;
        $result = $user->where($map)->field("user_id, username, gender, birthday, headshot, intro")->select();
        return $result[0];
    }

    // 查询密码是否已正确
    public function checkPassword($data) {
        $user = new UserModel();
        $result = $user->where($data)->select();
        return $result;
    }


    // 修改用户信息
    public function modifyUserInfo($id, $data) {
        $user = new UserModel();
        $map["user_id"] = $id;
        $result = $user->where($map)->save($data);
        return $result;
    }
}