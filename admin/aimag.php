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
					<li>Үгсийн аймаг</li>
				</ul>
				<!-- END BREADCRUMBS -->
			</div>

			<div class="page-sidebar-wrapper">
				<!-- BEGIN SIDEBAR -->
				<?php include_once($filepath.'/../inc/header_menu.php'); ?>
				<!-- END SIDEBAR -->
			</div>
			<?php
			if (isset($_GET['editid'])) {
				$aimagid = $_GET['editid'];
				$getAimag = $aimag->getAimag($aimagid);
				if ($getAimag != false) {
					if ($row = $getAimag->fetch_assoc()) {
						$kr_name = $row['kr_name'];
						$mn_name = $row['mn_name'];
					}
				} else {
					header("Location: aimag.php");
				}
			}

			if (isset($_POST['nemeh'])) {
				$msg = $aimag->insertAimag($_POST);
			}
			if (isset($_POST['zasah'])) {
				$msg = $aimag->updateAimag($aimagid, $_POST);
			}
			if (isset($_GET['delid'])) {
				$delid = $_GET['delid'];
				$check = $aimag->getAimag($delid);
				if ($check != false) {
					$msg = $aimag->deleteAimag($delid);
				} else {
					header("Location: aimag.php");
				}
			}
			?>
			<div class="page-fixed-main-content">
				<?php if (isset($msg)) { echo $msg; } ?>
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN SAMPLE FORM -->
						<?php if (!isset($aimagid)) { ?>
							<form action="" method="post" enctype="multipart/form-data">
								<div class="portlet light bordered">
									<div class="portlet-title">
										<div class="caption">
											<span class="caption-subject font-dark sbold uppercase">Үгсийн аймаг нэмэх</span>
										</div>
									</div>
									<div class="portlet-body form">
										<form class="form-horizontal" role="form">
											<div class="row">
												<div class="col-md-11">
													<div class="form-body">
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label class="col-md-3 control-label">Солонгос : <span class="text-danger">*</span></label>
																	<div class="col-md-9">
																		<input type="text" name="kr_name" class="form-control" placeholder="Солонгос">
																	</div>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="col-md-2 control-label">Монгол :</label>
																	<div class="col-md-10">
																		<input type="text" name="mn_name" class="form-control" placeholder="Монгол">
																	</div>
																</div>
															</div>
														</div>

													</div>
												</div>
												<div class="col-md-1">
													<div class="form-body">
														<div class="form-group">
															<div class="col-md-12">
																<button type="submit" name="nemeh" class="btn btn-sm blue">
																	<i class="fa fa-plus"></i> Нэмэх
																</button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</form>
						<?php } else { ?>
							<form action="" method="post" enctype="multipart/form-data">
								<div class="portlet light bordered">
									<div class="portlet-title">
										<div class="caption">
											<span class="caption-subject font-dark sbold uppercase">Үгсийн аймаг засах</span>
										</div>
									</div>
									<div class="portlet-body form">
										<form class="form-horizontal" role="form">
											<div class="row">
												<div class="col-md-11">
													<div class="form-body">
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label class="col-md-3 control-label">Солонгос :<span class="text-danger">*</span></label>
																	<div class="col-md-9">
																		<input type="text" name="ekr_name" class="form-control" placeholder="Солонгос" value="<?php echo $kr_name; ?>">
																	</div>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="col-md-3 control-label">Монгол :</label>
																	<div class="col-md-9">
																		<input type="text" name="emn_name" class="form-control" placeholder="Монгол" value="<?php echo $mn_name; ?>">
																	</div>
																</div>
															</div>
														</div>

													</div>
												</div>
												<div class="col-md-1">
													<div class="form-body">
														<div class="form-group">
															<div class="col-md-12">
																<button type="submit" name="zasah" class="btn btn-sm blue">Засах</button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</form>
						<?php } ?>
						<!-- END BEGIN SAMPLE FORM -->
					</div>
					<div class="col-md-12">
						<!-- BEGIN SAMPLE TABLE PORTLET-->
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-comments"></i>Солонгос үг
								</div>
							</div>
							<div class="portlet-body">
								<div class="table-scrollable">
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th width="5%" style="text-align: center;">No.</th>
												<th width="25%" style="text-align: center;">Солонгос</th>
												<th width="25%" style="text-align: center;">Монгол</th>
												<th width="5%" style="text-align: center;">Тоо</th>
												<th width="15%" style="text-align: center;">Үйлдэл</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$getAimagData = $aimag->getAllAimag();
											if ($getAimagData) { $i=1;
												while ($result = $getAimagData->fetch_assoc()) {
													?>
													<tr>
														<td align="center"><?php echo $i++; ?></td>
														<td><?php echo $result['kr_name']; ?></td>
														<td><?php echo $fm->ucfirst($result['mn_name']); ?></td>
														<td align="center"><?php echo $result['word_count']; ?></td>
														<td align="center">
															<a href="aimag.php?editid=<?php echo $result['id']; ?>" class="btn btn-outline btn-circle btn-sm purple"><i class="fa fa-edit"></i> Засах </a>
															<a href="aimag.php?delid=<?php echo $result['id']; ?>" class="btn btn-outline btn-circle dark btn-sm black" onclick="return confirm('Та энэ мэдээллийг устгахдаа итэлтэй байна уу!');"><i class="fa fa-trash-o"></i> Устгах </a>
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