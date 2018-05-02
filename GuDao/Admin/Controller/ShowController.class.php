<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\AttendModel;
use Admin\Model\BandModel;
use Admin\Model\ShowModel;
class ShowController extends Controller {
	// 渲染页面
    public function index(){
    	$this->display();
    }


    // 按页获取演出
    public function getShows() {
        $startIndex = ($_GET["pageIndex"] - 1) * $_GET["pageSize"];
        $pageLength = $_GET["pageSize"];

        $show = new ShowModel();
        $data = $show->getShows($startIndex, $pageLength);
        if(!$data) {
            $result["code"] = 201;
            $result["msg"] = "查询失败";
            $this->ajaxReturn($result);
        }

        for($i = 0; $i < count($data); $i++) {
            if(!$data[$i]) {
                $result["code"] = 201;
                $result["msg"] = "查询失败";
                $this->ajaxReturn($result);
            }

            // 按演出获取参演乐队
            $attend = new AttendModel();
            $bands = $attend->getBands($data[$i]["show_id"]);
            if(!$bands) {
                $result["code"] = 201;
                $result["msg"] = "查询失败";
                $this->ajaxReturn($result);
            }

            for($j = 0; $j < count($bands); $j++) {
                if(!$bands[$j]) {
                    $result["code"] = 201;
                    $result["msg"] = "查询失败";
                    $this->ajaxReturn($result);
                }

                // 获取乐队
                $band = new BandModel();
                $data[$i]["bands"][$j] = $band->getBand($bands[$j]);
                if(!$data[$i]["bands"][$j]) {
                    $result["code"] = 201;
                    $result["msg"] = "查询失败";
                    $this->ajaxReturn($result);
                }
            }
        }

        $result["code"] = 200;
        $result["msg"] = "查询成功";
        $result["data"] = $data;

        $this->ajaxReturn($result);
    }

    // 删除演出
    public function deleteShow() {
        $id = $_POST["id"];
        $param["show_state"] = 5;

        $show = new ShowModel();

        if($show->modifyShow($id, $param)) {
            $result["code"] = 200;
            $result["msg"] = "删除成功";
        } else {
            $result["code"] = 201;
            $result["msg"] = "删除失败";
        }

        $this->ajaxReturn($result);
    }

    // 修改演出
    public function modifyShow() {
        $id = $_POST["id"];
        if($_POST["name"]) {
            $param["show_name"] = $_POST["name"];
        }
        if($_POST["time"]) {
            $param["show_time"] = $_POST["time"];
        }
        if($_POST["place"]) {
            $param["show_place"] = $_POST["place"];
        }
        if($_POST["address"]) {
            $param["show_address"] = $_POST["address"];
        }
        if($_POST["message"]) {
            $param["show_message"] = $_POST["message"];
        }
        if($_POST["ticket"]) {
            $param["show_ticket"] = $_POST["ticket"];
        }
        if($_POST["poster"]) {
            $param["show_poster"] = $_POST["poster"];
        }
        if($_POST["state"]) {
            $param["show_state"] = $_POST["state"];
        }

        $show = new ShowModel();

        if($show->modifyShow($id, $param)) {
            $result["code"] = 200;
            $result["msg"] = "修改成功";
        } else {
            $result["code"] = 201;
            $result["msg"] = "修改失败";
        }

        $this->ajaxReturn($result);
    }

    // 新增演出
    public function addShow() {
        $param["show_name"] = $_POST["name"];
        $param["show_time"] = $_POST["time"];
        $param["show_place"] = $_POST["place"];
        $param["show_address"] = $_POST["address"];
        if($_POST["message"]) {
            $param["show_message"] = $_POST["message"];
        }
        if($_POST["ticket"]) {
            $param["show_ticket"] = $_POST["ticket"];
        }
        if($_POST["poster"]) {
            $param["show_poster"] = $_POST["poster"];
        }
        if($_POST["state"]) {
            $param["show_state"] = $_POST["state"];
        }
        $bands = $_POST["bands"];

        $show = new ShowModel();
        $id = $show->addShow($param);
        if(!$id) {
            $result["code"] = 201;
            $result["msg"] = "新增失败";
        }

        $attend = new AttendModel();
        for($i = 0; $i < count($bands); $i++) {
            $data = $attend->addAttend($id, $bands[$i]);
            if(!$data) {
                $result["code"] = 201;
                $result["msg"] = "新增失败";
            }
        }

        $result["code"] = 200;
        $result["msg"] = "新增成功";

        $this->ajaxReturn($result);
    }

    // 新增参演乐队
    public function addBandToShow() {
        $attend = new AttendModel();

        if($attend->addAttend($_POST["show_id"], $_POST["band_id"])) {
            $result["code"] = 200;
            $result["msg"] = "新增成功";
        } else {
            $result["code"] = 201;
            $result["msg"] = "新增失败";
        }

        $this->ajaxReturn($result);
    }

    // 删除参演乐队
    public function deleteBandFromShow() {
        $attend = new AttendModel();

        if($attend->deleteAttend($_POST["show_id"], $_POST["band_id"])) {
            $result["code"] = 200;
            $result["msg"] = "删除成功";
        } else {
            $result["code"] = 201;
            $result["msg"] = "删除失败";
        }
        
        $this->ajaxReturn($result);
    }
}