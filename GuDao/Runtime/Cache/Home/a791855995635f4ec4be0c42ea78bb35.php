<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title></title>
<script src="/GuDao/Public/js/common/jquery-3.2.1.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
<script>
	$.ajax({
		url: "/GuDao/index.php/Home/Show/getShowByPage",
		type: "POST",
		dataType: "json",
		data: {
			"pageIndex": 1,
			"pageSize": 5
		},
		success: function(result) {
			console.log(result);
		}
	});
</script>
</body>
</html>