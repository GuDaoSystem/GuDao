new Vue({
	el: '#gudao',
	data: {
		info: {},
		want: 0,
		support: 0,
		activity: [],
		shows: [],
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
		this.getUserInfo();
		this.getActivity();
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
		// 获取用户信息
		getUserInfo: function() {
			_this = this;
			$.ajax({
				url: "getUserBasicInfo",
				type: "GET",
				dataType: "json",
				data: {
					"id": location.search.toString().substr(1).split("=")[1]
				},
				success: function(result) {
					if(result.code === 200) {
						var data = result.data;
						if(data.birthday) {
							data.age = new Date().getFullYear() - data.birthday.split("-")[0];
						}
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
					"id": location.search.toString().substr(1).split("=")[1]
				},
				success: function(result) {
					if(result.code === 200) {
						var data = result.data;
						_this.want = data.want;
						_this.support = data.support;
						_this.activity = data.activity;
						for(var i = 0; i < data.activity.length; i++) {
							if(data.activity[i]["type"] == "show") {
								_this.shows.push(data.activity[i]["show"]);
							} else {
								_this.bands.push(data.activity[i]["band"]);
							}
						}
					}
				}
			});
		},
		// 切换选项卡
		switchTab: function(e) {
			var tabList = ["activity", "show", "band"];
			$(".underline")[0].className = "underline";
			$(".underline").addClass("tab" + (tabList.indexOf($(e.target).attr("aria-controls")) + 1));
		},
		// 切换至演出选项卡
		toShowTab: function() {
			$(".tablist li").removeClass("active");
			$(".tablist li.tab2").addClass("active");
			$(".underline")[0].className = "underline";
			$(".underline").addClass("tab2");
			$(".tab-pane").removeClass("in active");
			$("#show").addClass("active");
			setTimeout(function() {
				$("#show").addClass("in");
			}, 200);
		},
		// 切换至乐队选项卡
		toBandTab: function() {
			$(".tablist li").removeClass("active");
			$(".tablist li.tab3").addClass("active");
			$(".underline")[0].className = "underline";
			$(".underline").addClass("tab3");
			$(".tab-pane").removeClass("in active");
			$("#band").addClass("active");
			setTimeout(function() {
				$("#band").addClass("in");
			}, 200);
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