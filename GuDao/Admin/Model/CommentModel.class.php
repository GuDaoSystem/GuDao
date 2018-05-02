<?php
namespace Admin\Model;
use Think\Model;
class CommentModel extends Model {

	// 按页获取评论
	public function getComments($startIndex, $pageLength) {
		$comment = new CommentModel();
        $result = $comment->order("comment_time desc")->limit($startIndex, $pageLength)->select();
        return $result;
	}

	// 删除评论
	public function deleteComment($id) {
		$comment = new CommentModel();
		$map["comment_id"] = $id;
		$result = $comment->where($map)->delete();
		return $result;
	}
}