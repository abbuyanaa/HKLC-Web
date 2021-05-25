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
					<li><a href="index.php">Нүүр хуудас</a></li>
					<li>Сорил</li>
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
								<div class="actions">
									<a href="bookadd.php" class="btn btn-outline white btn-circle btn-sm">
										<i class="fa fa-plus"></i> Нэмэх
									</a>
								</div>
							</div>
							<div class="portlet-body">
								<div class="table-scrollable">
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th style="text-align: center;" width="5%">No.</th>
												<th style="text-align: center;" width="25%">Солонгос нэр</th>
												<th style="text-align: center;" width="25%">Монгол нэр</th>
												<th style="text-align: center;" width="10%" colspan="3">Үйлдэл</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$getData = $quiz->quizBook();
											if ($getData != false) { $i=1;
												while ($row = $getData->fetch_assoc()) {
													?>
													<!-- active, success, warning, danger -->
													<tr>
														<td align="center"><?php echo $i++; ?></td>
														<td><?php echo $fm->ucfirst($row['kr_name']); ?></td>
														<td><?php echo $fm->ucfirst($row['mn_name']); ?></td>
														<td align="center">
															<a href="quiz-topic.php?bid=<?php echo $row['id']; ?>" class="btn btn-outline btn-circle btn-sm yellow">
																<i class="fa fa-edit"></i> Орох
															</a>
														</td>
													</tr>
												<?php } ?>
											<?php } else { ?>
												<tr>
													<td colspan="6" style="text-align: center;color: red;">Not Available</td>
												</tr>
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
			<!-- END CONTAINER -->
		</div>
		<!-- END CONTAINER -->
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