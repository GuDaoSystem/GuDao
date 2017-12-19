<?php
namespace Home\Model;
use Think\Model;
class BandModel extends Model {
    // 按页获取所有乐队
    public function getBandByPage($startIndex, $pageLength, $sortRule) {
    	$show = new BandModel();
    	$result = $show->limit($startIndex, $pageLength)->order($sortRule)->select();
    	return $result;
    }

    // 按ID获取指定乐队
    public function getBandByID($id) {
        $show = new BandModel();
        $map["band_id"] = $id;
        $result = $show->where($map)->select();
        return $result[0];
    }
}