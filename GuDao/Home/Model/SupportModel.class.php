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
	public function getUserNumByBand($id) {
		$support = new SupportModel();
		$map["band_id"] = $id;
		$result = $support->where($map)->count();
		return $result;
	}

	// 按用户数量排序乐队
	public function sortBandByUserNum($startIndex, $pageLength) {
		$support = new SupportModel();
		$result = $support->field("count('user_id') as count, band_id")->group("band_id")->order("count desc")->limit($startIndex, $pageLength)->select();
		return $result;
	}

	// 检查支持记录
	public function checkSupport($data) {
		$support = new SupportModel();
		$result = $support->where($data)->select();
		return $result;
	}

	// 新增支持记录
	public function addSupport($data) {
		$support = new SupportModel();
		$result = $support->add($data);
		return $result;
	}

	// 删除支持记录
	public function deleteSupport($data) {
		$support = new SupportModel();
		$result = $support->where($data)->delete();
		return $result;
	}
}