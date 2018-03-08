<?php
namespace Home\Model;
use Think\Model;
class CommentModel extends Model {
	// 按目标获取评论
	public function getCommentByTarget($data) {
		$comment = new CommentModel();
		$result = $comment->where($data)->order("comment_time desc")->select();
		return $result;
	}

	// 按用户获取评论
	public function getCommentByUser($id) {
		$comment = new CommentModel();
		$map["user_id"] = $id;
		$result = $comment->where($map)->order("comment_time desc")->select();
		return $result;
	}

	// 发送评论
	public function sendComment($param) {
		$comment = new CommentModel();
		$result = $comment->add($param);
		return $result;
	}
}