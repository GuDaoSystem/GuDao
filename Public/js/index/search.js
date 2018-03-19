new Vue({
	el: '#gudao',
	data: {
		newNotices: []
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
		
	},
	mounted: function() {
		this.$nextTick(function () {
			
		});

		this.getNewNotices(["未来", "广州"]);
	},
	updated: function () {
		this.$nextTick(function () {
		});
	},
	computed: {
	},
	methods: {
		getNewNotices:function(key) {
			var _this = this;
			$.ajax({
				url: "doSearch",
				type: "POST",
				dataType: "json",
				data: {
					"key": key
				},
				success: function(r) {
					_this.newNotices = r.data.notice;
				}
			});

		},
		getNewShow: function() {
			var _this = this;
			$.ajax({
				url: "getRecentShow",
				dataType: "json",
				success: function(result) {

					_this.newShows = result.data;
				}
			});
		},


	}

});