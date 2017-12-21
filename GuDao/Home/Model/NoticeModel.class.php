<?php
namespace Home\Model;
use Think\Model;
class NoticeModel extends Model {
    // 按页获取所有通知
    public function getNoticeByPage($startIndex, $pageLength) {
    	$notice = new NoticeModel();
    	$result = $notice->limit($startIndex, $pageLength)->order("notice_time desc")->select();
    	return $result;
    }

    // 按类型获取通知
    public function getNoticeByType($type) {
        $notice = new NoticeModel();
        $map["notice_type"] = $type;
        $result = $notice->where($map)->select();
        return $result;
    }

    // 按演出获取通知
    public function getNoticeByShow($id) {
        $notice = new NoticeModel();
        $map["show_id"] = $id;
        $result = $notice->where($map)->select();
        return $result;
    }
}