new Vue({
	el: '#gudao',
	data: {
		show: {}
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

		this.getShowDetail();
	},
	mounted: function() {
		this.$nextTick(function () {
			var tabIndex = ["#detail", "#comment"].indexOf(location.hash);
			$(".tablist li:eq(" + tabIndex +")").addClass("active");
			$(".tablist .underline").addClass("tab" + (tabIndex + 1));
			$(".tab-content div:eq(" + tabIndex +")").addClass("in").addClass("active");
			$(".tablist a").click(function () {
				location.href = location.toString().split("#")[0] + $(this).attr("href");
				$(".tablist .underline").removeClass("tab1 tab2").addClass($(this).parent()[0].className);
			});
		});
	},
	updated: function () {
		this.$nextTick(function () {
			// $(".info").click(function() {
			// 	location.href = "Show/detail?id=" + $(this).attr("index") + "#detail";
			// });
		});
	},
	computed: {
	},
	methods: {
		getShowDetail: function() {
			var _this = this;
			$.ajax({
				url: "getShowByID",
				type: "GET",
				dataType: "json",
				data: {
					"id": location.search.substr(1).split("=")[1]
				},
				success: function(result) {
					if(result.code === 200) {
						var data = result.data;

						var time = data.show_time.toString();
						time = time.substr(0, time.length - 3);
						data.show_time = time;

						_this.show = data;
						console.log(data);
					}
				}
			});
		}
	}
});