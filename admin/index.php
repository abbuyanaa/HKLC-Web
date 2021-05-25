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
					<li>Нүүр хуудас</li>
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

				<!-- BEGIN DASHBOARD STATS 1-->
				<div class="row">
					<?php include_once($filepath.'/../inc/stats.php'); ?>
				</div>
				<div class="clearfix"></div>
				<!-- END DASHBOARD STATS 1-->

				<div class="row">
					<div class="col-lg-6 col-xs-12 col-sm-12">
						<!-- BEGIN PORTLET-->
						<div class="portlet light bordered">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-bar-chart font-dark hide"></i>
									<span class="caption-subject font-dark bold uppercase">Site Visits</span>
									<span class="caption-helper">weekly stats...</span>
								</div>
							</div>
							<div class="portlet-body">
								<div id="site_statistics_loading">
									<img src="../assets/global/img/loading.gif" alt="loading" />
								</div>
								<div id="site_statistics_content" class="display-none">
									<div id="site_statistics" class="chart"> </div>
								</div>
							</div>
						</div>
						<!-- END PORTLET-->
					</div>
					<div class="col-lg-6 col-xs-12 col-sm-12">
						<!-- BEGIN PORTLET-->
						<div class="portlet light bordered">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-share font-red-sunglo hide"></i>
									<span class="caption-subject font-dark bold uppercase">Revenue</span>
									<span class="caption-helper">monthly stats...</span>
								</div>
							</div>
							<div class="portlet-body">
								<div id="site_activities_loading">
									<img src="../assets/global/img/loading.gif" alt="loading" />
								</div>
								<div id="site_activities_content" class="display-none">
									<div id="site_activities" style="height: 228px;"> </div>
								</div>
								<div style="margin: 20px 0 10px 30px">
									<div class="row">
										<div class="col-md-3 col-sm-3 col-xs-6 text-stat">
											<span class="label label-sm label-success"> Revenue: </span>
											<h3>$13,234</h3>
										</div>
										<div class="col-md-3 col-sm-3 col-xs-6 text-stat">
											<span class="label label-sm label-info"> Tax: </span>
											<h3>$134,900</h3>
										</div>
										<div class="col-md-3 col-sm-3 col-xs-6 text-stat">
											<span class="label label-sm label-danger"> Shipment: </span>
											<h3>$1,134</h3>
										</div>
										<div class="col-md-3 col-sm-3 col-xs-6 text-stat">
											<span class="label label-sm label-warning"> Orders: </span>
											<h3>235090</h3>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- END PORTLET-->
					</div>
				</div>

				<!-- END PAGE BASE CONTENT -->
			</div>
			<!-- BEGIN FOOTER -->
			<?php include_once($filepath.'/../inc/footer.php'); ?>
			<!-- END FOOTER -->
			<!-- END CONTAINER -->
		</div>
		<!-- BEGIN QUICK SIDEBAR -->
		<?php include_once($filepath.'/../inc/sidebar.php'); ?>
		<!-- END QUICK SIDEBAR -->
		<!-- BEGIN QUICK NAV -->
		<div class="quick-nav-overlay"></div>
	</div>
	<!-- END QUICK NAV -->
	<?php include_once($filepath.'/../inc/foot.php'); ?>
</body>
</html>