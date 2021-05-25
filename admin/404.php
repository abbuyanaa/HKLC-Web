<!DOCTYPE html>
<html lang="en">
<head>
	<?php
	$filepath = realpath(dirname(__FILE__));
	include_once($filepath.'/inc/head.php');
	?>
</head>
<body>

	<!-- BEGIN HEADER -->
	<?php include_once($filepath.'/inc/header.php'); ?>
	<!-- END HEADER -->

	<!-- BEGIN CONTAINER -->
	<div class="container-fluid">
		<div class="page-content page-content-popup">

			<div class="page-content-fixed-header">
				<!-- BEGIN BREADCRUMBS -->
				<ul class="page-breadcrumb">
					<li>
						<a href="index.php">Нүүр хуудас</a>
					</li>
					<li>404 Таны хайсан хуудас олдсонгүй</li>
				</ul>
				<!-- END BREADCRUMBS -->
			</div>

			<div class="page-sidebar-wrapper">
				<!-- BEGIN SIDEBAR -->
				<?php include_once($filepath.'/../inc/header_menu.php'); ?>
				<!-- END SIDEBAR -->
			</div>
			
			<div class="page-fixed-main-content">
				<!-- BEGIN PAGE BASE CONTENT -->
				<div class="row">
					<div class="col-md-12 page-404">
						<div class="number font-green"> 404 </div>
						<div class="details">
							<h3>Алдаа гарлаа!</h3>
							<p>Уучлаарай таны хайсан хуудас олдсонгүй.
								<br/>
								<a href="index.php"> Нүүр хуудас </a> руу очих. </p>
							</div>
						</div>
					</div>
					<!-- END PAGE BASE CONTENT -->
				</div>
				<!-- BEGIN FOOTER -->
				<?php include_once($filepath.'/../inc/footer.php'); ?>
				<!-- END FOOTER -->
			</div>
			<!-- END CONTAINER -->
			<!-- BEGIN QUICK SIDEBAR -->
			<?php include_once($filepath.'/../inc/sidebar.php'); ?>
			<!-- END QUICK SIDEBAR -->
			<!-- BEGIN QUICK NAV -->
			<div class="quick-nav-overlay"></div>
			<!-- END QUICK NAV -->
		</div>
		<?php include_once($filepath.'/../inc/foot.php'); ?>
	</body>
	</html>