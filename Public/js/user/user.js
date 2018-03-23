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
			// 标签页定位
			var tabList = ["#activity", "#show", "#band"];
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
					// console.log(result);
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
					// console.log(result);
					if(result.code === 200) {
						var data = result.data;
						_this.want = data.want;
						_this.support = data.support;
						_this.activity = data.activity;
						// console.log(_this.activity);
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
	}
});