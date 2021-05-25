<!DOCTYPE html>
<html lang="en">
<head>
	<?php
	$filepath = realpath(dirname(__FILE__));
	include_once($filepath.'/inc/head.php');
	?>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> -->
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
					<li>Үгсийн сан нэмэх</li>
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
				if (isset($_POST['nemeh'])) {
					$result = $word->insertWord($_POST);
				}
				if (isset($result)) { echo $result['msg']; }
				?>

				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN SAMPLE TABLE PORTLET-->
						<form role="form" action="" method="post" name="add_name" id="add_name">
							<div class="portlet light bordered">
								<div class="portlet-title">
									<div class="caption">
										<span class="caption-subject font-blue-sharp bold uppercase">Үгсийн санд шинэ үг нэмэх</span>
									</div>
									<div class="actions">
										<div class="btn-group btn-group-devided">
											<button type="submit" name="nemeh" class="btn blue">Нэмэх</button>
										</div>
									</div>
								</div>
								<div class="portlet-body">
									<div class="form-body">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Ном сонгох : <span class="text-danger">*</span></label>
													<select class="form-control" name="book" onchange="getBook(this.value);">
														<option value="1">Бусад ном</option>
														<?php
														$getBook = $word->getBooks();
														if ($getBook != false) {
															while ($row = $getBook->fetch_assoc()) {
																?>
																<option value="<?php echo $row['id']; ?>"><?php echo $row['kr_name'].' ~ '.$fm->ucfirst($row['mn_name']).' ~ '.$row['blkr_name']; ?></option>
															<?php } ?>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Номны сэдэв сонгох : <span class="text-danger">*</span></label>
													<select class="form-control" name="topic" id="topics">
														<option value="7">Сэдэв байхгүй.</option>
													</select>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Солонгос үг : <span class="text-danger">*</span></label>
													<input type="text" name="kr_w" class="form-control" placeholder="Жишээ: 한국">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Монгол үг : <span class="text-danger">*</span></label>
													<input type="text" name="mn_w" class="form-control" placeholder="Жишээ: 한국">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Үгсийн аймаг : <span class="text-danger">*</span></label>
													<select class="form-control" name="aimag">
														<option value="0">Үгсийн аймаг сонгох</option>
														<?php
														$getAimag = $aimag->getAllAimag();
														if ($getAimag != false) {
															while ($row = $getAimag->fetch_assoc()) {
																?>
																<option value="<?php echo $row['id']; ?>"><?php echo $fm->ucfirst($row['mn_name']); ?></option>
															<?php } ?>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<table class="table table-bordered" id="dynamic_field">
														<tr>
															<td width="96%"><input type="text" name="sentences[]" placeholder="Өгүүлбэр 1" class="form-control name_list" /></td>
															<td><button type="button" name="add" id="add" class="btn btn-success">+</button></td>
														</tr>
													</table>
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
			});
		});
	</script>
	<?php include_once($filepath.'/../inc/foot.php'); ?>
</body>
</html>