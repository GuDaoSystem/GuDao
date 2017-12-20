<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\ShowModel;
class ShowController extends Controller {
	// 渲染页面
    public function index(){
    	$this->display();
    }
    public function detail(){
    	$this->display();
    }

    // 按页获取所有演出
    public function getShowByPage() {
    	$startIndex = ($_GET["pageIndex"] - 1) * $_GET["pageSize"];
    	$pageLength = $_GET["pageSize"];
    	$sortRule = $_GET["sortRule"];
    	$show = new ShowModel();
    	$data = $show->getShowByPage($startIndex, $pageLength, $sortRule);
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

    // 按ID获取指定演出
    public function getShowByID() {
    	$show = new ShowModel();
    	$data = $show->getShowByID($_GET["id"]);
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

    // 获取演出参演乐队
    public function getBandByShow() {
        $show = new ShowModel();
        $data = $show->getBandByShow($_GET["id"]);
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