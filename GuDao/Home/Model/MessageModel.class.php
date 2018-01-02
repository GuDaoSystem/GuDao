<?php
namespace Home\Model;
use Think\Model;
class MessageModel extends Model {
	// 按用户获取消息
	public function getMessageByUser($id) {
		$message = new MessageModel();
		$map["user_id"] = $id;
		$result = $message->where($map)->order("message_time desc")->select();
		return $result;
	}
}