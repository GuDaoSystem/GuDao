<?php
namespace Admin\Model;
use Think\Model;
class PictureModel extends Model {

	// 按乐队获取图片
	public function getPictures($id, $startIndex, $pageLength) {
		$picture = new PictureModel();
		$map["band_id"] = $id;
        $result = $picture->where($map)->limit($startIndex, $pageLength)->field("picture_id, picture_url")->select();
        return $result;
	}

	// 删除图片
	public function deletePicture($id) {
		$picture = new PictureModel();
		$map["picture_id"] = $id;
		$result = $picture->where($map)->delete();
		return $result;
	}

	// 新增图片
	public function addPicture($id, $url) {
		$picture = new PictureModel();
		$param["band_id"] = $id;
		$param["picture_url"] = $url;
		$result = $picture->add($param);
		return $result;
	}
}