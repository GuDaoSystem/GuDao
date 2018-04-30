<?php
namespace Admin\Model;
use Think\Model;
class ShowModel extends Model {

    // 按页获取演出
    public function getShows($startIndex, $pageLength) {
        $show = new ShowModel();
        $map["show_state"] = array("neq", 5);
        $result = $show->where($map)->order("show_time desc")->limit($startIndex, $pageLength)->select();
        return $result;
    }

    // 修改演出
    public function modifyShow($id, $param) {
        $show = new ShowModel();
        $map["show_id"] = $id;
        $result = $show->where($map)->save($param);
        return $result;
    }

    // 新增演出
    public function addShow($param) {
        $show = new ShowModel();
        $result = $show->add($param);
        return $result;
    }
}