<?php
namespace Home\Model;
use Think\Model;
class NoticeModel extends Model {

    // 按页获取通知
    public function getNoticeByPage($startIndex, $pageLength, $condition) {
        $notice = new NoticeModel();
        $result = $notice->where($condition)->order("notice_time desc")->limit($startIndex, $pageLength)->select();
        return $result;
    }

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