<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\BandModel;
use Admin\Model\ShowModel;
use Admin\Model\AttendModel;
class IndexController extends Controller {
    public function index(){
        $this->display();
    }

    // 获取所有乐队
    public function getBands() {
    	$band = new BandModel();
    	$data = $band->getBands();
    	if($data) {
    		$result["code"] = 200;
            $result["msg"] = "查询成功";
            $result["data"] = $data;
    	} else {
    		$result["code"] = 201;
            $result["msg"] = "查询失败";
    	}
    	$this->ajaxReturn($result);
    }

    // 新增演出
    // public function addShow() {
    // 	$showData["band_name"] = $_POST["name"];
    // 	$showData["band_time"] = $_POST["time"];
    // 	$showData["band_place"] = $_POST["place"];
    // 	$showData["band_address"] = $_POST["address"];
    // 	$showData["band_message"] = $_POST["message"];
    // 	$showData["band_ticket"] = $_POST["ticket"];
    // 	$showData["band_state"] = $_POST["state"];
    // 	$bands = $_POST["bands"];

    // 	$show = new ShowModel();
    // 	if(!$show->addShow($showData)) {
    // 		$result["code"] = 201;
    //         $result["msg"] = "新增演出失败";
    //         $this->ajaxReturn($result);
    // 	}

    // 	$attend = new AttendModel();
    // 	for($i = 0; $i < count($bands); $i++) {
    // 		$attendData[""]
    // 		$data = $attend->addAttend();
    // 	}


    // 	$this->ajaxReturn($result);
    // }
}