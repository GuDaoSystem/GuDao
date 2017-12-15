<?php
namespace Home\Model;
use Think\Model;
class UserModel extends Model {
    public function login($data) {
    	$user = new UserModel();
        return $user->select();
    }
}