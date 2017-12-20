<?php
namespace Home\Model;
use Think\Model;
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
}