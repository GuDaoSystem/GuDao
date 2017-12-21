<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\BandModel;
use Home\Model\AttendModel;
use Home\Model\ShowModel;
use Home\Model\PictureModel;
class BandController extends Controller {
	// 渲染页面
    public function index(){
    	$this->display();
    }
    public function detail(){
    	$this->display();
    }


    // 按页获取所有乐队
    public function getBandByPage() {
    	$startIndex = ($_GET["pageIndex"] - 1) * $_GET["pageSize"];
    	$pageLength = $_GET["pageSize"];
    	$sortRule = $_GET["sortRule"];
    	$band = new BandModel();
    	$data = $band->getBandByPage($startIndex, $pageLength, $sortRule);
    	if($data) {
    		$result["code"] = 200;
    		$result["msg"] = "查询成功";
    	} else {
    		$result["code"] = 201;
    		$result["msg"] = "查询失败";
    	}
        $result["data"] = $data;
    	$this->ajaxReturn($result);
    }

    // 按ID获取指定乐队
    public function getBandByID() {
    	$band = new BandModel();
    	$data = $band->getBandByID($_GET["id"]);
    	if($data) {
    		$result["code"] = 200;
    		$result["msg"] = "查询成功";
    	} else {
    		$result["code"] = 201;
    		$result["msg"] = "查询失败";
    	}
        $result["data"] = $data;
    	$this->ajaxReturn($result);
    }

    // 获取乐队演出经历
    public function getExperience() {
        $attend = new AttendModel();
        $showList = $attend->getExperience($_GET["id"]);
        for($i = 0; $i < count($showList); $i++) {
            $show = new ShowModel();
            $data[$i] = $show->getShowByID($showList[$i]);
        }
        if($data) {
            $result["code"] = 200;
            $result["msg"] = "查询成功";
        } else {
            $result["code"] = 201;
            $result["msg"] = "查询失败";
        }
        $result["data"] = $data;
        $this->ajaxReturn($result);
    }

    // 按乐队获取图片
    public function getPictureByBand() {
        $picture = new PictureModel();
        $data = $picture->getPictureByBand($_GET["id"]);
        if($data) {
            $result["code"] = 200;
            $result["msg"] = "查询成功";
        } else {
            $result["code"] = 201;
            $result["msg"] = "查询失败";
        }
        $result["data"] = $data;
        $this->ajaxReturn($result);
    }
}