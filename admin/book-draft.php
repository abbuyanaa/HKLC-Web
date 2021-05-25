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
					<li>Номын жагсаалт</li>
				</ul>
				<!-- END BREADCRUMBS -->
			</div>

			<div class="page-sidebar-wrapper">
				<!-- BEGIN SIDEBAR -->
				<?php include_once($filepath.'/../inc/header_menu.php'); ?>
				<!-- END SIDEBAR -->
			</div>
			<?php
			if (isset($_GET['delid']) && $_GET['delid'] != NULL) {
				$delid = $_GET['delid'];
				$check = $book->getBookView($delid);
				if ($check != false) {
					$result = $book->deleteBook($delid);
				} else {
					header("Location: books.php");
				}
			}

			if (isset($_POST['search'])) {
				$find_text = $_POST['text'];
				$getBooks = $book->getAllBooks($find_text);
			} else {
				$getBooks = $book->getAllBooks("");
			}
			?>
			<div class="page-fixed-main-content">
				<?php if (isset($result)) { echo $result; } ?>
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
										<a href="books.php" class="btn blue">Жагсаалт</a>
									</td>
								</tr>
							</table>
						</form>
						<!-- END SAMPLE TABLE PORTLET-->

						<!-- BEGIN SAMPLE TABLE PORTLET-->
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-book"></i>Номны жагсаалт
								</div>
								<div class="actions">
									<a href="bookadd.php" class="btn btn-outline white btn-circle btn-sm">
										<i class="fa fa-plus"></i> Нэмэх
									</a>
								</div>
							</div>
							<div class="portlet-body">
								<div class="table-scrollable">
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th style="text-align: center;" width="5%">No.</th>
												<th style="text-align: center;" width="10%">Зураг</th>
												<th style="text-align: center;" width="25%">Солонгос нэр</th>
												<th style="text-align: center;" width="25%">Монгол нэр</th>
												<th style="text-align: center;" width="20%">Үйлдэл</th>
											</tr>
										</thead>
										<tbody>
											<?php
											if ($getBooks) { $i=1;
												while ($row = $getBooks->fetch_assoc()) {
													?>
													<!-- active, success, warning, danger -->
													<tr>
														<td align="center"><?php echo $i++; ?></td>
														<td align="center"><img src="../<?php if($row['image'] == ''){echo 'images/files/no_image_available.jpg';} else {echo $row['image'];} ?>" alt="" width="80px"></td>
														<td><?php echo $fm->ucfirst($row['kr_name']); ?></td>
														<td><?php echo $fm->ucfirst($row['mn_name']); ?></td>
														<td align="center">
															<a href="bookedit.php?bookid=<?php echo $row['id']; ?>" class="btn btn-outline btn-circle btn-sm yellow">
																<i class="fa fa-edit"></i> Засах
															</a>
															<!-- <a href="" class="btn btn-outline btn-circle btn-sm red" onclick="return confirm('Энэ номыг устгахдаа итгэлтэй байна уу?');">
																<i class="fa fa-trash-o"></i> Устгах
															</a> -->
															<a href="bookview.php?bookid=<?php echo $row['id']; ?>" class="btn btn-outline btn-circle btn-sm green">
																<i class="fa fa-trash-o"></i> Үзэх
															</a>
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
		<!-- END CONTAINER -->
		<!-- BEGIN QUICK SIDEBAR -->
		<?php include_once($filepath.'/../inc/sidebar.php'); ?>
		<!-- END QUICK SIDEBAR -->
		<!-- BEGIN QUICK NAV -->
		<div class="quick-nav-overlay"></div>
	</div>
	<!-- END QUICK NAV -->
	<?php include_once($filepath.'/../inc/foot.php'); ?>
</body>
</html>