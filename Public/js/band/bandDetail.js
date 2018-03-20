new Vue({
	el: '#gudao',
	data: {
		band: {},
		supportNum: 0,
		support: false,
		shows: [],
		pictures: [],
		comments: []
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
		this.getBand();
		this.getSupportNum();
		this.checkSupport();
		this.getShows();
		this.getPicture();
		this.getComment();
	},
	mounted: function() {
		this.$nextTick(function () {
			// 标签页定位
			var tabList = ["#show", "#picture", "#comment"];
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
		getBand: function() {
			var _this = this;
			$.ajax({
				url: "getBandByID",
				type: "GET",
				dataType: "json",
				data: {
					"id": location.search.toString().substr(1).split("=")[1]
				},
				success: function(result) {
					// console.log(result);
					_this.band = result.data;
				}
			});
		},
		getSupportNum: function() {
			var _this = this;
			$.ajax({
				url: "getSupportUserNum",
				type: "GET",
				dataType: "json",
				data: {
					"id": location.search.toString().substr(1).split("=")[1]
				},
				success: function(result) {
					// console.log(result);
					_this.supportNum = result.data;
				}
			});
		},
		checkSupport: function() {
			var _this = this;
			$.ajax({
				url: "checkSupport",
				type: "POST",
				dataType: "json",
				data: {
					"user_id": sessionStorage.getItem("userID"),
					"band_id": location.search.toString().substr(1).split("=")[1]
				},
				success: function(result) {
					// console.log(result);
					if(result.code === 200) {
						_this.support = true;
					}
				}
			});
		},
		getShows: function() {
			var _this = this;
			$.ajax({
				url: "getExperience",
				type: "GET",
				dataType: "json",
				data: {
					"id": location.search.toString().substr(1).split("=")[1]
				},
				success: function(result) {
					// console.log(result);
					_this.shows = result.data;
				}
			});
		},
		getPicture: function() {
			var _this = this;
			$.ajax({
				url: "getPictureByBand",
				type: "GET",
				dataType: "json",
				data: {
					"id": location.search.toString().substr(1).split("=")[1]
				},
				success: function(result) {
					// console.log(result);
					_this.pictures = result.data;
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
					"target": 2,
					"id": location.search.toString().substr(1).split("=")[1]
				},
				success: function(result) {
					// console.log(result);
					_this.comments = result.data;
				}
			});
		}
	}
});