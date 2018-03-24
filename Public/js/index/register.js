new Vue({
	el: '#gudao',
	components: {
		"navbar": navbar,
		"back-to-top": backToTop,
		"copyright": copyright
	}
});

$(function() {
	// var obj = {
	// 		form: {							// 必选，对象，获取验证码的表单设置
	// 			targetType: "email",				// 可选，字符串，目标类型，取值为"phone"或"email"，默认为"phone"
	// 			inputName: "email",				// 可选，字符串，填写手机号码或邮箱地址的input标签的name属性值，默认为"phone"
	// 			// getCodeClass: "getCode",			// 可选，字符串，获取验证码按钮的button标签的class，默认为"getCode"
	// 			// countdown: 60,				// 可选，数值，重新获取验证码的等待时间，默认为60
	// 			// countdownText: ""			// 可选，字符串，等待重新获取验证码时按钮的文本内容，默认为"重新发送"
	// 		},
	// 		ajax: {							// 必选，对象，获取验证码的ajax设置
	// 			url: "sendCode",					// 必选，字符串，获取验证码的请求地址
	// 			// type: "",					// 可选，字符串，请求方式，默认为"POST"
	// 			// dataType: "",				// 可选，字符串，返回的数据类型，默认为"json"
	// 			// dataName: "",				// 可选，字符串，发送给服务器的数据对象中名值对的名，默认为填写手机号码或邮箱地址的input标签的name属性值
	// 			// resultCodeName: "",			// 可选，字符串，返回数据的状态码名称，默认为"code"
	// 			// resultMsgName: "",			// 可选，字符串，返回数据的消息名称，默认为"msg"
	// 			successCode: "200"				// 可选，字符串或数值，返回数据的成功状态码，使用严格比较运算符进行比较，默认为1
	// 		},
	// 		alertBox: {						// 可选，对象，弹窗显示获取验证码的结果，不弹窗显示时可访问全局变量getCodeMsg以获取ajax返回信息
	// 			className: "text",				// 可选，字符串，弹窗额外的类名
	// 			close: true,				// 可选，布尔值，是否有关闭按钮，默认为false
	// 			title: "孤岛提示",					// 可选，字符串，标题文本，默认无标题
	// 			// buttons: [{					// 可选，数组，默认为一个“确定”按钮
	// 			// 	value: "",				// 必选，字符串，按钮文本
	// 			// 	callback: function() {}	// 可选，函数，点击按钮的回调函数，默认操作为关闭弹窗
	// 			// }]
	// 		}
	// 	}
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