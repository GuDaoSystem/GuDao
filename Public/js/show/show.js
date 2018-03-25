new Vue({
	el: '#gudao',
	data: {
		loadFlag: true,
		pageIndex: 2,
		places: [],
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
		this.scrollToBottom();
	},
	mounted: function() {
		this.$nextTick(function () {
		});
	},
	updated: function () {
		this.$nextTick(function () {
		});
	},
	computed: {
	},
	methods: {
		// 获取演出地点
		getShowPlace: function() {
			var _this = this;
			$.ajax({
				url: "Show/getShowPlace",
				dataType: "json",
				success: function(result) {
					if(result.code === 200) {
						_this.places = result.data;
					}
				}
			});
		},
		// 获取演出列表
		getShowByPage: function() {
			var _this = this;
			// 获取页面传参
			var sort, time;
			if(location.search.substr(1).split("=")[0] == "sort") {
				sort = location.search.substr(1).split("=")[1];
				$(".condition .sort a").removeClass("active");
				$(".condition .sort li:eq(1) a").addClass("active");
			}
			if(location.search.substr(1).split("=")[0] == "time") {
				time = location.search.substr(1).split("=")[1];
			}

			$.ajax({
				url: "Show/getShowByPage",
				type: "GET",
				dataType: "json",
				data: {
					"pageIndex": 1,
					"pageSize": 6,
					"sort": sort,
					"time": time
				},
				success: function(result) {
					if(result.code === 200) {
						var data = result.data;
						if(data.length < 6) {
							$(".no-more").show();
						}
						for(var i = 0; i < data.length; i++) {
							var time = data[i].show_time.toString();
							data[i].show_time = time.substr(0, time.length - 3);
						}
					}
					_this.shows = result.data;
				}
			});
		},
		// 按条件获取演出列表
		getShowByCondition: function(e) {
			var _this = this;
			if(e.target.tagName.toLowerCase() == "a" && !$(e.target).hasClass("active")) {
				$(e.target).parents("ul").find("a").removeClass("active");
				$(e.target).addClass("active");

				// 演出排序
				var sort;
				if($(".sort a").index($(".sort .active"))) {
					sort = "hot";
				}

				// 演出地点
				var place = $(".place .active").text();
				if(place == "全部") {
					place = "";
				}

				// 演出状态
				var state = $(".state a").index($(".state .active"));

				// 重设自动加载相关变量
				_this.resetLoad();

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
						if(result.code === 200) {
							var data = result.data;
							if(data.length < 6) {
								$(".no-more").show();
								_this.loadFlag = false;
							}
							for(var i = 0; i < data.length; i++) {
								var time = data[i].show_time.toString();
								data[i].show_time = time.substr(0, time.length - 3);
							}
						}
						_this.shows = result.data;
					}
				});
			}
		},
		// 滚动至底部自动加载数据
		scrollToBottom: function() {
			var _this = this;
			$(window).scroll(function(){
		    	if(_this.loadFlag && $(window).height() + $(window).scrollTop() == $(document).height()) {
		    		// 防止多次加载
		    		_this.loadFlag = false;

					// 演出排序
					var sort;
					if($(".sort a").index($(".sort .active"))) {
						sort = "hot";
					}

					// 演出地点
					var place = $(".place .active").text();
					if(place == "全部") {
						place = "";
					}

					// 演出状态
					var state = $(".state a").index($(".state .active"));

		    		$.ajax({
		        		url: "Show/getShowByPage",
						type: "GET",
						dataType: "json",
						data: {
							"pageIndex": ++_this.pageIndex,
							"pageSize": 3,
							"sort": sort,
							"place": place,
							"state": state
						},
						success: function(result) {
							if(result.code === 200) {
								var data = result.data;
								for(var i = 0; i < data.length; i++) {
									var time = data[i].show_time.toString();
									data[i].show_time = time.substr(0, time.length - 3);
									_this.shows.push(data[i]);
								}
								if(data.length < 3) {
									$(".no-more").show();
									_this.loadFlag = false;
								} else {
									_this.loadFlag = true;
								}
							} else {
								$(".no-more").show();
							}
						}
		        	});
		    	}
		    });
		},
		// 重设自动加载相关变量
		resetLoad: function() {
			this.loadFlag = true,
			this.pageIndex = 2;
			$(".no-more").hide();
		},
		// 跳转至演出详细页
		toShowDetail: function(index) {
			location.href = "Show/detail?id=" + index + "#detail";
		}
	}
});