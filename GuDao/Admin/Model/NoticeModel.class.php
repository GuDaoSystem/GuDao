<?php
namespace Admin\Model;
use Think\Model;
class NoticeModel extends Model {

    // 按页获取通知
    public function getNotices($startIndex, $pageLength) {
        $notice = new NoticeModel();
        $result = $notice->order("notice_time desc")->limit($startIndex, $pageLength)->select();
        return $result;
    }

    // 新增通知
    public function addNotice($param) {
        $notice = new NoticeModel();
        $result = $notice->add($param);
        return $result;
    }

    // 删除通知
    public function deleteNotice($id) {
        $notice = new NoticeModel();
        $map["notice_id"] = $id;
        $result = $notice->where($map)->delete();
        return $result;
    }

    // 修改通知
    public function modifyNotice($id, $param) {
        $notice = new NoticeModel();
        $map["notice_id"] = $id;
        $result = $notice->where($map)->save($param);
        return $result;
    }
}