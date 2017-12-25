<?php
namespace Home\Model;
use Think\Model;
class ReplyModel extends Model {
	// 按评论获取回复
	public function getReplyByComment($id) {
		$reply = new ReplyModel();
		$map["comment_id"] = $id;
		$result = $reply->where($map)->order("reply_time desc")->select();
		return $result;
	}
}