<?php //session_start(); 
?>
<?php include ('head.php'); ?>
<?php include ('sess.php'); ?>

<body>

	<div id="row">
		<?php
		include ('side_bar.php');
		if (isset($_POST['submit'])) {
			// print_r($_POST);
			$candidateList = $_POST;
			$x = 0;
			// print_r($candidateList);
			foreach ($candidateList as $position => $id) {
				$ids[$x] = $id;
				// echo $id;
				$x++;
			}
			array_pop($ids);
			$_SESSION['cids'] = $ids;
			// print_r($_SESSION['cids']);
		}
		?>
	</div>
	<center>
		<div class="col-lg-8" style="margin-left:240px;">
			<?php
			array_pop($candidateList);
			// $x = 0;
			foreach ($candidateList as $position => $id) {
				$ids[$x] = $id;
				$_SESSION['id'] = $id;
				// echo $_SESSION['id'];
				// print_r($_SESSION['id']);
				$position = explode("_", $position);
				if (count($position) == 2) {
					$position2 = $position[0] . ' ' . $position[1];
				} else {
					$position2 = $position[0];
				}
				// $positions[] = $position2;
				?>
				<div class="alert alert-info">
					<label><?php echo $position2; ?></label>
					<br />
					<?php
					if (!$id) {
					} else {
						$fetch = $conn->query("SELECT * FROM `candidate` WHERE `candidate_id` = '$id'")->fetch_array();
						echo "<img src = 'admin/" . $fetch['img'] . "' style = 'height:80px; width:80px; border-radius:500px;' /> <br>" . $fetch['firstname'] . " " . $fetch['lastname'] . " ";
					}
					?>
				</div>
				<?php
			}
			?>
			<br />
			<button type="submit" data-toggle="modal" data-target="#result" class="btn btn-success">Submit Final
				Vote</button>
		</div>
	</center>
	<div class="modal fade" id="result" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">

					</h4>
				</div>


				<div class="modal-body">
					<p class="alert alert-danger">Are you sure you want to submit your Votes? </p>
				</div>

				<div class="modal-footer">
					<a href="submit_vote.php"><button type="submit" class="btn btn-success"><i
								class="icon-check"></i>&nbsp;Yes</button></a>
					<a href="vote.php"><button class="btn btn-danger" aria-hidden="true"><i
								class="icon-remove icon-large"></i>&nbsp;Back</button></a>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
</body>
<?php include ('script.php') ?>

</html>