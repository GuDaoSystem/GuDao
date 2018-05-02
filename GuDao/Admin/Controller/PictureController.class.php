<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\PictureModel;
class PictureController extends Controller {
    public function index(){
        $this->display();
    }


    // 按乐队获取图片
    public function getPictures() {
    	$id = $_GET["id"];
        $startIndex = ($_GET["pageIndex"] - 1) * $_GET["pageSize"];
        $pageLength = $_GET["pageSize"];

        $picture = new PictureModel();
        $data = $picture->getPictures($id, $startIndex, $pageLength);

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

    // 删除图片
    public function deletePicture() {
    	$picture = new PictureModel();

    	if($picture->deletePicture($_POST["id"])) {
    		$result["code"] = 200;
    		$result["msg"] = "删除成功";
    	} else {
    		$result["code"] = 201;
    		$result["msg"] = "删除失败";
    	}
    	
    	$this->ajaxReturn($result);
    }

    // 新增单张图片
    public function addPicture() {
    	$picture = new PictureModel();

    	if($picture->addPicture($_POST["id"], $_POST["url"])) {
    		$result["code"] = 200;
    		$result["msg"] = "新增成功";
    	} else {
    		$result["code"] = 201;
    		$result["msg"] = "新增失败";
    	}
        
    	$this->ajaxReturn($result);
    }

    // 新增多张图片
    public function addPictures() {
    	$id = $_POST["id"];
    	$urls = $_POST["urls"];

    	$picture = new PictureModel();
    	for($i = 0; $i < count($urls); $i++) {
    		if(!$picture->addPicture($id, $urls[$i])) {
				$result["code"] = 201;
    			$result["msg"] = "新增失败";
    			$this->ajaxReturn($result);
    		}
    	}

    	$result["code"] = 200;
    	$result["msg"] = "新增成功";
    	
    	$this->ajaxReturn($result);
    }
}