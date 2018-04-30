<?php
namespace Admin\Model;
use Think\Model;
class PictureModel extends Model {
	
    // 按乐队获取图片
    public function getPictureByBand($id) {
        $picture = new PictureModel();
        $map["band_id"] = $id;
        $result = $picture->where($map)->getField("picture_url", true);
        return $result;
    }
}