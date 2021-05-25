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
					<li>
						<a href="book-list.php">Номын жагсаалт</a>
					</li>
					<li>Шинэ ном нэмэх</li>
				</ul>
				<!-- END BREADCRUMBS -->
			</div>

			<div class="page-sidebar-wrapper">
				<!-- BEGIN SIDEBAR -->
				<?php include_once($filepath.'/../inc/header_menu.php'); ?>
				<!-- END SIDEBAR -->
			</div>
			<?php
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$result = $book->insertBook($_POST, $_FILES);
			}
			?>
			<div class="page-fixed-main-content">
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN SAMPLE FORM PORTLET-->
						<?php if (isset($result)) {echo $result['msg'];} ?>
						<div class="portlet light bordered">
							<div class="portlet-title">
								<div class="caption">
									<!-- <i class="icon-settings font-red-sunglo"></i> -->
									<span class="caption-subject font-blue-sharp bold uppercase"> Шинэ ном нэмэх</span>
								</div>
							</div>
							<form action="" method="post" enctype="multipart/form-data">
								<div class="portlet-body form">
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<div class="fileinput fileinput-new" data-provides="fileinput">
													<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
														<img src="<?php if (isset($result)) {echo '../'.$result['image'];}else{echo 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';} ?>" alt="" />
													</div>
													<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
													<div>
														<span class="btn default btn-file">
															<span class="fileinput-new"> Зураг сонгох </span>
															<span class="fileinput-exists"> Солих </span>
															<input type="file" name="image">
														</span>
														<a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-9">
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label class="col-md-3 control-label">Солонгос нэр : <span class="text-danger">*</span></label>
														<div class="col-md-9">
															<input type="text" name="kr_name" class="form-control" placeholder="몽골" value="<?php if (isset($result)) {echo $result['kr_name'];} ?>">
														</div>
													</div>
													<br/>
													<br/>
													<div class="form-group">
														<label class="col-md-3 control-label">Монгол нэр : <span class="text-danger">*</span></label>
														<div class="col-md-9">
															<input type="text" name="mn_name" class="form-control" placeholder="Монгол" value="<?php if (isset($result)) {echo $result['mn_name'];} ?>">
														</div>
													</div>
													<br/>
													<br/>
													<div class="form-group">
														<label class="col-md-3 control-label">Түвшин :</label>
														<div class="col-md-9">
															<select class="form-control" name="levelid">
																<?php
																$getData = $book->getLevel();
																if ($getData != false) {
																	while ($row = $getData->fetch_assoc()) {
																		?>
																		<option value="<?php echo $row['id']; ?>"><?php echo $row['kr_name'].' - '.$fm->ucfirst($row['mn_name']); ?></option>
																	<?php } ?>
																<?php } ?>
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="form-actions pull-right">
												<a href="books.php" class="btn default">Буцах</a>
												<button type="submit" name="add" class="btn green">
													<i class="fa fa-plus"></i> Нэмэх
												</button>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
						<!-- END SAMPLE FORM PORTLET-->
					</div>
				</div>
			</div>
			<?php include_once($filepath.'/../inc/footer.php'); ?>
			<!-- END CONTAINER -->
		</div>
		<!-- BEGIN QUICK SIDEBAR -->
		<?php include_once($filepath.'/../inc/sidebar.php'); ?>
		<!-- END QUICK SIDEBAR -->
		<!-- BEGIN QUICK NAV -->
		<div class="quick-nav-overlay"></div>
	</div>
	<?php include_once($filepath.'/../inc/foot.php'); ?>
</body>
</html>