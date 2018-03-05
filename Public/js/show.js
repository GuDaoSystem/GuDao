new Vue({
	el: '#gudao',
	data: {
		showByPage: []
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

		this.getShowByPage();
	},
	mounted: function() {
		this.$nextTick(function () {
		});
	},
	updated: function () {
		this.$nextTick(function () {
			$(".info").click(function() {
				location.href = "Show/detail?id=" + $(this).attr("index") + "#home";
			});
		});
	},
	computed: {
		list: function() {
			var result = this.showByPage;
			result.forEach(function(item) {
				item.show_time = item.show_time.toString().substr(0, item.show_time.length - 3);
			});
			return result;
		}
	},
	methods: {
		getShowByPage: function() {
			var _this = this;
			$.ajax({
				url: "Show/getShowByPage",
				type: "GET",
				dataType: "json",
				data: {
					"pageIndex": 1,
					"pageSize": 2
				},
				success: function(result) {
					if(result.code === 200) {
						_this.showByPage = result.data;
					}
				}
			});
		}
	}
});