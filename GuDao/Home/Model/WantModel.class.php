<?php
namespace Home\Model;
use Think\Model;
class WantModel extends Model {
	
	// 按用户获取演出
	public function getShowByUser($id) {
		$want = new WantModel();
		$map["user_id"] = $id;
		$result = $want->where($map)->field("want_time as time, show_id")->order("time desc")->select();
		return $result;
	}

	// 按演出获取用户数量
	public function getUserNumByShow($id) {
		$want = new WantModel();
		$map["show_id"] = $id;
		$result = $want->where($map)->count();
		return $result;
	}

	// 按用户数量排序演出
	public function sortShowByUserNum($startIndex, $pageLength) {
		$want = new WantModel();
		$result = $want->field("count('user_id') as count, show_id")->group("show_id")->limit($startIndex, $pageLength)->order("count desc")->select();
		return $result;
	}

	// 检查想看记录
	public function checkWant($data) {
		$want = new WantModel();
		$result = $want->where($data)->select();
		return $result;
	}

	// 新增想看记录
	public function addWant($data) {
		$want = new WantModel();
		$result = $want->add($data);
		return $result;
	}

	// 删除想看记录
	public function deleteWant($data) {
		$want = new WantModel();
		$result = $want->where($data)->delete();
		return $result;
	}
}