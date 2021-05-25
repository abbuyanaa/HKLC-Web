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

			<?php
			if (isset($_GET['bid']) && isset($_GET['tid']) && isset($_GET['level'])) {
				$bid = $_GET['bid'];
				$tid = $_GET['tid'];
				$level = $_GET['level'];
			} else {
				header("Location: lessonbooks.php");
			}
			?>

			<div class="page-content-fixed-header">
				<!-- BEGIN BREADCRUMBS -->
				<ul class="page-breadcrumb">
					<li>
						<a href="index.php">Нүүр хуудас</a>
					</li>
					<li>
						<a href="lessonbooks.php">Хичээл</a>
					</li>
					<li>
						<a href="lessontopics.php?bookid=<?php echo $bid; ?>">Сэдэв</a>
					</li>
					<li>
						<a href="index.php">Түвшин</a>
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

						<!-- BEGIN SAMPLE FORM PORTLET-->
						<div class="portlet light bordered">
							<div class="portlet-title">
								<div class="caption">
									<!-- <i class="icon-settings font-red-sunglo"></i> -->
									<span class="caption-subject font-blue-sharp bold uppercase">Нийт үг 20/20 <?php echo rand(1,4); ?></span>
								</div>
							</div>
							<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
								<div class="portlet-body form">
									<div class="form-body">
										<?php
										$getData = $learn->getLearningSection($bid, $tid, $level, $word);
										if ($getData != false) {
											$wordData = $getData->fetch_assoc();
											?>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label class="col-md-3 control-label">Солонгос нэр : <span class="text-danger">*</span></label>
														<div class="col-md-9">
															<input type="text" name="kr_name" class="form-control" value="<?php echo $wordData['kr_w']; ?>" readonly>
														</div>
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label class="col-md-3 control-label">Хариулт :</label>
														<div class="col-md-9">
															<div class="mt-radio-list">
																<label class="mt-radio">
																	<input type="radio" name="optionsRadios" id="optionsRadios" value="option1"> Option 1
																	<span></span>
																</label>
															</div>
														</div>
													</div>
												</div>
											</div>
										<?php } ?>
										<div class="table-scrollable">
											<table class="table table-bordered table-hover">
												<thead>
													<tr>
														<th style="text-align: center;" width="30%">Монгол үг</th>
														<th style="text-align: center;" width="10%">Жишээ өгүүлбэр</th>
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
																	<a href="lessontopics.php?bookid=<?php echo $row['id']; ?>" class="btn btn-outline btn-circle btn-sm blue">
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
									<div class="form-actions pull-right">
										<a href="books.php" class="btn default">Буцах</a>
										<button type="submit" name="add" class="btn green">
											<i class="fa fa-plus"></i> Нэмэх
										</button>
									</div>
								</div>
							</form>
						</div>
						<!-- END SAMPLE FORM PORTLET-->
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