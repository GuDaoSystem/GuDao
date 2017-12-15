<?php
namespace Home\Model;
use Think\Model;
class BandModel extends Model {
    public function getAllBands() {
    	$bands = new BandModel();
        return $bands->select()[0];
    }
}