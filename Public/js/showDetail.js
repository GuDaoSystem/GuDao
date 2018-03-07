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
			var tabList = ["#detail", "#comment"];
			var tabIndex = tabList.indexOf(location.hash);
			$(".tablist li:eq(" + tabIndex +")").addClass("active");
			$(".tablist .underline").addClass("tab" + (tabIndex + 1));
			$(tabList[tabIndex]).addClass("in").addClass("active");
			$(".tablist a").click(function () {
				location.href = location.toString().split("#")[0] + $(this).attr("href");
				$(".tablist .underline").removeClass("tab1 tab2").addClass($(this).parent()[0].className);
			});
		});
	},
	updated: function () {
		this.$nextTick(function () {
			$(document).scrollTop(0);
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
						// console.log(data.show_message);
					}
				}
			});
		}
	}
});