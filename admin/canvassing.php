<?php include ('session.php'); ?>
<?php include ('head.php'); ?>

<style>
	/* General table styles */
	.results-table {
		width: 100%;
		border-collapse: collapse;
		margin: 20px 0;
	}

	.results-table th,
	.results-table td {
		padding: 10px;
		text-align: center;
		border-bottom: 1px solid #ddd;
		/* Light gray border */
		border-right: 2px solid #f0f0f0;
		border-left: 2px solid #f0f0f0;
		/* Light gray vertical border */
	}

	.results-table th:last-child,
	.results-table td:last-child {
		border-right: 2px solid #f0f0f0;
		/* Remove right border for the last column */
	}

	.results-table th {
		background-color: #4CAF50;
		/* Green background for headers */
		color: white;
		border-right: 2px solid #ffffff;
		/* White border for headers for better visibility */
	}

	.results-table tr:hover {
		background-color: #f5f5f5;
	}

	/* Light gray row hover */

	/* Image styling */
	.candidate-img {
		width: 40px;
		height: 40px;
		border-radius: 50%;
		/* Circular images */
		border: 2px solid #ddd;
		/* Light gray border around the image */
	}

	/* Column specific styling */
	.position-col {
		width: 20%;

	}

	.name-col {
		width: 40%;
	}

	.votes-col {
		width: 20%;

	}
</style>



<body>

	<div id="wrapper">

		<!-- Navigation -->
		<?php include ('side_bar.php'); ?>

		<!-- Page Content -->
		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">


				</div>

				<hr />

				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="alert alert-success">Final Result</h4>

						<center>
							<h4 style="font-weight: bold;">Leading Candidates:</h4>
						</center>

						<table class="results-table">

							<thead>

								<tr>
									<th class="position-col">Position</th>
									<th class="name-col">Candidate Name</th>
									<th>Image</th>
									<th class="votes-col">Total Votes</th>
								</tr>
							</thead>
							<tbody>
								<?php
								// Your existing PHP code here to fetch and display rows
								
								require 'dbcon.php';

								// SQL query to fetch the leading candidate per position based on the highest vote count
								$sql = "SELECT c.position, c.firstname, c.lastname, c.img, v.total_votes FROM candidate c
               				INNER JOIN (
           					 SELECT candidate_id, COUNT(*) as total_votes
           					 FROM votes
         					GROUP BY candidate_id
       						) v ON c.candidate_id = v.candidate_id
        					INNER JOIN (
           					 SELECT position, MAX(total_votes) as max_votes
                             FROM candidate
                              JOIN (
                             SELECT candidate_id, COUNT(*) as total_votes
                             FROM votes
                             GROUP BY candidate_id
                            ) vote_counts ON candidate.candidate_id = vote_counts.candidate_id
                             GROUP BY position
                             ) max_votes ON c.position = max_votes.position AND v.total_votes = max_votes.max_votes
                             ORDER BY c.position";

								$result = $conn->query($sql);

								while ($row = $result->fetch_assoc()) {
									$position = explode("_",$row['position']);
                                            if(count($position) == 2) {
                                            $position2 = $position[0] . ' '. $position[1];
                                            }else{
                                                $position2 = $position[0];
                                            }
									?>
									<tr>
										<td><?php echo $position2; ?></td>
										<td><?php echo htmlspecialchars($row['firstname']) . ' ' . htmlspecialchars($row['lastname']); ?>
										</td>
										<td style="text-align: center;">
											<img src="<?php echo htmlspecialchars($row['img']); ?>"
												style="width:40px; height:40px; border-radius:500px;">
										</td>
										<td style="text-align: center;"><?php echo $row['total_votes']; ?></td>
									</tr>
									<?php
								}
								?>

							</tbody>
						</table>

					</div>


					&nbsp;
					&nbsp;

					<div class="panel-body">
						<center>
							<h4 style="font-weight: bold;">Total Number of Votes:</h4>
						</center>

						<table class="table table-striped table-bordered table-hover ">
							<thead>
								<td style="width:500px;" class="alert alert-success">Candidate List</td>

								<td style="width:150px;" class="alert alert-success">Position</td>
								<td style="width:75px;" class="alert alert-success">Image</td>
								<td style="width:100px;" class="alert alert-success">Total Votes</td>

							</thead>
							<?php
							require 'dbcon.php';

							$query = $conn->query("SELECT * FROM candidate");
							while ($fetch = $query->fetch_array()) {
								$id = $fetch['candidate_id'];
								$query1 = $conn->query("SELECT COUNT(*) as total FROM `votes` WHERE candidate_id = '$id'");
								$fetch1 = $query1->fetch_assoc();

								$position = explode("_",$fetch['position']);
                                            if(count($position) == 2) {
                                            $position2 = $position[0] . ' '. $position[1];
                                            }else{
                                                $position2 = $position[0];
                                            }

								?>
								<tbody>
									<td><?php echo $fetch['firstname'] . " " . $fetch['lastname']; ?></td>
									<td><?php echo $position2 ?></td>
									<td style="text-align: center;"><img src="<?php echo $fetch['img']; ?>"
											style="width:40px; height:40px; border-radius:500px; ">
									<td style="width:20px; text-align:center"><button class="btn btn-primary"
											disabled><?php echo $fetch1['total']; ?></button> </td>
								<?php } ?>
							</tbody>
					</div>
				</div>
				<!-- /.table-responsive -->

			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->

	</div>
	<!-- /.row -->
	</div>
	<!-- /#page-wrapper -->



	</div>
	<!-- /#wrapper -->

	<?php include ('script.php'); ?>

</body>

</html>