<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\BandModel;
class BandController extends Controller {
	// 渲染页面
    public function index(){
    	$this->display();
    }


    // 按页获取乐队
    public function getBands() {
        $startIndex = ($_GET["pageIndex"] - 1) * $_GET["pageSize"];
        $pageLength = $_GET["pageSize"];

        $band = new BandModel();
        $data = $band->getBands($startIndex, $pageLength);

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

    // 删除乐队
    public function deleteBand() {
        $band = new BandModel();

        if($band->deleteBand($_POST["id"])) {
            $result["code"] = 200;
            $result["msg"] = "删除成功";
        } else {
            $result["code"] = 201;
            $result["msg"] = "删除失败";
        }

        $this->ajaxReturn($result);
    }

    // 新增乐队
    public function addBand() {
        $param["band_name"] = $_POST["name"];
        $param["band_intro"] = $_POST["intro"];
        if($_POST["cover"]) {
            $param["band_cover"] = $_POST["cover"];
        }
        $param["band_initial"] = $_POST["initial"];

        $band = new BandModel();

        if($band->addBand($param)) {
            $result["code"] = 200;
            $result["msg"] = "新增成功";
        } else {
            $result["code"] = 201;
            $result["msg"] = "新增失败";
        }

        $this->ajaxReturn($result);
    }

    // 修改乐队
    public function modifyBand() {
        $id = $_POST["id"];
        if($_POST["name"]) {
            $param["band_name"] = $_POST["name"];
        }
        if($_POST["intro"]) {
            $param["band_intro"] = $_POST["intro"];
        }
        if($_POST["cover"]) {
            $param["band_cover"] = $_POST["cover"];
        }
        if($_POST["initial"]) {
            $param["band_initial"] = $_POST["initial"];
        }

        $band = new BandModel();

        if($band->modifyBand($id, $param)) {
            $result["code"] = 200;
            $result["msg"] = "修改成功";
        } else {
            $result["code"] = 201;
            $result["msg"] = "修改失败";
        }

        $this->ajaxReturn($result);
    }
}