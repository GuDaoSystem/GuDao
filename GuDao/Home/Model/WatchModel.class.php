<?php
namespace Home\Model;
use Think\Model;
class WatchModel extends Model {
	// 按用户获取演出
	public function getShowByUser($id) {
		$watch = new WatchModel();
		$map["user_id"] = $id;
		$result = $watch->where($map)->select();
		return $result;
	}

	// 按演出获取用户数量
	public function getUserNumByShow($id) {
		$watch = new WatchModel();
		$map["show_id"] = $id;
		$result = $watch->where($map)->count();
		return $result;
	}
}