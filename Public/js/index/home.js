new Vue({
	el: '#gudao',
	data: {
		place: [],
		shows: []
	},
	components: {
		"navbar": navbar,
		"back-to-top": backToTop,
		"copyright": copyright
	},
	created: function() {
		$(document).ajaxStart(function() {
			setLoading();
		}).ajaxStop(function() {
			removeLoading();
		});


		var date = new Date();
		var year = date.getFullYear();
		var month = date.getMonth() + 1;
		this.setCalendar(year, month);

			
	},
	mounted: function() {
		this.$nextTick(function () {
			var _this = this;
			$(".calendar .selector").click(function(e) {
				var year = $(this).find("span.year").text();
				var month = $(this).find("span.month").text();

				if($(e.target).hasClass("left")) {
					if(month == 1) {
						year--;
						month = 12;
					} else {
						month--;
					}
					_this.setCalendar(year, month);
				} else if($(e.target).hasClass("right")) {
					if(month == 12) {
						year++;
						month = 1;
					} else {
						month++;
					}
					_this.setCalendar(year, month);
				} else if($(e.target).hasClass("year") || $(e.target).hasClass("month")) {
					$(this).hide();
					var form = $(this).parent().find(".form");
					form.css("display", "inline-block");
					form.find(".year").val(year);
					form.find(".month").val(month);
					if($(e.target).hasClass("year")) {
						form.find(".year").focus();
					} else {
						form.find(".month").focus();
					}
					form.find("span").unbind("click").click(function() {
						year = form.find(".year").val();
						month = form.find(".month").val();
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
					});
				} else {
					return;
				}
			});
		});
	},
	updated: function () {
		this.$nextTick(function () {
			
		});
	},
	computed: {
	},
	methods: {
		setCalendar: function(year, month) {
			var days = new Date(year, month, 0).getDate();
			var lastMonth = new Date(year, month - 1, 0).getDate();
			var dayList = "";
			var arr = [];
			for(var i = 0; i < new Date(year, month - 1, 1).getDay(); i++) {
				arr.push(lastMonth--);
			}
			arr.reverse();
			for(var i = 0; i < arr.length; i++) {
				dayList += "<div class='invalid'>" + arr[i] + "</div>";
			}
			for(var i = 1; i <= days; i++) {
				dayList += "<div><p class='num'>" + i + "</p></div>";
			}
			for(var i = 1; i <= 42 - (arr.length + days); i++) {
				dayList += "<div class='invalid'>" + i + "</div>";
			}

			$(".calendar .day").html("").append(dayList);

			var date = new Date();
			if(year == date.getFullYear() && month == date.getMonth() + 1) {
				$(".calendar .day p:contains(" + date.getDate() +")").parent().addClass("today");
			}

			if(month.toString().length == 1) {
				month = "0" + month;
			}

			$(".calendar .selector p").html("").append("<span class='year'>" + year + "</span>年<span class='month'>" + month + "</span>月");

			$.ajax({
				url: "getShowCalendar",
				type: "POST",
				dataType: "json",
				data: {
					"month": year + "-" + month,
				},
				success: function(result) {
					console.log(result);
					if(result.code === 200) {
						var data = result.data;
						for(var i = 0; i < data.length; i++) {
							var target = $(".calendar .day p:contains(" + data[i].show_time.toString().split("-")[2].split(" ")[0] +")").parent();
							target.append("<span class='dot-span'></span><p class='count'>" + data[i].count + "场</p>").addClass("clickable");
						}
					}
				}
			});
		}
	}
});