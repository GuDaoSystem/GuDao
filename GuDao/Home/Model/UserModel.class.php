<?php
namespace Home\Model;
use Think\Model;
class UserModel extends Model {
	// 登录
    public function login($data) {
    	$user = new UserModel();
    	$result = $user->where($data)->select();
    	return $result;
    }

    // 注册
    public function register($data) {
    	$user = new UserModel();
    	$result = $user->add($data);
    	return $result;
    }

    // 获取用户信息
    public function getUserInfo($id) {
    	$user = new UserModel();
    	$map["user_id"] = $id;
        $result = $user->where($map)->field("user_id, username, gender, birthday, headshot, intro")->select();
    	return $result[0];
    }

    // 修改用户信息
    public function modifyUserInfo($id, $data) {
    	$user = new UserModel();
    	$map["user_id"] = $id;
    	$result = $user->where($map)->save($data);
    	return $result;
    }

    // 查询邮箱是否已存在
    public function checkEmail($email) {
    	$user = new UserModel();
    	$map["email"] = $email;
    	$result = $user->where($map)->select();
    	return $result;
    }
}