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
			$(".modify-form .female").addClass("checked");
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

						if(data.gender) {
							data.gender = "女";
						} else {
							data.gender = "男";
						}

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