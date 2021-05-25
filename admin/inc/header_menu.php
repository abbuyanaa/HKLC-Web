<div class="page-sidebar navbar-collapse collapse">
	<!-- BEGIN SIDEBAR MENU -->
	<ul class="page-sidebar-menu page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
		<li class="nav-item start active open">
			<a href="index.php" class="nav-link nav-toggle">
				<i class="icon-home"></i>
				<span class="title">Нүүр хуудас</span>
				<span class="selected"></span>
				<span class="arrow open"></span>
			</a>
		</li>
		<li class="nav-item start active open">
			<a href="users.php" class="nav-link nav-toggle">
				<i class="icon-graduation"></i>
				<span class="title">Сурагчид</span>
				<span class="selected"></span>
				<span class="arrow open"></span>
			</a>
		</li>
		<li class="nav-item start active open">
			<a href="lessonbooks.php" class="nav-link nav-toggle">
				<i class="icon-globe"></i>
				<span class="title">Хичээл</span>
				<span class="selected"></span>
				<span class="arrow open"></span>
			</a>
		</li>
		<li class="nav-item start active open">
			<a href="quiz-book.php" class="nav-link nav-toggle">
				<i class="icon-globe"></i>
				<span class="title">Сорил</span>
				<span class="selected"></span>
				<span class="arrow open"></span>
			</a>
		</li>
		<?php if (Session::get('userType') == 'admin') { ?>
			<li class="nav-item start active open">
				<a href="wordlist.php" class="nav-link nav-toggle">
					<i class="icon-globe"></i>
					<span class="title">Үгсийн сан</span>
					<span class="selected"></span>
					<span class="arrow open"></span>
				</a>
			</li>
			<li class="nav-item start active open">
				<a href="aimag.php" class="nav-link nav-toggle">
					<i class="icon-home"></i>
					<span class="title">Үгсийн аймаг</span>
					<span class="selected"></span>
					<span class="arrow open"></span>
				</a>
			</li>
			<li class="nav-item start active open">
				<a href="book-list.php" class="nav-link nav-toggle">
					<i class="icon-notebook"></i>
					<span class="title">Ном</span>
					<span class="selected"></span>
					<span class="arrow open"></span>
				</a>
			</li>
		<?php } ?>
	</ul>
	<!-- END SIDEBAR MENU -->
</div>