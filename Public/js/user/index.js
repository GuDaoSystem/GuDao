new Vue({
	el: '#gudao',
	data: {
		info: {}
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
		this.getUserInfo();
	},
	mounted: function() {
		this.$nextTick(function () {
		});
	},
	updated: function () {
		this.$nextTick(function () {
		});
	},
	computed: {
	},
	methods: {
		// 获取用户信息
		getUserInfo: function() {
			_this = this;
			$.ajax({
				url: "getUserBasicInfo",
				type: "GET",
				dataType: "json",
				data: {
					"id": sessionStorage.getItem("userID")
				},
				success: function(result) {
					console.log(result);

					var data = result.data;

					if(data.gender) {
						data.gender = "女";
					} else {
						data.gender = "男";
					}

					data.age = new Date().getFullYear() - data.birthday.split("-")[0];

					_this.info = result.data;
				}
			});
		}
	}
});