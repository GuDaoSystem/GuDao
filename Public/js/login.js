$(function() {
	$("#login").validate({
		debug: true,
		rules: {
			email: {
				required: true,
				email: true
			},
			password: {
				required: true
			}
		},
		messages: {
			email: {
				required: "请输入邮箱",
				email: "邮箱格式有误"
			},
			password: {
				required: "请输入密码"
			}
		},
		submitHandler: function(form){
			var email = $("input[name='email']").val();
			var password = md5($("input[name='password']").val());
			var autoLogin = false;
			if($(".checkbox .checked").css("display") == "inline-block") {
				autoLogin = true;
			}
            $.ajax({
				url: "doLogin",
				type: "POST",
				dataType: "json",
				data: {
					"email": email,
					"password": password,
					"autoLogin": autoLogin
				},
				success: function(result) {
					if(result.code === 200) {
						var data = result.data;
						sessionStorage.setItem("userID", data.user_id);
						location.href = "home";
					} else {
						setAlertBox({
							className: "text",
							close: true,
							title: "孤岛提示",
							message: result.msg
						});
					}
				}
			});
        }  
	});

	$(".checkbox").click(function() {
		if($(".uncheck").css("display") == "inline-block") {
			$(".uncheck").hide();
			$(".checked").css("display", "inline-block");
		} else {
			$(".checked").hide();
			$(".uncheck").css("display", "inline-block");
		}
	});
});