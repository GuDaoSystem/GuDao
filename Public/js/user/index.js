new Vue({
	el: '#gudao',
	data: {
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
	},
	updated: function () {
		this.$nextTick(function () {
		});
	},
	computed: {
	},
	methods: {
	}
});