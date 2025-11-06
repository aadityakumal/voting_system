<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<center>Add Candidate</center>
						</div>
					</div>
				</h4>
			</div>


			<div class="modal-body">
				<form method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="position">Position</label>

						<input class="form-control" type="text" name="position" placeholder="enter position"
							required="true">
					</div>


					<div class="form-group">
						<label>Firstname</label>
						<input class="form-control" type="text" name="firstname" placeholder="Please enter firstname"
							required="true">
					</div>
					<div class="form-group">
						<label>Lastname</label>
						<input class="form-control" type="text" name="lastname" placeholder="Please enter lastname"
							required="true">
					</div>



					<div class="form-group">
						<label>Gender</label>
						<select class="form-control" name="gender">
							<!-- <option selected disabled>select gender</option> -->
							<option>Male</option>
							<option>Female</option>
							<option>Other</option>
							<!-- <option>other</option> -->
						</select>
					</div>


					<div class="form-group">
						<label>Image</label>
						<input type="file" name="image" required>
					</div>
					<button name="save" type="submit" class="btn btn-primary">Save Data</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>


			<?php
			require_once 'dbcon.php';

			if (isset($_POST['save'])) {
				$position = $_POST['position'];
				$position = explode(' ', $position);
				$position2 = $position[0] . '_' . $position[1];
				$firstname = $_POST['firstname'];
				$lastname = $_POST['lastname'];
				$gender = $_POST['gender'];
				$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
				$image_name = addslashes($_FILES['image']['name']);
				$image_size = getimagesize($_FILES['image']['tmp_name']);

				move_uploaded_file($_FILES["image"]["tmp_name"], "upload/" . $_FILES["image"]["name"]);
				$location = "upload/" . $_FILES["image"]["name"];


				$ins = $conn->query("INSERT INTO candidate(position,firstname,lastname,gender,img)values('$position2','$firstname','$lastname','$gender','$location')") or die(mysqli_error($conn));
							
				header("location: ?success=true");

			}
			?>
		</div>
	</div>
</div>