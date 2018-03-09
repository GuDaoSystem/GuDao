<?php
namespace Home\Model;
use Think\Model;
class BandModel extends Model {
    // 按页获取所有乐队
    public function getBandByPage($startIndex, $pageLength, $condition) {
        $band = new BandModel();
        $result = $band->where($condition)->limit($startIndex, $pageLength)->select();
        return $result;
    }

    // 按名称获取所有乐队
    public function getBandByName($startIndex, $pageLength){
        $band = new BandModel();
        $result = $band->order("band_name")->limit($startIndex, $pageLength)->select();
        return $result;
    }

    // 按首字母获取乐队
    public function getBandByInitial($startIndex, $pageLength, $initial) {
        $band = new BandModel();
        $map["band_nameInitial"] = $initial;
        $result = $band->where($map)->order("band_name")->limit($startIndex, $pageLength)->select();
        return $result;
    }

    // 按ID获取指定乐队
    public function getBandByID($id) {
        $band = new BandModel();
        $map["band_id"] = $id;
        $result = $band->where($map)->select();
        return $result[0];
    }
    
}