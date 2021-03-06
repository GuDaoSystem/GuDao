<?php
namespace Home\Model;
use Think\Model;
class ReplyModel extends Model {
	
	// 按评论获取回复
	public function getReplyByComment($id) {
		$reply = new ReplyModel();
		$map["comment_id"] = $id;
		$result = $reply->where($map)->order("reply_time asc")->select();
		return $result;
	}

	// 回复评论
	public function replyComment($param) {
		$reply = new ReplyModel();
		$result = $reply->add($param);
		return $result;
	}

	// 按目标用户获取回复
	public function getReplyByTarget($id) {
		$reply = new ReplyModel();
		$map["target_id"] = $id;
		$result = $reply->where($map)->order("reply_time desc")->select();
		return $result;
	}

	// 检查用户是否有未读消息
	public function hasUnreadMessage($id) {
		$reply = new ReplyModel();
		$map["target_id"] = $id;
		$map["isRead"] = 0;
		$result = $reply->where($map)->select();
		return $result;
	}

	// 已读消息
	public function readMessage($id) {
		$reply = new ReplyModel();
		$map["reply_id"] = $id;
		$date["isRead"] = 1;
		$result = $reply->where($map)->save($date);
		return $result;
	}
}