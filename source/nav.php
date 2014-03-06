<?php require 'header.php' ?>
<body>
<header class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="../" class="navbar-brand">Sedge</a>
		</div>
		<nav class="collapse navbar-collapse" role="navigation">
			<p class="navbar-text"></p>
			<ul class="nav navbar-nav">
				<li <?php if($nav_index == 1)echo 'class="active"';?>><a href="../components">首页</a></li>
				<li <?php if($nav_index == 2)echo 'class="active"';?>><a href="../getting-started">快速提交</a></li>
				<li <?php if($nav_index == 3)echo 'class="active"';?>><a href="../css">作业列表</a></li>
				<li <?php if($nav_index == 4)echo 'class="active"';?>><a href="../components">班级</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">

				<?php
				if($nav_login == 0)
				{
					echo '<!--';
				}
				?>
				<li class="dropdown">
					<a class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown"> <span class="glyphicon glyphicon-envelope"></span></a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
						<li><a href="#">Action</a></li>
						<li><a href="#">Another action</a></li>
						<li><a href="#">Something else here</a></li>
						<li class="divider"></li>
						<li><a href="#">Separated link</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown"> <span class="glyphicon glyphicon-wrench"></span></a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
						<li><a href="#">Action2</a></li>
						<li><a href="#">Another action2</a></li>
						<li><a href="#">Something else here2</a></li>
						<li class="divider"></li>
						<li><a href="#">Separated link2</a></li>
					</ul>
				</li>
				<li><a href="../about"><span class="glyphicon glyphicon-user"></span> 用户名</a></li>
				
				
				<?php
				if($nav_login == 0)
				{
					echo '-->';
					echo '<li><button type="button" class="btn btn-success navbar-btn">登录</button></li>';
				}
				?>
			</ul>
		</nav>
    </div>
</header>