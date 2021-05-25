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
					<li>Хичээл</li>
				</ul>
				<!-- END BREADCRUMBS -->
			</div>

			<div class="page-sidebar-wrapper">
				<!-- BEGIN SIDEBAR -->
				<?php include_once($filepath.'/../inc/header_menu.php'); ?>
				<!-- END SIDEBAR -->
			</div>
			
			<div class="page-fixed-main-content">
				<div class="row">
					<div class="col-md-12">

						<!-- BEGIN SAMPLE TABLE PORTLET-->
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-book"></i>Номны жагсаалт
								</div>
							</div>
							<div class="portlet-body">
								<div class="table-scrollable">
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th style="text-align: center;" width="5%">No.</th>
												<th style="text-align: center;" width="30%">Ном</th>
												<th style="text-align: center;" width="10%">Үйлдэл</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$getData = $learn->getLessonBooks();
											if ($getData) { $i=1;
												while ($row = $getData->fetch_assoc()) { ?>
													<tr>
														<td align="center"><?php echo $i++; ?></td>
														<td><?php echo $row['kr_name'].' - '.$fm->ucfirst($row['mn_name']); ?></td>
														<td align="center">
															<a href="lessontopics.php?bid=<?php echo $row['id']; ?>" class="btn btn-outline btn-circle btn-sm blue">
																<i class="fa fa-eye"></i> Орох
															</a>
														</td>
													</tr>
												<?php } ?>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- END SAMPLE TABLE PORTLET-->
					</div>
				</div>
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