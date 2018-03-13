new Vue({
	el: '#gudao',
	data: {
		place: [],
		shows: []
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

		this.getShowPlace();
		this.getShowByPage();
	},
	mounted: function() {
		this.$nextTick(function () {
		});
	},
	updated: function () {
		this.$nextTick(function () {
			$(".info").click(function() {
				location.href = "Show/detail?id=" + $(this).attr("index") + "#detail";
			});
			
			$(".condition a").click(this.getShowByCondition);
		});
	},
	computed: {
		list: function() {		//将shows入面show_time后三字符去除
			var result = this.shows;
			if(result) {
				result.forEach(function(item) {
					item.show_time = item.show_time.toString().substr(0, item.show_time.length - 3); // 去除最后三字符
				});
			}
			return result;
		}
	},
	methods: {
		getShowPlace: function() {	//条件栏获取palces
			var _this = this;
			$.ajax({
				url: "Show/getShowPlace",
				dataType: "json",
				success: function(result) {
					// console.log(result);
					if(result.code === 200) {
						_this.place = result.data;
					}
				}
			});
		},
		getShowByPage: function() { //获取shows
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
					// console.log(result.data);
					_this.shows = result.data;
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
						_this.shows = result.data;
					}
				});
			}
		}
	}
});