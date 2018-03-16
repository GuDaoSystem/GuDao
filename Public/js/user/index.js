new Vue({
	el: '#gudao',
	data: {
		info: {},
		want: 0,
		support: 0,
		activity: [],
		reply: [],
		show: [],
		band: []
	},
	components: {
		"navbar": navbar,
		"back-to-top": backToTop,
		"copyright": copyright
	},
	created: function() {
		// 加载动画
		$(document).ajaxStart(function() {
			setLoading();
		}).ajaxStop(function() {
			removeLoading();
		});

		// 获取数据
		this.getUserInfo();
		this.getActivity();
		this.getReply();
	},
	mounted: function() {
		this.$nextTick(function () {
			// 事件选择器
			$('#datetimepicker').datetimepicker({
				format: "yyyy-mm-dd",
				autoclose: true,
				minView: "month"
			});

			// 标签页定位
			var tabList = ["#activity", "#message", "#show", "#band"];
			var tabIndex = tabList.indexOf(location.hash);
			$(".tablist li:eq(" + tabIndex +")").addClass("active");
			$(".tablist .underline").addClass("tab" + (tabIndex + 1));
			$(tabList[tabIndex]).addClass("in").addClass("active");

			// 标签页切换
			$(".tablist a").unbind("click").click(function () {
				location.href = location.toString().split("#")[0] + $(this).attr("href");
				$(".tablist .underline")[0].className = "underline";
				$(".tablist .underline").addClass($(this).parent()[0].className);
			});
		});
	},
	updated: function () {
		this.$nextTick(function () {
			var _this = this;

			// 设置性别单选框默认选项
			if(this.info.gender == 'M') {
				$(".modify-form .female").removeClass("checked");
				$(".modify-form .male").addClass("checked");
			} else {
				$(".modify-form .male").removeClass("checked");
				$(".modify-form .female").addClass("checked");
			}
			// 监听性别单选框
			$(".modify-form .radio").click(function() {
				$(".modify-form .radio").removeClass("checked");
				$(this).addClass("checked");
			});

			// textarea高度自适应 & 动态显示textarea内容字数
			var textareaPadding = 12 * 0.5 * 2;
			$("textarea").next().find("span").text($("textarea").val().length);
			$("textarea").on("input", function () {
				if((this.scrollHeight - textareaPadding) > $(this).height()) {
					$(this).height(this.scrollHeight - textareaPadding);
				}
				$(this).next().find("span").text(this.value.length);
			});

			// 监听“修改基本信息”按钮
			$(".info .modify-info").click(function() {
				$(".info").hide();
				$(".modify-form").css("display", "inline-block");
			});

			// 监听修改基本信息中“确认”按钮
			$(".modify-form .confirm").unbind("click").click(function() {
				// 获取字段信息
				var name = $(".modify-form .name").val();
				if($(".modify-form .radio-box .male").hasClass("checked")) {
					var gender = 'M';
				} else {
					var gender = 'F';
				}
				var birthday = $(".modify-form .birthday input").val();
				var intro = $(".modify-form .intro textarea").val();

				$.ajax({
					url: "modifyUserInfo",
					type: "POST",
					dataType: "json",
					data: {
						"id": sessionStorage.getItem("userID"),
						"username": name,
						"gender": gender,
						"birthday": birthday,
						"intro": intro,
					},
					success: function(result) {
						console.log(result);
						if(result.code === 200) {
							_this.getUserInfo();
							$(".modify-form").hide();
							$(".info").show();
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
			});
			// 监听修改基本信息中“取消”按钮
			$(".modify-form .cancel").click(function() {
				$(".modify-form").hide();
				$(".info").show();
			});
		});
	},
	computed: {
	},
	methods: {
		// 获取用户信息
		getUserInfo: function() {
			_this = this;
			$.ajax({
				url: "getUserBasicInfo",
				type: "GET",
				dataType: "json",
				data: {
					"id": sessionStorage.getItem("userID")
				},
				success: function(result) {
					// console.log(result);
					if(result.code === 200) {
						var data = result.data;
						data.age = new Date().getFullYear() - data.birthday.split("-")[0];
						_this.info = result.data;
					}
				}
			});
		},
		// 获取用户动态
		getActivity: function() {
			_this = this;
			$.ajax({
				url: "getUserActivity",
				type: "GET",
				dataType: "json",
				data: {
					"id": sessionStorage.getItem("userID")
				},
				success: function(result) {
					// console.log(result);
					if(result.code === 200) {
						var data = result.data;
						_this.want = data.want;
						_this.support = data.support;
						_this.activity = data.activity;
						for(var i = 0; i < data.activity.length; i++) {
							if(data.activity[i]["type"] == "show") {
								_this.show.push(data.activity[i]["show"]);
							} else {
								_this.band.push(data.activity[i]["band"]);
							}
						}
					}
				}
			});
		},
		// 获取用户收到的回复
		getReply: function() {
			_this = this;
			$.ajax({
				url: "getReplyByUser",
				type: "GET",
				dataType: "json",
				data: {
					"id": sessionStorage.getItem("userID")
				},
				success: function(result) {
					// console.log(result);
					_this.reply = result.data;
				}
			});
		}
	}
});