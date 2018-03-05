new Vue({
	el: '#gudao',
	components: {
		"navbar": navbar,
		"copyright": copyright
	}
});

$(function() {
	getCode({
		form: {
			targetType: "email",
			inputName: "email"
		},
		ajax: {
			url: "sendCode",
			successCode: 200
		},
		alertBox: {
			className: "text",
			close: true,
			title: "孤岛提示"
		}
	});


	var email = "";
	var password = "";

	$(".step1 form").validate({
		debug: true,
		rules: {
			email: {
				required: true,
				email: true
			}
		},
		messages: {
			email: {
				required: "邮箱地址为空",
				email: "邮箱地址格式错误"
			}
		},
		submitHandler: function(form){
			email = $("input[name='email']").val();
			var code = $("input[name='code']").val();
			if(code == "") {
				setAlertBox({
					className: "text",
					close: true,
					title: "孤岛提示",
					message: "请输入验证码"
				});
			} else {
				$.ajax({
					url: "checkCode",
					type: "POST",
					dataType: "json",
					data: {
						"email": email,
						"code": code
					},
					success: function(result) {
						if(result.code === 200) {
							$(".tab li").removeClass("active");
							$(".tab li:eq(1)").addClass("active");
							$(".tab .underline").removeClass("tab1").addClass("tab2");
							$(".step1").hide();
							$(".step2").show();
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
        }  
	});

	$(".step2 form").validate({
		debug: true,
		rules: {
			password: {
				required: true
			},
			confirmPassword: {
				required: true,
				equalTo: "[name='password']"
			}
		},
		messages: {
			password: {
				required: "请输入密码"
			},
			confirmPassword: {
				required: "请再次输入密码",
				equalTo: "两次密码不一致"
			}
		},
		submitHandler: function(form){
			password = md5($("input[name='password']").val());
			$.ajax({
				url: "resetPassword",
				type: "POST",
				dataType: "json",
				data: {
					"email": email,
					"password": password
				},
				success: function(result) {
					if(result.code === 200) {
						$(".tab li").removeClass("active");
						$(".tab li:eq(2)").addClass("active");
						$(".tab .underline").removeClass("tab2").addClass("tab3");
						$(".step2").hide();
						$(".step3").show();

						$.ajax({
							url: "../Index/doLogin",
							type: "POST",
							dataType: "json",
							data: {
								"email": email,
								"password": password
							},
							success: function(result) {
								if(result.code === 200) {
									var data = result.data;
									sessionStorage.setItem("userID", data.user_id);
								} else {
									setAlertBox({
										className: "text",
										close: true,
										title: "孤岛提示",
										message: result.msg,
										buttons: [{
											value: "去登录",
											callback: function() {
												location.href = "../Index/login";
											}
										}, {
											value: "取消"
										}]
									});
								}
							}
						});

						var countdown = 3;
						$(".step3 .countdown").text(countdown);
						clearInterval(timer);
						var timer = setInterval(function() {
							countdown --;
							if(countdown == 0) {
								clearInterval(timer);
								location.href = "../Index/home";
							} else {
								$(".step3 .countdown").text(countdown);
							}
						}, 1000);
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
});