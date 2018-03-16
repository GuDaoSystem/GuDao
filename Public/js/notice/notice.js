new Vue({
	el: '#gudao',
	data: {
		notices: []
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
		this.getNotice();
	},
	mounted: function() {
		this.$nextTick(function () {
		});
	},
	updated: function () {
		this.$nextTick(function () {
			// 监听筛选条件
			$(".condition a").unbind("click").click(this.getNoticeByType);
		});
	},
	computed: {
	},
	methods: {
		getNotice: function() {
			var _this = this;
			$.ajax({
				url: "Notice/getNoticeByPage",
				type: "GET",
				dataType: "json",
				data: {
					"pageIndex": 1,
					"pageSize": 10
				},
				success: function(result) {
					// console.log(result);
					if(result.code === 200) {
						var data = result.data;
						for(var i = 0; i < data.length; i++) {
							var time = data[i].notice_time.toString().split(" ")[0].split("-");
							data[i].notice_time = time[0] + "年" + time[1] + "月" + time[2] + "日";
						}
					}
					_this.notices = result.data;
				}
			});
		},
		getNoticeByType: function(e) {
			var _this = this;
			if(!$(e.target).hasClass("active")) {
				$(".condition li").removeClass("active");
				$(e.target).parent().addClass("active");

				$.ajax({
					url: "Notice/getNoticeByPage",
					type: "GET",
					dataType: "json",
					data: {
						"pageIndex": 1,
						"pageSize": 10,
						"type": $(".condition li").index($(e.target).parent())
					},
					success: function(result) {
						console.log(result);
						if(result.code === 200) {
							var data = result.data;
							for(var i = 0; i < data.length; i++) {
								var time = data[i].notice_time.toString().split(" ")[0].split("-");
								data[i].notice_time = time[0] + "年" + time[1] + "月" + time[2] + "日";
							}
						}
						_this.notices = result.data;
					}
				});
			}
		}
	}
});