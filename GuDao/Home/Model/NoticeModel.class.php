<?php
namespace Home\Model;
use Think\Model;
class NoticeModel extends Model {
    // 按页获取通知
    // public function getNoticeByPage($startIndex, $pageLength) {
    //     $notice = new NoticeModel();
    //     $result = $notice->order("notice_time desc")->limit($startIndex, $pageLength)->select();
    //     return $result;
    // }
    public function getNoticeByPage($startIndex, $pageLength, $condition) {
        $notice = new NoticeModel();
        $result = $notice->where($condition)->order("notice_time desc")->limit($startIndex, $pageLength)->select();
        return $result;
    }

    // 按类型获取通知
    public function getNoticeByType($startIndex, $pageLength, $type) {
        $notice = new NoticeModel();
        $map["notice_type"] = $type;
        $result = $notice->where($map)->order("notice_time desc")->limit($startIndex, $pageLength)->select();
        return $result;
    }

    // 按演出获取通知
    // public function getNoticeByShow($id) {
    //     $notice = new NoticeModel();
    //     $map["show_id"] = $id;
    //     $result = $notice->where($map)->select();
    //     return $result;
    // }

    // 按通知内容搜索通知
    public function searchNoticeByContent($startIndex, $pageLength, $key) {
        $notice = new NoticeModel();
        $condition = "%";
        for ($i = 0; $i < count($key); $i++) {
            $condition = $condition.$key[$i]."%";
        }
        $map["notice_content"] = array("like", $condition);
        $result = $notice->where($map)->limit($startIndex, $pageLength)->select();
        return $result;
    }
}