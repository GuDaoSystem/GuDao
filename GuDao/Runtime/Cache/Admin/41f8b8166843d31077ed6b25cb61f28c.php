<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title></title>
<link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/bootstrap.css">
<!-- <link rel="stylesheet" type="text/css" href="/GuDao/Public/css/common/common.css"> -->
<script src="/GuDao/Public/js/common/jquery-3.2.1.js" type="text/javascript" charset="utf-8"></script>
<style type="text/css">
h1 {
  text-align: center;
}
</style>
</head>
<body>
<div class="container">
  <div class="add-show">
    <h1>添加乐队</h1>
    <form class="form-horizontal">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">演出名称</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputEmail3" placeholder="">
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">演出时间</label>
        <div class="col-sm-10">
          <input type="datetime-local" class="form-control" id="inputEmail3" placeholder="">
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">演出地点</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputEmail3" placeholder="">
          </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">演出具体地点</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputEmail3" placeholder="">
          </div>
      </div>
      <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">演出乐队</label>
          <div class="col-sm-10">
            <label class="checkbox-inline">
              <input type="checkbox" id="inlineCheckbox1" value="option1"> 1
          </label>
          <label class="checkbox-inline">
            <input type="checkbox" id="inlineCheckbox2" value="option2"> 2
          </label>
          <label class="checkbox-inline">
            <input type="checkbox" id="inlineCheckbox3" value="option3"> 3
          </label>
          </div>
      </div>
      <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">演出信息</label>
          <div class="col-sm-10">
            <textarea class="form-control" rows="3"></textarea>
          </div>
      </div>
      <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">演出门票</label>
          <div class="col-sm-10">
              <input type="number" class="form-control" id="inputEmail3" placeholder="">
          </div>
      </div>
      <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">演出海报</label>
          <div class="col-sm-10">
              <input type="file" class="form-control" id="inputEmail3" placeholder="">
          </div>
      </div>
      <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">演出状态</label>
          <div class="col-sm-10">
              <select class="form-control">
              <option>预售</option>
              <option>取消</option>
              <option>变更</option>
          </select>
          </div>
      </div>
      <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">提交</button>
          </div>
      </div>
    </form>
  </div>
</div>

<script>
  // localStorage.removeItem("test");
  // console.log(localStorage.getItem("test"));
</script>
</body>
</html>