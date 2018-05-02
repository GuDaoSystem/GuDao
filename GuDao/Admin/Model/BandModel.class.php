<?php
namespace Admin\Model;
use Think\Model;
class BandModel extends Model {

    // 按页获取乐队
    public function getBands($startIndex, $pageLength) {
        $band = new BandModel();
        $result = $band->limit($startIndex, $pageLength)->select();
        return $result;
    }

    // 删除乐队
    public function deleteBand($id) {
        $band = new BandModel();
        $map["band_id"] = $id;
        $result = $band->where($map)->delete();
        return $result;
    }

    // 新增乐队
    public function addBand($param) {
        $band = new BandModel();
        $result = $band->add($param);
        return $result;
    }

    // 修改乐队
    public function modifyBand($id, $param) {
        $band = new BandModel();
        $map["band_id"] = $id;
        $result = $band->where($map)->save($param);
        return $result;
    }
}