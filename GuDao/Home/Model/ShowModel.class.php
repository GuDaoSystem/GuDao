<?php
namespace Home\Model;
use Think\Model;
class ShowModel extends Model {
    // 按时间按页获取所有演出信息
    public function getShowByPage($startIndex, $length, $sortRule) {
    	$show = new ShowModel();
    	$result = $show->limit($startIndex, $length)->order($sortRule)->select();
    	return $result;
    }
}