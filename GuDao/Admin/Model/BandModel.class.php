<?php
namespace Admin\Model;
use Think\Model;
class BandModel extends Model {
	// 获取所有乐队
	public function getBands() {
		$band = new BandModel();
		$result = $band->select();
		return $result;
	}
}