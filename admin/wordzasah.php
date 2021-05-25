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
	<?php include_once($filepath.'/inc/header.php'); ?>
	<!-- END HEADER -->

	<!-- BEGIN CONTAINER -->
	<div class="container-fluid">
		<div class="page-content page-content-popup">

			<div class="page-content-fixed-header">
				<!-- BEGIN BREADCRUMBS -->
				<ul class="page-breadcrumb">
					<li><a href="index.php">Нүүр хуудас</a></li>
					<li><a href="wordlist.php">Үгсийн сан</a></li>
					<li>Үгсийн сан засах</li>
				</ul>
				<!-- END BREADCRUMBS -->
			</div>

			<div class="page-sidebar-wrapper">
				<!-- BEGIN SIDEBAR -->
				<?php include_once($filepath.'/../inc/header_menu.php'); ?>
				<!-- END SIDEBAR -->
			</div>
			<div class="page-fixed-main-content">
				<?php
				if (isset($_GET['edit'])) {
					$get_wordid = $_GET['edit'];
					$get_word = $word->getWordData($get_wordid);
					if ($get_word != false) {
						if ($getDataRow = $get_word->fetch_assoc()) {
							$get_bid = $getDataRow['book_id'];
							$get_tid = $getDataRow['topic_id'];
							$get_aid = $getDataRow['aimag_id'];
							$get_krw = $getDataRow['kr_w'];
							$get_mnw = $getDataRow['mn_w'];
						}
					} else {
						header("Location: wordlist.php");
					}
				}

				if (isset($_GET['edit']) && isset($_GET['delid'])) {
					$delid = $_GET['delid'];
					$check = $word->checkSen($delid);
					if ($check == false) {
						header("Location: wordzasah.php?edit=".$get_wordid);
					} else {
						$sentence = $word->deleteSen($delid);
					}
				}

				if (isset($_POST['zasah'])) {
					$msg = $word->updateWord($_POST, $get_wordid);
				}

				if (isset($_POST['sen_nemeh'])) {
					$sentences = $word->insertSen($_POST, $get_wordid);
				}
				?>
				<?php if (isset($msg)) { echo $msg['msg']; } ?>
				<?php if (isset($sentence)) { header("Location: wordzasah.php?edit=".$get_wordid); } ?>

				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN SAMPLE TABLE PORTLET-->
						<form action="" method="post">
							<div class="portlet light bordered">
								<div class="portlet-title">
									<div class="caption">
										<span class="caption-subject font-blue-sharp bold uppercase">Үгсийн сангийн үг засах</span>
									</div>
									<div class="actions">
										<div class="btn-group btn-group-devided">
											<a href="wordnemeh.php" class="btn blue">Үг нэмэх</a>
											<input type="hidden" name="word_id" value="<?php echo $get_wordid; ?>" />
											<input type="submit" name="zasah" class="btn btn-outline blue" value="Засах" />
										</div>
									</div>
								</div>
								<div class="portlet-body">
									<div class="form-body">

										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Ном сонгох : <span class="text-danger">*</span></label>
													<select class="form-control" name="ebook" onchange="getBook(this.value);">
														<option value="0">Ном сонгох</option>
														<?php
														$getBook = $word->getBooks();
														if ($getBook != false) {
															while ($row = $getBook->fetch_assoc()) {
																?>
																<option value="<?php echo $row['id']; ?>" <?php if ($get_bid == $row['id']) {echo 'selected';} ?>><?php echo $row['kr_name'].' ~ '.$fm->ucfirst($row['mn_name']).' ~ '.$row['blkr_name']; ?></option>
															<?php } ?>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Номны сэдэв сонгох : <span class="text-danger">*</span></label>
													<select class="form-control" name="etopic" id="topics">
														<option value="0">Сэдэв сонгох.</option>
														<?php
														$getTopic = $topic->getDropBookTopics($get_bid);
														if ($getTopic != false) {
															while ($row = $getTopic->fetch_assoc()) {
																?>
																<option value="<?php echo $row['id']; ?>" <?php if ($get_tid == $row['id']) {echo 'selected';} ?>><?php echo $row['kr_name'].' - '.$fm->ucfirst($row['mn_name']); ?></option>
															<?php } ?>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Солонгос үг : <span class="text-danger">*</span></label>
													<input type="text" name="ekr_w" class="form-control" placeholder="Жишээ: 한국" value="<?php echo $get_krw; ?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Монгол үг : <span class="text-danger">*</span></label>
													<input type="text" name="emn_w" class="form-control" placeholder="Жишээ: 한국" value="<?php echo $get_mnw; ?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Үгсийн аймаг : <span class="text-danger">*</span></label>
													<select class="form-control" name="eaimag">
														<option value="0">Үгсийн аймаг сонгох</option>
														<?php
														$getAimag = $aimag->getAllAimag();
														if ($getAimag != false) {
															while ($row = $getAimag->fetch_assoc()) {
																?>
																<option value="<?php echo $row['id']; ?>" <?php if ($get_aid == $row['id']) {echo 'selected';} ?>><?php echo $row['kr_name'].' ~ '.$fm->ucfirst($row['mn_name']); ?></option>
															<?php } ?>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>

									</div>
								</div>
								<table class="table table-bordered" id="dynamic_field">
									<tr>
										<td width="95%">
											<input type="text" name="sentences[]" placeholder="Өгүүлбэр 1" class="form-control name_list" />
										</td>
										<td><button type="button" name="add" id="add" class="btn btn-success">+</button></td>
										<td><input type="submit" name="sen_nemeh" class="btn btn-success blue" value="Нэмэх"></td>
									</tr>
								</table>
							</div>
						</form>
						<!-- END SAMPLE TABLE PORTLET-->

					</div>
				</div>


				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN SAMPLE TABLE PORTLET-->
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-comments"></i>Өгүүлбэр
								</div>
							</div>
							<div class="portlet-body">
								<div class="table-scrollable">
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th style="text-align: center;" width="5%">No.</th>
												<th style="text-align: center;" width="50%">Жишээ өгүүлбэр</th>
												<th style="text-align: center;" width="20%">Үйлдэл</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$getWordSen = $word->getWordSentences($get_wordid);
											if ($getWordSen != false) { $i=1;
												while ($row = $getWordSen->fetch_assoc()) {
													?>
													<tr>
														<td><?php echo $i++; ?></td>
														<td><?php echo $row['sentences']; ?></td>
														<td style="text-align: center;">
															<a href="wordzasah.php?edit=<?php echo $get_wordid.'&delid='.$row['id']; ?>" class="btn btn-outline btn-circle green btn-sm purple" onclick="return confirm('Энэ өгүүлбэрийг хасахдаа итгэлтэй байна уу?');"><i class="fa fa-trash-o"></i> Устгах</a>
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
			<!-- END CONTAINER -->
		</div>
		<!-- BEGIN QUICK SIDEBAR -->
		<?php include_once($filepath.'/../inc/sidebar.php'); ?>
		<!-- END QUICK SIDEBAR -->
		<!-- BEGIN QUICK NAV -->
		<div class="quick-nav-overlay"></div>
		<!-- END QUICK NAV -->
	</div>
	<script>
		$(document).ready(function(){
			var i=1;
			$('#add').click(function(){
				i++;
				$('#dynamic_field').append(
					'<tr id="row'+i+'"><td><input type="text" name="sentences[]" placeholder="Өгүүлбэр '+i+'" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
			});
			$(document).on('click', '.btn_remove', function(){
				var button_id = $(this).attr("id");
				$('#row'+button_id+'').remove();
				i--;
			});
		});
	</script>
	<?php include_once($filepath.'/../inc/foot.php'); ?>
</body>
</html>