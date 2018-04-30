<?php
namespace Admin\Model;
use Think\Model;
class AttendModel extends Model {

    // 按演出获取乐队
    public function getBands($id) {
        $attend = new AttendModel();
        $map["show_id"] = $id;
        $result = $attend->where($map)->getField('band_id', true);
        return $result;
    }

    // 新增参演关系
    public function addAttend($show_id, $band_id) {
        $attend = new AttendModel();
        $map["show_id"] = $show_id;
        $map["band_id"] = $band_id;
        $result = $attend->add($map);
        return $result;
    }



    
	// 按演出获取乐队
    // public function getBandIDByShow($id) {
    //     $attend = new AttendModel();
    //     $map["show_id"] = $id;
    //     $result = $attend->where($map)->getField('band_id', true);
    //     return $result;
    // }

	// // 按乐队获取演出
 //    public function getShowByBand($id) {
 //        $attend = new AttendModel();
 //        $map["band_id"] = $id;
 //        $result = $attend->where($map)->getField('show_id', true);
 //        return $result;
 //    }
}