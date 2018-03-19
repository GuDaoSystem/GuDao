new Vue({
	el: '#gudao',
	data: {
		place: [],
		shows: [],
		notices: [],
		newShows: [],
		hotShows: [],
		hotBands: []
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

		// 设置当月演出时间表
		var date = new Date();
		var year = date.getFullYear();
		var month = date.getMonth() + 1;
		this.setCalendar(year, month);

		this.getNotice();
		this.getNewShow();
		this.getHotShow();
		this.getHotBand();
	},
	mounted: function() {
		this.$nextTick(function () {
			var _this = this;

			// 监听演出时间表中的时间选择器
			$(".calendar .selector").click(function(e) {
				var year = $(this).find("span.year").text();
				var month = $(this).find("span.month").text();

				// 上一个月
				if($(e.target).hasClass("left")) {
					if(month == 1) {
						year--;
						month = 12;
					} else {
						month--;
					}
					_this.setCalendar(year, month);
				}
				// 下一个月
				else if($(e.target).hasClass("right")) {
					if(month == 12) {
						year++;
						month = 1;
					} else {
						month++;
					}
					_this.setCalendar(year, month);
				}
				// 手动输入时间
				else if($(e.target).hasClass("year") || $(e.target).hasClass("month")) {
					$(this).hide();

					var form = $(this).parent().find(".form");
					form.show();
					// 表单自动赋值
					form.find(".year").val(year);
					form.find(".month").val(month);
					// 聚焦表单
					if($(e.target).hasClass("year")) {
						form.find(".year").focus();
					} else {
						form.find(".month").focus();
					}
					
					// 监听“完成”按钮&回车键
					form.find("span").unbind("click").click(submitTime);
					form.find("input").unbind("keypress").on("keypress", function(e) {
						if(e.keyCode == 13) {
							submitTime();
						}
					});
					function submitTime() {
						year = form.find(".year").val();
						month = form.find(".month").val();
						// 格式检验
						if(year.length != 4) {
							setAlertBox({
								className: "text",
								close: true,
								title: "孤岛提示",
								message: "请输入四位格式的年份"
							});
						} else if(month < 1 || month > 12) {
							setAlertBox({
								className: "text",
								close: true,
								title: "孤岛提示",
								message: "请输入正确范围内的月份"
							});
						} else {
							form.hide();
							$(".calendar .selector").show();
							_this.setCalendar(year, month);
						}
					}
				} else {
					return;
				}
			});


			$(".hot-show .more").click(function() {
				// console.log(this);
				location.href = "../Show";
			});
		});
	},
	updated: function () {
		this.$nextTick(function () {
			$(".new-notice li").click(function() {
				location.href = "../Show/detail?id=" + $(this).attr("index") + "#detail";
			});

			$(".calendar .day").unbind("click").click(function(e) {
				if($(e.target).parent().hasClass("clickable")) {
					location.href = "../Show?time=" + $(this).parents(".calendar").find(".selector .year").text() + "-" + $(this).parents(".calendar").find(".selector .month").text() + "-" +$(e.target).parent().find(".num").text();
				}
			});

			$(".new-show .show-list, .hot-show .show-list").unbind("click").click(function() {
				location.href = "../Show/detail?id=" + $(this).attr("index") + "#detail";
			});

			$(".hot-band .band-list").unbind("click").click(function() {
				location.href = "../Band/detail?id=" + $(this).attr("index") + "#detail";
			});
		});
	},
	computed: {
	},
	methods: {
		// 设置演出时间表
		setCalendar: function(year, month) {
			// 当月的天数
			var days = new Date(year, month, 0).getDate();
			// 上一个月的天数
			var lastMonth = new Date(year, month - 1, 0).getDate();

			// 设置日期列表HTML
			var dayList = "";
			var arr = [];
			// 上一个月
			for(var i = 0; i < new Date(year, month - 1, 1).getDay(); i++) {
				arr.push(lastMonth--);
			}
			arr.reverse();
			for(var i = 0; i < arr.length; i++) {
				dayList += "<div class='invalid'>" + arr[i] + "</div>";
			}
			// 当前月
			for(var i = 1; i <= days; i++) {
				dayList += "<div><p class='num'>" + i + "</p></div>";
			}
			// 下一个月
			for(var i = 1; i <= 42 - (arr.length + days); i++) {
				dayList += "<div class='invalid'>" + i + "</div>";
			}

			// 渲染日期列表
			$(".calendar .day").html("").append(dayList);

			// 设置今天
			var date = new Date();
			if(year == date.getFullYear() && month == date.getMonth() + 1) {
				$(".calendar .day p:contains(" + date.getDate() +")").parent().addClass("today");
			}

			// 设置月份格式
			if(month.toString().length == 1) {
				month = "0" + month;
			}

			// 设置时间选择器中的时间
			$(".calendar .selector p").html("").append("<span class='year'>" + year + "</span>年<span class='month'>" + month + "</span>月");

			// 获取及设置有演出的日期
			$.ajax({
				url: "getShowCalendar",
				type: "POST",
				dataType: "json",
				data: {
					"month": year + "-" + month,
				},
				success: function(result) {
					// console.log(result);
					if(result.code === 200) {
						var data = result.data;
						for(var i = 0; i < data.length; i++) {
							var target = $(".calendar .day p:contains(" + data[i].show_time.toString().split("-")[2].split(" ")[0] +")").parent();
							target.append("<span class='dot-span'></span><p class='count'>" + data[i].count + "场</p>").addClass("clickable");
						}
					}
				}
			});
		},
		getNotice: function() {
			var _this = this;
			$.ajax({
				url: "getNotice",
				dataType: "json",
				success: function(result) {
					// console.log(result);
					_this.notices = result.data;
				}
			});
		},
		getNewShow: function() {
			var _this = this;
			$.ajax({
				url: "getRecentShow",
				dataType: "json",
				success: function(result) {
					// console.log(result);
					_this.newShows = result.data;
				}
			});
		},
		getHotShow: function() {
			var _this = this;
			$.ajax({
				url: "getHotShow",
				dataType: "json",
				success: function(result) {
					// console.log(result);
					_this.hotShows = result.data;
				}
			});
		},
		getHotBand: function() {
			var _this = this;
			$.ajax({
				url: "getHotBand",
				dataType: "json",
				success: function(result) {
					// console.log(result);
					_this.hotBands = result.data;
				}
			});
		}
	}
});