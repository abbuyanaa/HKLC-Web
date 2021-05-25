<!DOCTYPE html>
<html lang="en">
<head>
	<?php
	$filepath = realpath(dirname(__FILE__));
	include($filepath.'/inc/head.php');
	?>
</head>
<body>

	<!-- BEGIN HEADER -->
	<?php include($filepath.'/inc/header.php'); ?>
	<!-- END HEADER -->

	<!-- BEGIN CONTAINER -->
	<div class="container-fluid">
		<div class="page-content page-content-popup">

			<div class="page-content-fixed-header">
				<!-- BEGIN BREADCRUMBS -->
				<ul class="page-breadcrumb">
					<li><a href="index.php">Нүүр хуудас</a></li>
					<li>Сурагчид</li>
				</ul>
				<!-- END BREADCRUMBS -->
			</div>

			<div class="page-sidebar-wrapper">
				<!-- BEGIN SIDEBAR -->
				<?php include($filepath.'/../inc/header_menu.php'); ?>
				<!-- END SIDEBAR -->
			</div>
			<div class="page-fixed-main-content">
				<?php
				if (isset($_GET['uid']) && isset($_GET['status'])) {
					$uid = $_GET['uid'];
					$status = $_GET['status'];
					$result = $user->userStatus($uid, $status);
				}
				if (isset($result)) {
					echo $result;
					header('Location: users.php');
				}
				?>
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN SAMPLE TABLE PORTLET-->
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-users"></i>Сурагчид
								</div>
							</div>
							<div class="portlet-body">
								<div class="table-scrollable">
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th width="5%" style="text-align: center;">No.</th>
												<th width="20%" style="text-align: center;">Нэр</th>
												<th width="20%" style="text-align: center;">Овог нэр</th>
												<th width="15%" style="text-align: center;">Цахим хаяг</th>
												<th width="15%" style="text-align: center;">Утас</th>
												<th width="30%" style="text-align: center;">Үйлдэл</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$getUsers = $user->getAllUsers();
											if ($getUsers != false) { $i=1;
												while ($row = $getUsers->fetch_assoc()) {
													?>
													<tr>
														<td><?php echo $i++; ?></td>
														<td><?php echo $fm->ucfirst($row['first_name']); ?></td>
														<td><?php echo $fm->ucfirst($row['last_name']); ?></td>
														<td><?php echo $row['email']; ?></td>
														<td><?php echo $row['phone']; ?></td>
														<td style="text-align: center;">
															<?php if ($row['status'] == 1) { ?>
																<a href="users.php?uid=<?php echo $row['id'].'&status=0'; ?>" class="btn btn-outline btn-circle btn-sm blue">
																	<i class="fa fa-eye"></i> Идэвхитэй
																</a>
															<?php } else { ?>
																<a href="users.php?uid=<?php echo $row['id'].'&status=1'; ?>" class="btn btn-outline btn-circle btn-sm red">
																	<i class="fa fa-eye-slash"></i> Идэвхигүй
																</a>
															<?php } ?>
															<!-- <a href="" class="btn btn-outline btn-circle btn-sm purple"><i class="fa fa-edit"></i> Edit </a>
															<a href="" class="btn btn-outline btn-circle dark btn-sm black"><i class="fa fa-trash-o"></i> Delete </a>
															<a href="" class="btn btn-outline btn-circle green btn-sm purple"><i class="fa fa-edit"></i> Edit </a> -->
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
			<?php include($filepath.'/../inc/footer.php'); ?>
			<!-- END FOOTER -->
			<!-- END CONTAINER -->
			<!-- BEGIN QUICK SIDEBAR -->
			<?php include($filepath.'/../inc/sidebar.php'); ?>
			<!-- END QUICK SIDEBAR -->
			<!-- BEGIN QUICK NAV -->
			<div class="quick-nav-overlay"></div>
		</div>
	</div>
	<!-- END QUICK NAV -->
	<?php include($filepath.'/../inc/foot.php'); ?>
</body>
</html>