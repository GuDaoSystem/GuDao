<?php
namespace Home\Model;
use Think\Model;
class SupportModel extends Model {
	// 按用户获取乐队
	public function getBandByUser($id) {
		$support = new SupportModel();
		$map["user_id"] = $id;
		$result = $support->where($map)->field("support_time as time, band_id")->order("time desc")->select();
		return $result;
	}

	// 按乐队获取用户数量
	// public function getUserNumByBand($id) {
	// 	$support = new SupportModel();
	// 	$map["band_id"] = $id;
	// 	$result = $support->where($map)->count();
	// 	return $result;
	// }

	// 按页用户数量排序演出
	public function getBandByPageNUserNum($startIndex, $pageLength) {
		$support = new SupportModel();
		$result = $support->field("count('user_id') as count, band_id")->group("band_id")->limit($startIndex, $pageLength)->order("count desc")->select();
		return $result;
	}
}