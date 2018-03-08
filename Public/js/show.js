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
			$(".condition a").click(this.getShowByCondition);
		});
	},
	updated: function () {
		this.$nextTick(function () {
			$(".info").click(function() {
				location.href = "Show/detail?id=" + $(this).attr("index") + "#detail";
			});
		});
	},
	computed: {
		list: function() {
			var result = this.showByPage;
			if(result) {
				result.forEach(function(item) {
					item.show_time = item.show_time.toString().substr(0, item.show_time.length - 3);
				});
			}
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
					"pageSize": 6
				},
				success: function(result) {
					_this.showByPage = result.data;
				}
			});
		},
		getShowByCondition: function(e) {
			var _this = this;
			if(!$(e.target).parent().hasClass("active")) {
				$(e.target).parent().parent().find("li").removeClass("active");
				$(e.target).parent().addClass("active");

				var sort;
				if($(".sort li").index($(".sort .active"))) {
					sort = "hot";
				}

				var place = $(".place .active a").text();
				if(place == "全部") {
					place = "";
				}

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
						_this.showByPage = result.data;
					}
				});
			}
		}
	}
});