new Vue({
	el: '#gudao',
	data: {
		notices: [],
		shows:[],
		bands:[],
		keyword:"",
		editedKey:""
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

		this.getNotices(["未来", "广州"]);
		this.getShows();
		this.getBands();
	},
	updated: function () {
		this.$nextTick(function () {
		});
	},
	watch:{
		keyword:function(newVal,oldVal){
			this.editedKey = newVal + "hello";
			console.log(newVal);
			console.log(this.editedKey);
		}
	},
	computed: {

	},
	methods: {
		
		getNotices:function(key) {
			var _this = this;
			$.ajax({
				url: "doSearch",
				type: "POST",
				dataType: "json",
				data: {
					"key": key
				},
				success: function(r) {
					_this.notices = r.data.notice;
				}
			});

		},
		getShows: function() {
			var _this = this;
			$.ajax({
				url: "getRecentShow",
				dataType: "json",
				success: function(r) {
					_this.shows = r.data;
				}
			});
		},
		getBands: function() {
			var _this = this;
			$.ajax({
				url: "getHotBand",
				dataType: "json",
				success: function(r) {
					console.log(r.data);
					_this.bands = r.data;
				}
			});
		},
		// 点击演出跳转
		goShow:function(index){
			// console.log(index);
			// console.log(this.shows[index].show_id);
			location.href = "../Show/detail?id=" + this.shows[index].show_id + "#detail";
		},
		// 点击乐队跳转
		goBand:function(index){
			location.href = "../Band/detail?id=" + this.bands[index].band_id + "#detail";
		}


	}

});