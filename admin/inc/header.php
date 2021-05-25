<?php
include_once($filepath.'/classes/Session.php');
Session::checkSession();
include_once($filepath.'/classes/Book.php');
include_once($filepath.'/../classes/Topic.php');
include_once($filepath.'/../classes/Aimag.php');
include_once($filepath.'/../classes/Word.php');
include_once($filepath.'/../classes/Learning.php');
include_once($filepath.'/../classes/User.php');
include_once($filepath.'/../classes/Quiz.php');
include_once($filepath.'/../config/Format.php');

$user = new User();
$book = new Book();
$topic = new Topic();
$aimag = new Aimag();
$word = new Word();
$fm = new Format();
$learn = new Learning();
$quiz = new Quiz();
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: pre-check=0, post-check=0, max-age=0");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
?>
<header class="page-header">
	<nav class="navbar" role="navigation">
		<div class="container-fluid">
			<div class="havbar-header">
				<!-- BEGIN LOGO -->
				<a id="index" class="navbar-brand" href="index">
					<!-- <img src="../assets/layouts/layout6/img/logo.png" alt="Logo"> -->
					<span>Huree Learning</span>
				</a>
				<!-- END LOGO -->
				<!-- BEGIN TOPBAR ACTIONS -->
				<div class="topbar-actions">
					

					<!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
					<!-- <form class="search-form" action="extra_search.html" method="GET">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search here" name="query">
							<span class="input-group-btn">
								<a href="javascript:;" class="btn md-skip submit">
									<i class="fa fa-search"></i>
								</a>
							</span>
						</div>
					</form> -->
					<!-- END HEADER SEARCH BOX -->

					
					<!-- BEGIN GROUP NOTIFICATION -->
					<div class="btn-group-notification btn-group" id="header_notification_bar">
						<button type="button" class="btn md-skip dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<span class="badge">9</span>
						</button>
						<ul class="dropdown-menu-v2">
							<li class="external">
								<h3>
									<span class="bold">12 pending</span> notifications
								</h3>
								<a href="#">view all</a>
							</li>
							<li>
								<ul class="dropdown-menu-list scroller" style="height: 250px; padding: 0;" data-handle-color="#637283">
									<li>
										<a href="javascript:;">
											<span class="details">
												<span class="label label-sm label-icon label-success md-skip">
													<i class="fa fa-plus"></i>
												</span> New user registered. 
											</span>
											<span class="time">just now</span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
											<span class="details">
												<span class="label label-sm label-icon label-danger md-skip">
													<i class="fa fa-bolt"></i>
												</span> Server #12 overloaded. 
											</span>
											<span class="time">3 mins</span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
											<span class="details">
												<span class="label label-sm label-icon label-warning md-skip">
													<i class="fa fa-bell-o"></i>
												</span> Server #2 not responding. 
											</span>
											<span class="time">10 mins</span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
											<span class="details">
												<span class="label label-sm label-icon label-info md-skip">
													<i class="fa fa-bullhorn"></i>
												</span> Application error. 
											</span>
											<span class="time">14 hrs</span>
										</a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
					<!-- END GROUP NOTIFICATION -->
					<!-- BEGIN USER PROFILE -->
					<div class="btn-group-img btn-group">
						<button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<img src="https://www.freeiconspng.com/uploads/profile-icon-9.png" alt="">
						</button>
						<ul class="dropdown-menu-v2" role="menu">
							<li>
								<a href="page_user_profile_1.html">
									<i class="icon-user"></i> Профайл
									<span class="badge badge-danger">1</span>
								</a>
							</li>
							<li>
								<a href="app_inbox.html">
									<i class="icon-envelope-open"></i> My Inbox
									<span class="badge badge-danger"> 3 </span>
								</a>
							</li>
							<li class="divider"> </li>
							
							<li>
								<a href="logout.php?action=logout">
									<i class="icon-key"></i> Гарах
								</a>
							</li>
						</ul>
					</div>
					<!-- END USER PROFILE -->
				</div>
				<!-- END TOPBAR ACTIONS -->
			</div>
		</div>
		<!--/container-->
	</nav>
</header>