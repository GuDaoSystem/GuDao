new Vue({
	el: '#gudao',
	data: {
		show: {},
		bands: [],
		want: "",
		comments: []
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

		this.getShow();
		this.getBand();
		this.getWant();
		this.getComment();
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

			var textareaPadding = 12 * 1 * 2;
			$("textarea").on("input", function () {
				if((this.scrollHeight - textareaPadding) > $(this).height()) {
					$(this).height(this.scrollHeight - textareaPadding);
				}
				$(this).next().find("span").text(this.value.length);
			});

			$(".reply").click(function() {
				$(this).parent().next(".reply-box").toggle();
			});
		});
	},
	computed: {
	},
	methods: {
		getShow: function() {
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
						// console.log(_this.show);
					}
				}
			});
		},
		getBand: function() {
			var _this = this;
			$.ajax({
				url: "getBandByShow",
				type: "GET",
				dataType: "json",
				data: {
					"id": location.search.substr(1).split("=")[1]
				},
				success: function(result) {
					if(result.code === 200) {
						_this.bands = result.data;
						// console.log(_this.bands);
					}
				}
			});
		},
		getWant: function() {
			var _this = this;
			$.ajax({
				url: "getWantUserNum",
				type: "GET",
				dataType: "json",
				data: {
					"id": location.search.substr(1).split("=")[1]
				},
				success: function(result) {
					if(result.code === 200) {
						_this.want = result.data;
						// console.log(_this.want);
					}
				}
			});
		},
		getComment: function() {
			var _this = this;
			$.ajax({
				url: "getCommentNReply",
				type: "GET",
				dataType: "json",
				data: {
					"target": 1,
					"id": location.search.substr(1).split("=")[1]
				},
				success: function(result) {
					if(result.code === 200) {
						_this.comments = result.data;
						// console.log(_this.comments);
					}
				}
			});
		}
	}
});