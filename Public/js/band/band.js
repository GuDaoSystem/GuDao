new Vue({
	el: '#gudao',
	data: {
		initial: [],
		bands: []
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
		this.getBands();
		this.getInitial();
	},
	mounted: function() {
		this.$nextTick(function () {
		});
	},
	updated: function () {
		this.$nextTick(function () {
			var _this = this;

			// 监听筛选条件
			$(".condition li").unbind("click").click(function() {
				if(!$(this).hasClass("active") && !$(this).hasClass("invalid")) {
					$(".condition li").removeClass("active");
					$(this).addClass("active");
					if($(".condition li").index(this) == 0) {
						_this.getBands();
					} else {
						_this.getBands($(this).find("a").text());
					}
				}
			});

			// 监听乐队列表
			$(".band-content").click(function() {
				location.href = "Band/detail?id=" + $(this).attr("index") + "#show";
			});
		});
	},
	computed: {
	},
	methods: {
		// 获取首字母
		getInitial: function() {
			var _this = this;
			$.ajax({
				url: "Band/getInitial",
				dataType: "json",
				success: function(result) {
					// console.log(result);
					if(result.code === 200) {
						_this.initial = result.data;
						for(var i = 1; i < $(".condition li").length; i++) {
							if(_this.initial.indexOf($($(".condition li")[i]).find("a").text()) == -1) {
								$($(".condition li")[i]).addClass("invalid");
							}
						}
					}
				}
			});
		},
		// 获取乐队列表
		getBands: function(initial) {
			var _this = this;
			$.ajax({
				url: "Band/getBandByPage",
				type: "GET",
				dataType: "json",
				data: {
					"pageIndex": 1,
					"pageSize": 8,
					"initial": initial
				},
				success: function(result) {
					// console.log(result);
					_this.bands = result.data;
				}
			});
		}
	}
});