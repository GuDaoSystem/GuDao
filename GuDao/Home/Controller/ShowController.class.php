<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\ShowModel;
class ShowController extends Controller {
    public function index(){
    	$this->display();
    }

    public function getShowByPage() {
    	$show = new ShowModel();
    	$result = $show->getShowByPage(1, 1);
    	$this->ajaxReturn($result);
    }
}