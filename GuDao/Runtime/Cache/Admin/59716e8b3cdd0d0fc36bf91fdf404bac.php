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
          <input type="text" class="name form-control" id="inputEmail3" placeholder="">
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">演出时间</label>
        <div class="col-sm-10">
          <input type="datetime-local" class="time form-control" id="inputEmail3" placeholder="">
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">演出地点</label>
          <div class="col-sm-10">
            <input type="text" class="place form-control" id="inputEmail3" placeholder="">
          </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">演出具体地点</label>
          <div class="col-sm-10">
            <input type="text" class="address form-control" id="inputEmail3" placeholder="">
          </div>
      </div>
      <div class="bands form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">演出乐队</label>
          <div class="col-sm-10">
            <!-- <label class="checkbox-inline">
              <input type="checkbox" id="inlineCheckbox1" value="option1"> 1
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" id="inlineCheckbox2" value="option2"> 2
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" id="inlineCheckbox3" value="option3"> 3
            </label> -->
          </div>
      </div>
      <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">演出信息</label>
          <div class="col-sm-10">
            <textarea class="message form-control" rows="3"></textarea>
          </div>
      </div>
      <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">演出门票</label>
          <div class="col-sm-10">
              <input type="number" class="ticket form-control" id="inputEmail3" placeholder="">
          </div>
      </div>
      <!-- <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">演出海报</label>
          <div class="col-sm-10">
              <input type="file" class="poster form-control" id="inputEmail3" placeholder="">
          </div>
      </div> -->
      <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">演出状态</label>
          <div class="col-sm-10">
            <select class="state form-control">
              <option index="1">预售</option>
              <option index="2">取消</option>
              <option index="3">变更</option>
            </select>
          </div>
      </div>
      <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default" id="submit">提交</button>
          </div>
      </div>
    </form>
  </div>
</div>

<script>
$(function() {
  $.ajax({
    url: "Admin/Index/getBands",
    dataType: "json",
    success: function(result) {
      if(result.code === 200) {
        var data = result.data;
        var html = "";
        for(var i = 0; i < data.length; i++) {
          html += "<label class='checkbox-inline'><input type='checkbox' value='" + data[i].band_id +"'>" + data[i].band_id + data[i].band_name + "</label>";
        }
        $(".bands>div").append(html);
      }
    }
  });

  // $("#submit").click(function(e) {
  //   e.preventDefault();
  //   var name = $(".name").val();
  //   var time = $(".time").val();
  //   var place = $(".place").val();
  //   var address = $(".address").val();
  //   var bands = $(".bands input:checkbox:checked");
  //   var bandsIndex = [];
  //   for(var i = 0; i < bands.length; i++) {
  //     bandsIndex[i] = $(bands[i]).val();
  //   }
  //   var message = $(".message").val();
  //   var ticket = $(".ticket").val();
  //   var state = $(".state option:selected").attr("index");

  //   url: "Admin/Index/addShow",
  //   type: "POST",
  //   dataType: "json",
  //   data: {
  //     "name": name,
  //     "time": time,
  //     "place": place,
  //     "address": address,
  //     "message": message,
  //     "ticket": ticket,
  //     "state": state,
  //     "bands": bandsIndex
  //   },
  //   success: function(result) {
  //     if(result.code === 200) {
  //     }
  //   }
  // });
});
</script>
</body>
</html>