<!DOCTYPE html>
<html lang="en">
<head>
	<?php
	$filepath = realpath(dirname(__FILE__));
	include_once($filepath.'/inc/head.php');
	?>
	<script>
		function getBook(val) {
			$.ajax({
				type: 'POST',
				url: 'getDropTopics.php',
				data: 'bookid='+val,
				success: function(data) {
					$('#topics').html(data);
				}
			});
		}
		function getEBook(val) {
			$.ajax({
				type: 'POST',
				url: 'getDropTopics.php',
				data: 'bookid='+val,
				success: function(data) {
					$('#etopics').html(data);
				}
			});
		}
	</script>
</head>
<body>

	<!-- BEGIN HEADER -->
	<?php include_once($filepath.'/../admin/inc/header.php'); ?>
	<!-- END HEADER -->

	<!-- BEGIN CONTAINER -->
	<div class="container-fluid">
		<div class="page-content page-content-popup">

			<div class="page-content-fixed-header">
				<!-- BEGIN BREADCRUMBS -->
				<ul class="page-breadcrumb">
					<li><a href="index.php">Нүүр хуудас</a></li>
					<li>Солонгос үг</li>
				</ul>
				<!-- END BREADCRUMBS -->
			</div>

			<div class="page-sidebar-wrapper">
				<!-- BEGIN SIDEBAR -->
				<?php include_once($filepath.'/../admin/inc/header_menu.php'); ?>
				<!-- END SIDEBAR -->
			</div>
			<div class="page-fixed-main-content">
				<?php
				$getBook = $book->getAllBooks();
				$getAimag = $aimag->getAllAimag();

				if (!isset($_GET['view']) || $_GET['view'] == NULL) {
					$msg = 'Okey';
				} else {
					$get_wordid = $_GET['view'];
					$get_krword = $word->getKrWord($get_wordid);
					if ($get_krword != false) {
						$getrow = $get_krword->fetch_assoc();
						$get_bookid = $getrow['book_id'];
						$get_topicid = $getrow['topic_id'];
						$get_kr_w = $getrow['kr_w'];
						$get_aimagid = $getrow['aimag_id'];
						$getBookTopicsData = $topic->getDropBookTopics($get_bookid);
					}
				}

				if (isset($_POST['delete'])) {
					$msg = $word->deleteKrAlldata($get_wordid);
				}
				?>
				<?php if (isset($msg)) { echo $msg; } ?>

				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN SAMPLE TABLE PORTLET-->
						<div class="portlet light bordered">
							<div class="portlet-title">
								<div class="caption">
									<span class="caption-subject font-blue-sharp bold uppercase"><?php echo $get_kr_w ?> мэдээлэл</span>
								</div>
							</div>
							<div class="portlet-body form">
								<form role="form" action="" method="post">
									<div class="form-body">

										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Ном сонгох</label>
													<select class="form-control" name="book" disabled>
														<option>Ном сонгох</option>
														<?php
														if ($getBook != false) {
															while ($row = $getBook->fetch_assoc()) {
																?>
																<option value="<?php echo $row['id']; ?>" <?php if ($get_bookid == $row['id']) {echo 'selected';} ?>><?php echo $row['mn_name']; ?></option>
															<?php } ?>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Номны сэдэв сонгох</label>
													<select class="form-control" name="topic" id="topics" disabled>
														<option value="0">Сэдэв байхгүй.</option>
														<?php
														if ($getBookTopicsData != false) {
															while ($getrow = $getBookTopicsData->fetch_assoc()) { ?>
																<option value="<?php echo $getrow['id']; ?>" <?php if ($get_topicid == $getrow['id']) { echo 'selected'; } ?>>
																	<?php echo $getrow['kr_name']; ?>
																</option>
															<?php } ?>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Үгсийн аймаг</label>
													<select class="form-control" name="aimag" disabled>
														<option value="0">Үгсийн аймаг сонгох</option>
														<?php
														if ($getAimag != false) {
															while ($row = $getAimag->fetch_assoc()) {
																?>
																<option value="<?php echo $row['id']; ?>" <?php if ($get_aimagid == $row['id']) {echo 'selected';} ?>><?php echo ucfirst($row['mn_name']); ?></option>
															<?php } ?>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Солонгос үг</label>
													<input type="text" name="kr_name" class="form-control" placeholder="Жишээ: 한국" value="<?php echo $get_kr_w; ?>" readonly>
												</div>
											</div>
										</div>

									</div>
									<div class="form-actions right">
										<button type="submit" name="delete" class="btn green" onclick="return confirm('Та энэ үгийг устгах бол энэ үгтэй холбоотой монгол үг бүгд устах болохыг анхаарна уу!');">Устгах</button>
									</div>
								</form>
							</div>
						</div>
						<!-- END SAMPLE TABLE PORTLET-->
					</div>
				</div>

				<div class="row">
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
												<th style="text-align: center;" width="5%">No.</th>
												<th style="text-align: center;" width="20%">Үг</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$getWords = $word->getKrWordMnView($get_wordid);
											if ($getWords != false) { $i=1;
												while ($row = $getWords->fetch_assoc()) {
													?>
													<tr>
														<td><?php echo $i++; ?></td>
														<td><?php echo $row['mn_w']; ?></td>
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
				<!-- BEGIN FOOTER -->
				<?php include_once($filepath.'/../admin/inc/footer.php'); ?>
				<!-- END FOOTER -->
			</div>
			<!-- END CONTAINER -->
		</div>
		<!-- BEGIN QUICK SIDEBAR -->
		<?php include_once($filepath.'/../admin/inc/sidebar.php'); ?>
		<!-- END QUICK SIDEBAR -->
		<!-- BEGIN QUICK NAV -->
		<div class="quick-nav-overlay"></div>
		<!-- END QUICK NAV -->
	</div>
	<?php include_once($filepath.'/../admin/inc/foot.php'); ?>
</body>
</html>