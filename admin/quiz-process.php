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
			if (isset($_GET['bid']) && isset($_GET['tid']) && isset($_GET['q'])) {
				$bid = $_GET['bid'];
				$tid = $_GET['tid'];
				$q = $_GET['q'];
			}
			if (isset($_POST['submit-quiz'])) {
				$quiz->checkProcess($bid, $tid, 0, 0, $q);
			}
			?>

			<div class="page-content-fixed-header">
				<!-- BEGIN BREADCRUMBS -->
				<ul class="page-breadcrumb">
					<li><a href="index.php">Нүүр хуудас</a></li>
					<li><a href="quiz-book.php">Ном</a></li>
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

						<?php
						if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
							$IP = $_SERVER["HTTP_CLIENT_IP"];
						} elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
							$IP = $_SERVER["HTTP_X_FORWARDED_FOR"];
						} else {
							$IP = $_SERVER["REMOTE_ADDR"];
						}
						$rand = rand(1,4);
						$getQuiz = $quiz->quizProcess($bid, $tid, 0, 0, $q);
						if ($row = $getQuiz->fetch_assoc()) {
							?>

							<!-- BEGIN SAMPLE FORM PORTLET-->
							<div class="portlet light bordered">
								<div class="portlet-title">
									<div class="caption">
										<!-- <i class="icon-settings font-red-sunglo"></i> -->
										<span class="caption-subject font-blue-sharp bold uppercase">Нийт: 20/<?php echo $q; ?></span>
									</div>
								</div>
								<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
									<div class="portlet-body form">
										<div class="form-body">
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label class="col-md-6 control-label">Солонгос үг : <h2><?php echo $row['kr_w']; ?> </h2></label>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="row">
														<?php for($i=1;$i<=4;$i++) { ?>
															<?php
															if ($i == $rand) {
																$correct = $quiz->getCorrectAnswer($row['krid']);
																$crow = $correct->fetch_assoc();
																?>
																<div class="col-md-6 col-sm-6">
																	<label class="mt-radio">
																		<input type="radio" name="answer[0]" id="optionsRadios" value="option"> <?php echo $fm->ucfirst($crow['mn_w']); ?>
																		<span></span>
																	</label>
																</div>
																<?php
															} else {
																$wrong = $quiz->getWrongAnswer($row['krid']);
																$wrow = $wrong->fetch_assoc();
																?>
																<div class="col-md-6 col-sm-6">
																	<label class="mt-radio">
																		<input type="radio" name="answer[0]" id="optionsRadios" value="option"> <?php echo $fm->ucfirst($wrow['mn_w']); ?>
																		<span></span>
																	</label>
																</div>
															<?php } ?>
														<?php } ?>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-10">
													<a href="books.php" class="btn default">Өмнөх</a>
												</div>
												<div class="col-md-2">
													<button type="submit" name="submit-quiz" class="btn green">
														<i class="fa fa-plus"></i> Дараах
													</button>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						<?php } ?>
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