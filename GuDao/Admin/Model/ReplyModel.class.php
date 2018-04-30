<?php
namespace Admin\Model;
use Think\Model;
class ReplyModel extends Model {

	// 按页获取回复
	public function getReplys($startIndex, $pageLength) {
		$reply = new ReplyModel();
        $result = $reply->order("reply_time desc")->limit($startIndex, $pageLength)->select();
        return $result;
	}

	// 删除回复
	public function deleteReply($id) {
		$reply = new ReplyModel();
		$map["reply_id"] = $id;
		$result = $reply->where($map)->delete();
		return $result;
	}
}