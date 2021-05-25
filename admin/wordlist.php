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
					<li><a href="index.php">Нүүр хуудас</a></li>
					<li>Үгсийн сан</li>
				</ul>
				<!-- END BREADCRUMBS -->
			</div>

			<div class="page-sidebar-wrapper">
				<!-- BEGIN SIDEBAR -->
				<?php include_once($filepath.'/../inc/header_menu.php'); ?>
				<!-- END SIDEBAR -->
			</div>
			<?php
			if (isset($_POST['search'])) {
				$find_text = $_POST['text'];
				$getWords = $word->getSelectWord($find_text);
			} else {
				$getWords = $word->getSelectWord("");
			}
			?>
			<div class="page-fixed-main-content">
				<div class="row">
					<div class="col-md-12">

						<!-- BEGIN SAMPLE TABLE PORTLET-->
						<form role="form" action="" method="post">
							<table class="table">
								<tr>
									<td>
										<div class="form-group">
											<input type="text" name="text" class="form-control" placeholder="Хайх үгээ оруулна уу!" value="<?php if (isset($find_text)) {echo $find_text;} ?>">
										</div>
									</td>
									<td width="5%">
										<button type="submit" name="search" class="btn blue">
											<i class="fa fa-search"></i> Хайх 
										</button>
									</td>
									<td width="5%">
										<a href="wordlist.php" class="btn blue">Жагсаалт</a>
									</td>
								</tr>
							</table>
						</form>
						<!-- END SAMPLE TABLE PORTLET-->
						<?php
						// if (isset($_GET['delid']) && $_GET['delid'] != NULL) {
						// 	$result = $word->deleteWord($_GET['delid']);
						// }
						// if (isset($result)) {
						// 	if ($result['msg'] == 'false') {
						// 		header("Location: wordlist.php");
						// 	} else {
						// 		echo $result['msg'];
						// 		header("Refresh:1; url=wordlist.php");
						// 	}
						// }
						// if (isset($_POST['delete'])) {
						// 	$wordcount = $_POST['wordid'];
						// 	foreach ($wordcount as $key => $value) {
						// 		$result = $word->deleteWord($value);
						// 	}
						// 	echo '<div class="alert alert-success">Мэдээлэл амжилттай устгагдлаа.</div>';
						// 	header("Refresh:1; url=wordlist.php");
						// }
						?>
						<!-- BEGIN SAMPLE TABLE PORTLET-->
						<form action="" method="post">
							<div class="portlet box blue">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-comments"></i>Үгсийн сан
									</div>
									<div class="actions">
										<a href="wordnemeh.php" class="btn btn-outline white btn-circle btn-sm">
											<i class="fa fa-plus"></i> Нэмэх
										</a>
										<button type="submit" name="delete" class="btn btn-outline btn-circle btn-sm red" onclick="return confirm('Та сонгосон мэдээллээ устгахдаа итгэлтэй байна уу?')">
											<i class="fa fa-trash-o"></i> Устгах
										</button>
									</div>
								</div>

								<div class="portlet-body">
									<div class="table-scrollable">
										<table class="table table-bordered table-hover">
											<thead>
												<tr>
													<th style="text-align: center;" width="2%">
														<label class="mt-checkbox">
															<input type="checkbox" id="selectallboxes" />
															<span></span>
														</label>
													</th>
													<th style="text-align: center;" width="20%">Ном / Сэдэв</th>
													<th style="text-align: center;" width="20%">Солонгос & Монгол үг</th>
													<th style="text-align: center;" width="10%">Үгсийн аймаг</th>
													<th style="text-align: center;" width="15%">Үйлдэл</th>
												</tr>
											</thead>
											<tbody>
												<?php
												if ($getWords != false) { $word_row=1;
													while ($row = $getWords->fetch_assoc()) {
														?>
														<tr>
															<td rowspan="2" align="center">
																<label class="mt-checkbox">
																	<input type="checkbox" value="<?php echo $row['wordid'] ?>" name="wordid[]" class="checkboxes" />
																	<span></span>
																</label>
															</td>
															<td><?php echo $row['bkr_name']; ?></td>
															<td style="text-align: center;">
																<?php echo $row['kr_w'].' ~ '.$row['mn_w']; ?>
															</td>
															<td rowspan="2" style="text-align: center;">
																<?php if ($row['ai_name'] == '') { ?>
																	Бусад
																<?php } else { echo $row['ai_name'];} ?>
															</td>
															<td rowspan="2" style="text-align: center;">
																<a href="wordzasah.php?edit=<?php echo $row['wordid']; ?>" class="btn btn-outline btn-circle btn-sm yellow"><i class="fa fa-edit"></i> Засах </a>
															</td>
														</tr>
														<tr>
															<td><?php echo $row['tkr_name']; ?></td>
															<td align="center"><?php echo $row['blkr_name']; ?></td>
														</tr>
													<?php } ?>
												<?php } else { ?>
													<tr>
														<td colspan="5" align="center">Үгсийн сан байхгүй!</td>
													</tr>
												<?php } ?>
											</tbody>
										</table>
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
	<script type="text/javascript">
		$(document).ready(function(){
			$('#selectallboxes').click(function(event){
				if (this.checked) {
					$('.checkboxes').each(function(){
						this.checked = true;
					});
				} else {
					$('.checkboxes').each(function(){
						this.checked = false;
					});
				}
			});
		});
	</script>
	<?php include_once($filepath.'/../inc/foot.php'); ?>
</body>
</html>