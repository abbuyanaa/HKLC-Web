<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/classes/Topic.php');
$topic = new Topic();
if (!empty($_POST['bookid'])) {
	$getTopic = $topic->getBookTopics($_POST['bookid']); ?>
	<thead>
		<tr>
			<th>No.</th>
			<th>Солонгос нэр</th>
			<th>Монгол нэр</th>
			<th>Үйлдэл</th>
		</tr>
	</thead>
	<?php
	if ($getTopic != false) { $i=1;
		while ($row = $getTopic->fetch_assoc()) { ?>
			<tbody>
				<tr>
					<td><?php echo $i++; ?></td>
					<td><?php echo $row['kr_name']; ?></td>
					<td><?php echo $row['mn_name']; ?></td>
					<td>
						<a href="bookedit.php?bookid=<?php echo $row['id']; ?>" class="btn btn-outline btn-circle btn-sm purple">
							<i class="fa fa-edit"></i> Edit
						</a>
						<a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm black">
							<i class="fa fa-trash-o"></i> Delete
						</a>
					</td>
				</tr>
			</tbody>
			<?php
		}
	}
} else {
	echo '<option>Мэдээлэл</option>';
}
?>
