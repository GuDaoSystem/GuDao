new Vue({
	el: '#gudao',
	data: {
		result: {},
		notice: []
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
		this.init();
	},
	updated: function () {
		this.$nextTick(function () {
		});
	},
	computed: {
	},
	methods: {
		getResult:function(key) {

			var _this = this;
			return $.ajax({
				url: "doSearch",
				type: "POST",
				dataType: "json",
				data: {
					"key": key
				},
				success: function(r) {
					// console.log(r,"r");
					// _this.result = r;
					_this.notice = r.data.notice;
					// console.log(_this.result,"_this.result");

				}
			});

		},

		init:function(){
			this.getResult(["未来", "广州"]);
			console.log(this.notice)
			// console.log(this.result,"this.result");

		}
	}

});