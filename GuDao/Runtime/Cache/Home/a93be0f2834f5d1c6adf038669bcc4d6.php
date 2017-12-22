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
		url: "/GuDao/index.php/Home/Band/getExperience",
		type: "GET",
		// type: "POST",
		dataType: "json",
		data: {
			"id": 1
			// "user_id": 4,
			// "band_id": 4,
			// "time": "2017-12-22"
		},
		success: function(result) {
			console.log(result);
		}
	});
</script>
</body>
</html>