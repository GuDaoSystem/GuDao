new Vue({
	el: '#gudao',
	data: {
		band: {},
		supportNum: 0,
		support: false,
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
					console.log(_this.band.band_intro);
				}
			});
		},
		getSupportNum: function() {
			var _this = this;
			$.ajax({
				url: "__URL__/getSupportUserNum",
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
			$.ajax({
				url: "__URL__/checkSupport",
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
		}
	}
});