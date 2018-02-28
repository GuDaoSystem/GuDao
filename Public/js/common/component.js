var navbar = {
	template: `<nav class="navbar navbar-fixed-top">
			   <div class="container">
				   <div class="navbar-header">
					   <!-- 展开菜单 -->
					   <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						   <span class="icon-bar"></span>
						   <span class="icon-bar"></span>
						   <span class="icon-bar"></span>
					   </button>
					   <!-- Logo -->
					   <a class="navbar-brand" href=""><img src="../../GuDao/Public/img/common/nav_logo.png"></a>
				   </div>
				   <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					   <!-- 未登录 -->
					   <p class="didnotLogin navbar-text navbar-right"><a href="../../GuDao/Index/login" class="navbar-link">登录</a>&ensp;|&ensp;<a href="../../GuDao/Index/register" class="navbar-link">注册</a></p>
					   <!-- 已登录 -->
					   <ul class="didLogin nav navbar-nav navbar-right">
						   <li class="dropdown">
							   <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="../../GuDao/Public/img/user/headImg.jpg"></a>
							   <ul class="dropdown-menu">
								   <li class="dropdown-header">NgWingLam</li>
								   <li role="separator" class="divider"></li>
								   <li><a href="../../GuDao/User">个人中心</a></li>
								   <li><a href="../../GuDao/User" class="tips">我的消息<span class="dot-span"></span></a></li>
								   <li class="logout"><a href="#">退出登录</a></li>
							   </ul>
						   </li>
					   </ul>
					   <!-- 表单 -->
					   <form class="search-box navbar-form navbar-right">
						   <div class="input-group">
							   <input type="text" class="form-control" placeholder="搜索...">
							   <span class="input-group-btn">
								   <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
							   </span>
						   </div>
					   </form>
					   <!-- 菜单 -->
					   <ul class="menu nav navbar-nav navbar-right">
						   <li><a href="../../GuDao/Index/home">首页</a></li>
						   <li><a href="../../GuDao/Notice">通知</a></li>
						   <li><a href="../../GuDao/Show">演出</a></li>
						   <li><a href="../../GuDao/Band">乐队</a></li>
					   </ul>
				   </div>
			   </div>
		   </nav>`
};

var backToTop = {
	template: `<a class="back-to-top"><span class="glyphicon glyphicon-send"></span></a>`
};

var copyright = {
	template: `<footer>Copyright&ensp;&copy;&ensp;2017-2018&ensp;孤岛音乐平台&ensp;All&ensp;Rights&ensp;Reserved.</footer>`
};


new Vue({
  el: '#gudao',
  components: {
  	"navbar": navbar,
  	"back-to-top": backToTop,
  	"copyright": copyright
  }
});