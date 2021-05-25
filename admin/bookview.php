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
					<li>Номын дэлгэрэнгүй</li>
				</ul>
				<!-- END BREADCRUMBS -->
			</div>

			<div class="page-sidebar-wrapper">
				<!-- BEGIN SIDEBAR -->
				<?php include_once($filepath.'/../inc/header_menu.php'); ?>
				<!-- END SIDEBAR -->
			</div>
			<?php
			if (isset($_GET['bookid']) && $_GET['bookid'] != NULL) {
				$bookid = $_GET['bookid'];
				$getBookData = $book->getBookView($bookid);
				if ($getBookData != false) {
					if ($row = $getBookData->fetch_assoc()) {
						$image = $row['image'];
						$kr_name = $row['kr_name'];
						$mn_name = $row['mn_name'];
						$lkr_name = $row['lkr_name'];
						$lmn_name = $row['lmn_name'];
					}
				} else {
					header("Location: book-list.php");
				}
			} else {
				header("Location: book-list.php");
			}

			?>
			<div class="page-fixed-main-content">
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN SAMPLE FORM PORTLET-->
						<div class="portlet light bordered">
							<div class="portlet-title">
								<div class="caption">
									<!-- <i class="icon-settings font-red-sunglo"></i> -->
									<span class="caption-subject font-blue-sharp bold uppercase"> Номны мэдээлэл</span>
								</div>
							</div>
							<form action="" method="post" enctype="multipart/form-data">
								<div class="portlet-body form">
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<div class="fileinput fileinput-new" data-provides="fileinput">
													<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
														<img src="../<?php echo $image; ?>" alt="" />
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-9">
											<div class="form-group">
												<label class="col-md-3 control-label">Солонгос :</label>
												<div class="col-md-9">
													<input type="text" class="form-control" placeholder="몽골" value="<?php echo $kr_name; ?>" readonly>
												</div>
											</div>
											<br/>
											<br/>
											<div class="form-group">
												<label class="col-md-3 control-label">Монгол :</label>
												<div class="col-md-9">
													<input type="text" class="form-control" placeholder="Монгол" value="<?php echo $mn_name; ?>" readonly>
												</div>
											</div>
											<br/>
											<br/>
											<div class="form-group">
												<label class="col-md-3 control-label">Түвшин :</label>
												<div class="col-md-9">
													<input type="text" class="form-control" placeholder="Монгол" value="<?php echo $lkr_name.' ~ '.$lmn_name; ?>" readonly>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
						<!-- END SAMPLE FORM PORTLET-->
					</div>
				</div>

				<?php
				if (isset($_GET['bookid']) && isset($_GET['topicid']) && $_GET['topicid'] != NULL) {
					$topicid = $_GET['topicid'];
					$getTopicData = $topic->getBookTopicEdit($topicid);
					if ($getTopicData != false) {
						if ($trow = $getTopicData->fetch_assoc()) {
							$tkr_name = $trow['kr_name'];
							$tmn_name = $trow['mn_name'];
						}
					} else {
						header('Location: book-list.php');
					}
				}

				if (isset($_GET['bookid']) && isset($_GET['delid'])) {
					$msg = $topic->deleteTopic($bookid, $_GET['delid']);
				}
				if (isset($_POST['nemeh'])) {
					$msg = $topic->insertTopic($bookid, $_POST);
				}
				if (isset($_POST['zasah'])) {
					$msg = $topic->updateTopic($topicid, $_POST);
				}
				?>
				<?php if (isset($msg)) { echo $msg['msg']; } ?>
				<!-- <div class="alert alert-success">asdf</div> -->

				<?php if (!isset($topicid)) { ?>
					<div class="portlet light bordered">
						<div class="portlet-title">
							<div class="caption">
								<!-- <i class="icon-settings font-red-sunglo"></i> -->
								<span class="caption-subject font-blue-sharp bold uppercase"> Сэдэв Нэмэх</span>
							</div>
						</div>
						<form action="" method="post" enctype="multipart/form-data">
							<div class="portlet-body form">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="col-md-2 control-label">Солонгос : <span class="text-danger">*</span></label>
											<div class="col-md-8">
												<input type="text" name="kr_name" class="form-control" placeholder="가족">
											</div>
										</div>
										<br/>
										<br/>
										<div class="form-group">
											<label class="col-md-2 control-label">Монгол :</label>
											<div class="col-md-8">
												<input type="text" name="mn_name" class="form-control" placeholder="Гэр бүл">
											</div>
											<div class="col-md-1">
												<button type="submit" name="nemeh" class="btn green">Нэмэх</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				<?php } else { ?>
					<div class="portlet light bordered">
						<div class="portlet-title">
							<div class="caption">
								<!-- <i class="icon-settings font-red-sunglo"></i> -->
								<span class="caption-subject font-blue-sharp bold uppercase"> Сэдэв засах</span>
							</div>
						</div>
						<form action="" method="post" enctype="multipart/form-data">
							<div class="portlet-body form">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="col-md-2 control-label">Солонгос : <span class="text-danger">*</span></label>
											<div class="col-md-8">
												<input type="text" name="ekr_name" class="form-control" placeholder="가족" value="<?php if (isset($tkr_name)) {echo $tkr_name;} ?>">
											</div>
											<div class="col-md-1">
												<a href="bookview.php?bookid=<?php echo $bookid; ?>" class="btn green">Refresh</a>
											</div>
										</div>
										<br/>
										<br/>
										<div class="form-group">
											<label class="col-md-2 control-label">Монгол :</label>
											<div class="col-md-8">
												<input type="text" name="emn_name" class="form-control" placeholder="Гэр бүл" value="<?php if (isset($tmn_name)) {echo $tmn_name;} ?>">
											</div>
											<div class="col-md-1">
												<button type="submit" name="zasah" class="btn green">Засах</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				<?php } ?>

				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-comments"></i>Номны сэдвийн жагсаалт
								</div>
							</div>
							<div class="portlet-body">
								<div class="table-scrollable">
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th width="10%" style="text-align: center;">No.</th>
												<th width="25%" style="text-align: center;">Солонгос</th>
												<th width="25%" style="text-align: center;">Монгол</th>
												<th width="5%" style="text-align: center;">Нийт үг</th>
												<th width="20%" style="text-align: center;">Үйлдэл</th>
											</tr>
										</thead>
										<!-- active, success, warning, danger -->
										<tbody>
											<?php
											$getData = $topic->getBookViewTopics($bookid);
											if ($getData != false) { $i=1;
												while ($row = $getData->fetch_assoc()) {
													?>
													<tr>
														<td><?php echo $i++; ?></td>
														<td><?php echo $row['kr_name']; ?></td>
														<td><?php echo $fm->ucfirst($row['mn_name']); ?></td>
														<td style="text-align: center;"><?php echo $row['word_count']; ?></td>
														<td style="text-align: center;">
															<a href="bookview.php?bookid=<?php echo $bookid.'&topicid='.$row['id'] ;?>" class="btn btn-outline btn-circle yellow btn-sm"><i class="fa fa-edit"></i> Edit </a>
															<a href="bookview.php?bookid=<?php echo $bookid.'&delid='.$row['id'] ;?>" class="btn btn-outline btn-circle red btn-sm" onclick="return confirm('Та энэ сэдвийг устгахдаа итгэлтэй байна уу?');"><i class="fa fa-trash-o"></i> Delete </a>
														</td>
													</tr>
												<?php } ?>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
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