<?php
namespace Admin\Model;
use Think\Model;
class BandModel extends Model {

    // 按ID获取乐队
    public function getBand($id) {
        $band = new BandModel();
        $map["band_id"] = $id;
        $result = $band->where($map)->select();
        return $result[0];
    }














    // // 按页获取所有乐队
    // public function getBandByPage($startIndex, $pageLength, $condition) {
    //     $band = new BandModel();
    //     $result = $band->where($condition)->limit($startIndex, $pageLength)->select();
    //     return $result;
    // }

    // // 按ID获取指定乐队
    // public function getBandByID($id) {
    //     $band = new BandModel();
    //     $map["band_id"] = $id;
    //     $result = $band->where($map)->select();
    //     return $result[0];
    // }
    
    // // 获取所有乐队首字母
    // public function getInitial() {
    //     $band = new BandModel();
    //     $result = $band->group('band_initial')->getField('band_initial', true);
    //     return $result;  
    // }

    // // 按乐队名称搜索乐队
    // public function searchBandByName($startIndex, $pageLength, $key) {
    //     $band = new BandModel();
    //     $condition = "%";
    //     for ($i = 0; $i < count($key); $i++) {
    //         $condition = $condition.$key[$i]."%";
    //     }
    //     $map["band_name"] = array("like", $condition);
    //     $result = $band->where($map)->limit($startIndex, $pageLength)->select();
    //     return $result;
    // }
}