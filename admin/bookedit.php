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
					<li>Ном шинэчилэх</li>
				</ul>
				<!-- END BREADCRUMBS -->
			</div>

			<div class="page-sidebar-wrapper">
				<!-- BEGIN SIDEBAR -->
				<?php include_once($filepath.'/../inc/header_menu.php'); ?>
				<!-- END SIDEBAR -->
			</div>
			<?php
			$kr_name = '';
			$mn_name = '';
			if (isset($_GET['bookid']) && $_GET['bookid'] != NULL) {
				$number = $_GET['bookid'];
				$getData = $book->getBookView($number);
				if ($getData != false) {
					if ($row = $getData->fetch_assoc()) {
						$image = $row['image'];
						$kr_name = $row['kr_name'];
						$mn_name = $row['mn_name'];
						$levelid = $row['level_id'];
					}
				} else {
					header("Location: book-list.php");
				}
			} else {
				header("Location: book-list.php");
			}

			if (isset($_POST['zasah'])) {
				$result = $book->updateBook($_POST, $_FILES, $image, $number);
			}
			?>
			<div class="page-fixed-main-content">
				<?php if (isset($result)) {echo $result['msg'];} ?>
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN SAMPLE FORM PORTLET-->
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
														<img src="../<?php if(isset($result)){echo $result['image'];} else if (trim(isset($image) != '')) {echo $image;} ?>" alt="" />
													</div>
													<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
													<div>
														<span class="btn default btn-file">
															<span class="fileinput-new"> Зураг сонгох </span>
															<span class="fileinput-exists"> Солих </span>
															<input type="file" name="eimage">
														</span>
														<a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-9">
											<div class="form-group">
												<label class="col-md-3 control-label">Солонгос нэр :</label>
												<div class="col-md-9">
													<input type="text" name="ekr_name" class="form-control" placeholder="몽골" value="<?php if (isset($kr_name)) {echo $kr_name;} ?>" >
												</div>
											</div>
											<br/>
											<br/>
											<div class="form-group">
												<label class="col-md-3 control-label">Монгол нэр :</label>
												<div class="col-md-9">
													<input type="text" name="emn_name" class="form-control" placeholder="Монгол" value="<?php if (isset($mn_name)) {echo $mn_name;} ?>" >
												</div>
											</div>
											<br/>
											<br/>
											<div class="form-group">
												<label class="col-md-3 control-label">Түвшин :</label>
												<div class="col-md-9">
													<select class="form-control" name="elevelid">
														<?php
														$getData = $book->getLevel();
														if ($getData != false) {
															while ($row = $getData->fetch_assoc()) {
																?>
																<option value="<?php echo $row['id']; ?>" <?php if($row['id'] == $levelid){echo 'selected';} ?>><?php echo $row['kr_name'].' ~ '.$fm->ucfirst($row['mn_name']); ?></option>
															<?php } ?>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="form-actions pull-right">
										<a href="books.php" class="btn default">Буцах</a>
										<button type="submit" name="zasah" class="btn green">Засах</button>
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