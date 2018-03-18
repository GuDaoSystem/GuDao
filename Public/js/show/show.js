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
		// 加载动画
		$(document).ajaxStart(function() {
			setLoading();
		}).ajaxStop(function() {
			removeLoading();
		});

		// 获取数据
		this.getShowPlace();
		this.getShowByPage();
	},
	mounted: function() {
		this.$nextTick(function () {
		});
	},
	updated: function () {
		this.$nextTick(function () {
			// 监听筛选条件
			$(".condition a").click(this.getShowByCondition);

			// 监听演出列表
			$(".show-content").click(function() {
				location.href = "Show/detail?id=" + $(this).attr("index") + "#detail";
			});
		});
	},
	computed: {
		// 删除shows.show_time最后三个字符
		list: function() {
			var result = this.shows;
			if(result) {
				result.forEach(function(item) {
					item.show_time = item.show_time.toString().substr(0, item.show_time.length - 3);
				});
			}
			return result;
		}
	},
	methods: {
		// 获取演出地点
		getShowPlace: function() {
			var _this = this;
			$.ajax({
				url: "Show/getShowPlace",
				dataType: "json",
				success: function(result) {
					// console.log(result);
					if(result.code === 200) {
						_this.place = result.data;
					}
				}
			});
		},
		// 无条件获取演出列表
		getShowByPage: function() {
			var _this = this;
			$.ajax({
				url: "Show/getShowByPage",
				type: "GET",
				dataType: "json",
				data: {
					"pageIndex": 1,
					"pageSize": 6
				},
				success: function(result) {
					console.log(result);
					_this.shows = result.data;
				}
			});
		},
		// 按条件获取演出列表
		getShowByCondition: function(e) {
			var _this = this;
			if(!$(e.target).parent().hasClass("active")) {
				// 切换active样式
				$(e.target).parent().parent().find("li").removeClass("active");
				$(e.target).parent().addClass("active");

				// 演出排序
				var sort;
				if($(".sort li").index($(".sort .active"))) {
					sort = "hot";
				}

				// 演出地点
				var place = $(".place .active a").text();
				if(place == "全部") {
					place = "";
				}

				// 演出状态
				var state = $(".state li").index($(".state .active"));

				$.ajax({
					url: "Show/getShowByPage",
					type: "GET",
					dataType: "json",
					data: {
						"pageIndex": 1,
						"pageSize": 6,
						"sort": sort,
						"place": place,
						"state": state
					},
					success: function(result) {
						_this.shows = result.data;
					}
				});
			}
		}
	}
});