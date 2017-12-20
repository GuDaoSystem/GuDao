<?php
namespace Home\Model;
use Think\Model;
use Home\Model\AttendModel;
use Home\Model\ShowModel;
class BandModel extends Model {
    // 按页获取所有乐队
    public function getBandByPage($startIndex, $pageLength, $sortRule) {
    	$band = new BandModel();
    	$result = $band->limit($startIndex, $pageLength)->order($sortRule)->select();
    	return $result;
    }

    // 按ID获取指定乐队
    public function getBandByID($id) {
        $band = new BandModel();
        $map["band_id"] = $id;
        $result = $band->where($map)->select();
        return $result[0];
    }

    // 按乐队获取演出
    public function getExperience($id) {
        $attend = new AttendModel();
        $map["band_id"] = $id;
        $showList = $attend->where($map)->getField('show_id', true);
        for($i = 0; $i < count($showList); $i++) {
            $show = new ShowModel();
            $result[$i] = $show->getShowByID($showList[$i]);
        }
        return $result;
    }
}