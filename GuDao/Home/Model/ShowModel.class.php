<?php
namespace Home\Model;
use Think\Model;
use Home\Model\AttendModel;
use Home\Model\BandModel;
class ShowModel extends Model {
    // 按页获取所有演出
    public function getShowByPage($startIndex, $pageLength, $sortRule) {
    	$show = new ShowModel();
    	$result = $show->limit($startIndex, $pageLength)->order($sortRule)->field("show_id, show_name, show_time, show_state")->select();
    	return $result;
    }

    // 按ID获取指定演出
    public function getShowByID($id) {
    	$show = new ShowModel();
        $map["show_id"] = $id;
        $result = $show->where($map)->select();
        return $result[0];
    }

    // 按演出获取乐队
    public function getBandByShow($id) {
        $attend = new AttendModel();
        $map["show_id"] = $id;
        $bandList = $attend->where($map)->getField('band_id', true);
        for($i = 0; $i < count($bandList); $i++) {
            $band = new BandModel();
            $result[$i] = $band->getBandByID($bandList[$i]);
        }
        return $result;
    }
}