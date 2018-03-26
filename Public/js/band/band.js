new Vue({
	el: '#gudao',
	data: {
		loadFlag: true,
		pageIndex: 2,
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
		this.getInitial();
		this.getBands();
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
		// 获取首字母
		getInitial: function() {
			$.ajax({
				url: "Band/getInitial",
				dataType: "json",
				success: function(result) {
					if(result.code === 200) {
						var data = result.data;
						for(var i = 1; i < $(".condition a").length; i++) {
							if(data.indexOf($($(".condition a")[i]).text()) == -1) {
								$($(".condition a")[i]).addClass("invalid");
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
					if(result.code === 200) {
						if(result.data.length < 8) {
							$(".no-more").show();
							_this.loadFlag = false;
						}
					}
					_this.bands = result.data;
				}
			});
		},
		getBandsByCondition: function(e) {
			var _this = this;
			if(e.target.tagName.toLowerCase() == "a" && !$(e.target).hasClass("active") && !$(e.target).hasClass("invalid")) {
				$(".condition a").removeClass("active");
				$(e.target).addClass("active");

				var initial = $(e.target).text();
				if(initial == "热门") {
					initial = "";
				}

				// 重设自动加载相关变量
				_this.resetLoad();

				_this.getBands(initial);
			}
		},
		// 滚动至底部自动加载数据
		scrollToBottom: function() {
			var _this = this;
			$(window).scroll(function(){
		    	if(_this.loadFlag && $(window).height() + $(window).scrollTop() == $(document).height()) {
		    		// 防止多次加载
		    		_this.loadFlag = false;

		    		var initial = $(".condition .active").text();
		    		if(initial == "热门") {
		    			initial = "";
		    		}

		    		$.ajax({
		        		url: "Band/getBandByPage",
						type: "GET",
						dataType: "json",
						data: {
							"pageIndex": ++_this.pageIndex,
							"pageSize": 4,
							"initial": initial
						},
						success: function(result) {
							if(result.code === 200) {
								var data = result.data;
								for(var i = 0; i < data.length; i++) {
									_this.bands.push(data[i]);
								}
								if(data.length < 4) {
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
		// 跳转至乐队详细页
		toBandDetail: function(index) {
			location.href = "Band/detail?id=" + index + "#show";
		}
	}
});