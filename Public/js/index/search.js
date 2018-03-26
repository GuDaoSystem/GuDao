new Vue({
	el: '#gudao',
	data: {
		loadFlag: true,
		pageIndex: 2,
		keys: [],
		notices: [],
		shows:[],
		bands:[]
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
		this.getKeys();
		this.searchAll();
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
		// 输入关键词
		doSearch: function(e) {
			if(e.keyCode == 13 || e.currentTarget.tagName.toLowerCase() == "button") {
				if($(".searchbox input").val()) {
					location.href = "search" + "?key=" + $(".searchbox input").val();
				} else {
					setAlertBox({
						className: "text",
						close: true,
						title: "孤岛提示",
						message: "请输入搜索内容"
					});
				}
			}
		},
		// 获取关键词
		getKeys: function() {
			this.keys = decodeURI(location.search.substr(1).split("=")[1]).split(" ");
		},
		// 搜索全部内容
		searchAll: function() {
			$(".conditions span").removeClass("active");
			$(".conditions span:eq(0)").addClass("active");
			$(".notices, .notices .more, .shows, .shows .more, .bands, .bands .more").show();
			$(".notices .no-more, .shows .no-more, .bands .no-more").hide();

			var _this = this;
			$.ajax({
				url: "searchNotice",
				type: "GET",
				dataType: "json",
				data: {
					"pageIndex":1,
					"pageSize":3,
					"key": _this.keys
				},
				success: function(result) {
					if(result.code === 200) {
						var data = result.data;
						for(var i = 0; i < data.length; i++) {
							for(var j = 0; j < _this.keys.length; j++) {
								data[i].notice_content = data[i].notice_content.replace(new RegExp(_this.keys[j],"g"), "<span class='keyword'>" + _this.keys[j] + "</span>");
							}
						}
						_this.notices = data;
						if(data.length < 3) {
							$(".notices .more").hide();
						}
					} else {
						$(".notices .more").hide();
					}
				}
			});
			$.ajax({
				url: "searchShow",
				type: "GET",
				dataType: "json",
				data: {
					"pageIndex":1,
					"pageSize":4,
					"key": _this.keys
				},
				success: function(result) {
					if(result.code === 200) {
						var data = result.data;
						for(var i = 0; i < data.length; i++) {
							for(var j = 0; j < _this.keys.length; j++) {
								data[i].show_name = data[i].show_name.replace(new RegExp(_this.keys[j],"g"), "<span class='keyword'>" + _this.keys[j] + "</span>");
							}
						}
						_this.shows = data;
						if(data.length < 4) {
							$(".shows .more").hide();
						}
					} else {
						$(".shows .more").hide();
					}
				}
			});
			$.ajax({
				url: "searchBand",
				type: "GET",
				dataType: "json",
				data: {
					"pageIndex":1,
					"pageSize":4,
					"key": _this.keys
				},
				success: function(result) {
					if(result.code === 200) {
						var data = result.data;
						for(var i = 0; i < data.length; i++) {
							for(var j = 0; j < _this.keys.length; j++) {
								data[i].band_name = data[i].band_name.replace(new RegExp(_this.keys[j],"g"), "<span class='keyword'>" + _this.keys[j] + "</span>");
							}
						}
						_this.bands = data;
						if(data.length < 4) {
							$(".bands .more").hide();
						}
					} else {
						$(".bands .more").hide();
					}
				}
			});
		},
		// 搜索通知
		searchNotice: function() {
			$(".conditions span").removeClass("active");
			$(".conditions span:eq(1)").addClass("active");
			$(".notices").show();
			$(".notices .more, .shows, .bands").hide();

			this.resetLoad();

			var _this = this;
			$.ajax({
				url: "searchNotice",
				type: "GET",
				dataType: "json",
				data: {
					"pageIndex":1,
					"pageSize":10,
					"key": _this.keys
				},
				success: function(result) {
					if(result.code === 200) {
						var data = result.data;
						_this.notices = data;
						if(data.length < 10) {
							$(".notices .no-more").show();
							_this.loadFlag = false;
						}
					}
				}
			});
		},
		// 搜索演出
		searchShow: function() {
			$(".conditions span").removeClass("active");
			$(".conditions span:eq(2)").addClass("active");
			$(".shows").show();
			$(".shows .more, .notices, .bands").hide();

			this.resetLoad();

			var _this = this;
			$.ajax({
				url: "searchShow",
				type: "GET",
				dataType: "json",
				data: {
					"pageIndex":1,
					"pageSize":8,
					"key": _this.keys
				},
				success: function(result) {
					if(result.code === 200) {
						var data = result.data;
						_this.shows = data;
						if(data.length < 8) {
							$(".shows .no-more").show();
							_this.loadFlag = false;
						}
					}
				}
			});
		},
		// 搜索乐队
		searchBand: function() {
			$(".conditions span").removeClass("active");
			$(".conditions span:eq(3)").addClass("active");
			$(".bands").show();
			$(".bands .more, .notices, .shows").hide();

			this.resetLoad();

			var _this = this;
			$.ajax({
				url: "searchBand",
				type: "GET",
				dataType: "json",
				data: {
					"pageIndex":1,
					"pageSize":8,
					"key": _this.keys
				},
				success: function(result) {
					if(result.code === 200) {
						var data = result.data;
						_this.bands = data;
						if(data.length < 8) {
							$(".bands .no-more").show();
							_this.loadFlag = false;
						}
					}
				}
			});
		},
		// 滚动至底部自动加载数据
		scrollToBottom: function() {
			var _this = this;
			$(window).scroll(function(){
		    	if(_this.loadFlag && $(window).height() + $(window).scrollTop() == $(document).height()) {
		    		// 防止多次加载
		    		_this.loadFlag = false;

					switch($(".conditions span").index($(".conditions .active"))) {
						case 1:
							$.ajax({
								url: "searchNotice",
								type: "GET",
								dataType: "json",
								data: {
									"pageIndex":++_this.pageIndex,
									"pageSize":5,
									"key": _this.keys
								},
								success: function(result) {
									if(result.code === 200) {
										var data = result.data;
										_this.notices = _this.notices.concat(data);
										if(data.length < 5) {
											$(".notices .no-more").show();
										} else {
											_this.loadFlag = true;
										}
									} else {
										$(".notices .no-more").show();
									}
								}
							});
							break;
						case 2:
							$.ajax({
								url: "searchShow",
								type: "GET",
								dataType: "json",
								data: {
									"pageIndex":++_this.pageIndex,
									"pageSize":4,
									"key": _this.keys
								},
								success: function(result) {
									if(result.code === 200) {
										var data = result.data;
										_this.shows = _this.shows.concat(data);
										if(data.length < 4) {
											$(".shows .no-more").show();
										} else {
											_this.loadFlag = true;
										}
									} else {
										$(".shows .no-more").show();
									}
								}
							});
							break;
						case 3:
							$.ajax({
								url: "searchBand",
								type: "GET",
								dataType: "json",
								data: {
									"pageIndex":++_this.pageIndex,
									"pageSize":4,
									"key": _this.keys
								},
								success: function(result) {
									if(result.code === 200) {
										var data = result.data;
										_this.bands = _this.bands.concat(data);
										if(data.length < 4) {
											$(".bands .no-more").show();
										} else {
											_this.loadFlag = true;
										}
									} else {
										$(".bands .no-more").show();
									}
								}
							});
							break;
					}
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
			location.href = "../Show/detail?id=" + index;
		},
		// 跳转至乐队详细页
		toBandDetail: function(index) {
			location.href = "../Band/detail?id=" + index;
		}
	}
});