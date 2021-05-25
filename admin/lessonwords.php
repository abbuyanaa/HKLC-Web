<!DOCTYPE html>
<html lang="en">
<head>
	<?php
	$filepath = realpath(dirname(__FILE__));
	include_once($filepath.'/inc/head.php');
	ob_start();
	?>
</head>
<body>

	<!-- BEGIN HEADER -->
	<?php include_once($filepath.'/inc/header.php'); ?>
	<!-- END HEADER -->

	<?php
	if (isset($_GET['bid']) && isset($_GET['tid']) && isset($_GET['level'])) {
		$bid = $_GET['bid'];
		$tid = $_GET['tid'];
		$level = $_GET['level'];
	} else {
		header("Location: lessonbooks.php");
	}
	?>

	<!-- BEGIN CONTAINER -->
	<div class="container-fluid">
		<div class="page-content page-content-popup">

			<div class="page-content-fixed-header">
				<!-- BEGIN BREADCRUMBS -->
				<ul class="page-breadcrumb">
					<li>
						<a href="index.php">Нүүр хуудас</a>
					</li>
					<li>
						<a href="lessonbooks.php">Хичээл</a>
					</li>
					<li>Түүх</li>
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
										<i class="fa fa-eye"></i> Хичээл үзэх
									</a>
								</div>
							</div>
							<div class="portlet-body">
								<div class="table-scrollable">
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th style="text-align: center;" width="5%">No.</th>
												<th style="text-align: center;" width="20%">Солонгос</th>
												<th style="text-align: center;" width="20%">Монгол</th>
												<th style="text-align: center;" width="10%">Үйлдэл</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$getData = $learn->getLearningWords($bid, $tid, $level);
											if ($getData != false) { $i=1;
												while ($row = $getData->fetch_assoc()) {
													$url = "lessonwordview.php?bid=".$bid;
													$url .= "&tid=".$tid;
													$url .= "&level=".$level;
													$url .= "&word=".$row['wordid'];
													?>
													<tr>
														<td align="center"><?php echo $i++; ?></td>
														<td><?php echo $row['kr_w']; ?></td>
														<td><?php echo $fm->ucfirst($row['mn_w']); ?></td>
														<td align="center">
															<a href="<?php echo $url; ?>" class="btn btn-outline btn-circle btn-sm blue">
																<i class="fa fa-eye"></i> Орох
															</a>
														</td>
													</tr>
												<?php } ?>
											<?php } else { header("Location: lessonbooks.php"); }?>
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