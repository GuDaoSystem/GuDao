new Vue({
	el: '#gudao',
	components: {
		"navbar": navbar,
		"back-to-top": backToTop,
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

	$("#signUp").validate({
		debug: true,
		rules: {
			email: {
				required: true,
				email: true
			},
			// code:{
			// 	required:true,
			// 	digits:true,
			// 	maxlength:4
			// },
			password: {
				required: true
			},
			passwordCheck:{
				equalTo:"[name='password']"
			}
		},
		messages: {
			email: {
				required: "请输入邮箱",
				email: "邮箱格式有误"
			},
			// code:{
			// 	required:"请输入验证码",
			// 	digits:"请输入数字",
			// 	maxlength:"请输入四位数字"
			// },
			password:{
				required: "请输入密码"
			},
			passwordCheck:{
				equalTo:"两次密码输入不一致"
			}
		},
		submitHandler:function(){
			var email = $("[name='email']").val();
			var code = $("[name=code]").val();
			var password = $("[name=password]").val();
			$.ajax({
				url:"doRegister",
				type:"POST",
				dataTpye:"json",
				data:{
					email:email,
					code:code,
					password:password
				},
				success:function(result){
					if (result.code === 200){
						var data = result.data;
						sessionStorage.setItem("userID", data.user_id);
						location.href="home";
					}
					else if (result.code === 201 && result.msg === "登录失败"){
						setAlertBox({
							className: "text",
							close: true,
							title: "孤岛提示",
							message: "登录失败",
							buttons: [{
								value: "确定",
								callback: function() {
									location.href="login"
								}
							}]
						})
					}
					else {
						setAlertBox({
							className: "text",
							close: true,
							title: "孤岛提示",
							message: result.msg,
							buttons: [{
								value: "确定"
							}]
						})
					}
				}
			});
		}
	});
});