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
	if (isset($_GET['bid']) && isset($_GET['tid']) && isset($_GET['level']) && isset($_GET['word'])) {
		$bid = $_GET['bid'];
		$tid = $_GET['tid'];
		$level = $_GET['level'];
		$word = $_GET['word'];
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
					<li><a href="index.php">Нүүр хуудас</a></li>
					<li><a href="lessonbooks.php">Ном</a></li>
					<li>Үг</li>
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
						<?php
						$getData = $learn->getLearningWordView($bid, $tid, $level, $word);
						if ($getData == false) {
							header("Location: lessonbooks.php");
						} else {
							$row = $getData->fetch_assoc();
							$aimagid = $row['aimag_id'];
							$kr_w = $row['kr_w'];
							$mn_w = $row['mn_w'];
						}
						?>
						<!-- BEGIN SAMPLE TABLE PORTLET-->
						<form action="" method="post">
							<div class="portlet light bordered">
								<div class="portlet-title">
									<div class="caption">
										<span class="caption-subject font-blue-sharp bold uppercase">Үг</span>
									</div>
								</div>
								<div class="portlet-body">
									<div class="form-body">

										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Ном сонгох :</label>
													<select class="form-control" name="ebook" disabled>
														<?php
														$getBook = $book->getAllBooks("");
														if ($getBook != false) {
															while ($row = $getBook->fetch_assoc()) {
																?>
																<option value="<?php echo $row['id']; ?>" <?php if ($bid == $row['id']) {echo 'selected';} ?>><?php echo $fm->ucfirst($row['mn_name']); ?></option>
															<?php } ?>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Номны сэдэв сонгох :</label>
													<select class="form-control" name="etopic" disabled>
														<?php
														$getTopic = $topic->getDropBookTopics($bid);
														if ($getTopic != false) {
															while ($row = $getTopic->fetch_assoc()) {
																?>
																<option value="<?php echo $row['id']; ?>" <?php if ($tid == $row['id']) {echo 'selected';} ?>><?php echo $row['kr_name'].' - '.$row['mn_name']; ?></option>
															<?php } ?>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Үгсийн аймаг :</label>
													<select class="form-control" name="eaimag" disabled>
														<?php
														$getAimag = $aimag->getAllAimag();
														if ($getAimag != false) {
															while ($row = $getAimag->fetch_assoc()) {
																?>
																<option value="<?php echo $row['id']; ?>" <?php if ($aimagid == $row['id']) {echo 'selected';} ?>><?php echo $fm->ucfirst($row['mn_name']); ?></option>
															<?php } ?>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Солонгос үг :</label>
													<input type="text" name="ekr_w" class="form-control" placeholder="Жишээ: 한국" value="<?php echo $kr_w; ?>" disabled>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Монгол үг :</label>
													<input type="text" name="emn_w" class="form-control" placeholder="Жишээ: 한국" value="<?php echo $mn_w; ?>" disabled>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Түвшин :</label>
													<select class="form-control" name="elevel" disabled>
														<?php
														$getLevel = $learn->getLessonLevel();
														if ($getLevel != false) {
															while ($rowLevel = $getLevel->fetch_assoc()) {
																?>
																<option value="<?php echo $rowLevel['id']; ?>" <?php if ($level == $rowLevel['id']){echo 'selected';} ?>><?php echo $rowLevel['kr_level'].' - '.$fm->ucfirst($rowLevel['mn_level']); ?></option>
															<?php } ?>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>

									</div>
								</div>
							</div>
						</form>
						<!-- END SAMPLE TABLE PORTLET-->

					</div>
				</div>
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
		<!-- END QUICK NAV -->
	</div>
	<?php include_once($filepath.'/../inc/foot.php'); ?>
</body>
</html>