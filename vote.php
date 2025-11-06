<?php
include ('head.php');
include ("sess.php"); // Assuming this manages sessions and security checks
include ('dbconn.php'); // Ensure database connection is properly initialized

function displayCandidates($position, $conn)
{
	$position = explode(" ", $position);
		if (count($position) == 2) {
			$position2 = $position[0] . '_' . $position[1];
		} else {
			$position2 = $position[0];
		}
		$position = $position2;
	// Prepared statement to avoid SQL injection
	$stmt = $conn->prepare("SELECT * FROM candidate WHERE position = ?");
	$stmt->bind_param("s", $position);
	$stmt->execute();
	$result = $stmt->get_result();

	while ($fetch = $result->fetch_assoc()) {
		// Proper escaping to prevent XSS
		echo '<div class="candidate-display">';
		echo '<img src="admin/' . htmlspecialchars($fetch['img']) . '" style="border-radius:6px;" height="150px" width="150px" class="img">';
		echo '<center><button type="button" class="btn btn-primary btn-xs" style="border-radius:60px;margin-top:4px;" >' . htmlspecialchars($fetch['firstname']) . " " . htmlspecialchars($fetch['lastname']) . '</button></center>';
		echo '<center><input type="checkbox" value="' . htmlspecialchars($fetch['candidate_id']) . '" name="' . $position . '" class="' . $position . '"></center>';
		echo '</div>';
	}
	$stmt->close();
}

function getPositions($conn)
{
	$positions = array();
	$query = "SELECT DISTINCT position FROM candidate";
	$result = $conn->query($query);
	while ($row = $result->fetch_assoc()) {
		
		$position = explode("_", $row['position']);
		if (count($position) == 2) {
			$position2 = $position[0] . ' ' . $position[1];
		} else {
			$position2 = $position[0];
		}
		$positions[] = $position2;
	}
	return $positions;
}

?>

<body>
	<div id="wrapper">
		<?php include ('side_bar.php'); ?>
	</div>
	<center>
		<form method="POST" action="vote_result.php">

			<?php
			$positions = getPositions($conn); // Fetch distinct positions from the database
			// print_r($positions);
			foreach ($positions as $position) {
				echo '<div class="col-lg-6">';
				echo '<div class="panel panel-primary">';
				echo '<div class="panel-heading"><center>' . htmlspecialchars($position) . '</center></div>';
				echo '<div class="panel-body" style="display: flex;
				background-color: antiquewhite;
				gap: 20px;
				flex-wrap: wrap;">';
				displayCandidates($position, $conn); // Display candidates for each fetched position
				echo '</div></div></div>';
			}
			?>
	</center>
	<center><button class="btn btn-success ballot" type="submit" name="submit">Submit Your Votes</button></center>
	</form>

	<?php include ('script.php'); ?>
	<script>
		$(document).ready(function () {
			$('input[type="checkbox"]').on("change", function () {
				var className = $(this).attr('class');
				if ($('.' + className + ':checked').length == 1) {
					$('.' + className).attr("disabled", "disabled");
					$('.' + className + ':checked').removeAttr("disabled");
				} else {
					$('.' + className).removeAttr("disabled");
				}
			});
		});
	</script>

</body>

</html>