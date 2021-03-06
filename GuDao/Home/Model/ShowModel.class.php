<?php
namespace Home\Model;
use Think\Model;
class ShowModel extends Model {
    
    // 按页获取所有演出
    public function getShowByPage($startIndex, $pageLength) {
    	$show = new ShowModel();
        $result = $show->order("show_time desc")->limit($startIndex, $pageLength)->select();
    	return $result;
    }

    // 按ID获取指定演出
    public function getShowByID($id) {
        $show = new ShowModel();
        $map["show_id"] = $id;
        $result = $show->where($map)->select();
        return $result[0];
    }

    // 按条件获取演出
    public function getShowByCondition($startIndex, $pageLength, $condition) {
        $show = new ShowModel();
        $result = $show->where($condition)->order("show_time desc")->limit($startIndex, $pageLength)->select();
        return $result;
    }

    // 按演出数量获取日期
    public function getDateByShowNum($month) {
        $show = new ShowModel();
        $map["show_time"] = array("like", $month."%");
        $result = $show->where($map)->field("count('show_id') as count, show_time")->group("show_time")->select();
        return $result;
    }

    // 获取所有演出地点
    public function getShowPlace() {
        $show = new ShowModel();
        $result = $show->group('show_place')->getField('show_place', true);
        return $result;
    }

    // 按演出名称搜索演出
    public function searchShowByName($startIndex, $pageLength, $key) {
        $show = new ShowModel();
        $condition = "%";
        for ($i = 0; $i < count($key); $i++) {
            $condition = $condition.$key[$i]."%";
        }
        $map["show_name"] = array("like", $condition);
        $result = $show->where($map)->limit($startIndex, $pageLength)->select();
        return $result;
    }
}