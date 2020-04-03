<?php
	ob_start();
	session_start();
	$pageTitle = 'Create New Item';
	include 'init.php';
	if (isset($_SESSION['user'])) {

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if (isset($_POST['newad']))
			{
			echo "<h1 class='text-center'>Insert Item</h1>";
			echo "<div class='container'>";

			// Get Variables From The Form
			//image
				$images=$_FILES['profile']['name'];
				$tmp_dir=$_FILES['profile']['tmp_name'];
				$imageSize=$_FILES['profile']['size'];
				$upload_dir='admin/uploads/';
				$imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
				$valid_extensions=array('jpeg', 'jpg', 'png', 'gif', 'pdf');
				$picProfile=rand(1000, 1000000).".".$imgExt;
				move_uploaded_file($tmp_dir, $upload_dir.$picProfile);

			//end image
			$name		= $_POST['name'];
	
			$price 		= $_POST['price'];
			$country 	= $_POST['country'];
			$status 	= $_POST['status'];
			$member 	= $_POST['member'];
			$cat 		= $_POST['category'];
		

			// Validate The Form

		
			// Check If There's No Error Proceed The Update Operation

			if (empty($formErrors)) {

				// Insert Userinfo In Database

				$stmt = $con->prepare("INSERT INTO 

					items(Name, Price, Country_Made, Status, Add_Date, Cat_ID, Member_ID,Image)

					VALUES(:zname,:zprice, :zcountry, :zstatus, now(), :zcat, :zmember,:upic)");
				$stmt->execute(array(

					'zname' 	=> $name,
					'zprice' 	=> $price,
					'zcountry' 	=> $country,
					'zstatus' 	=> $status,
					'zcat'		=> $cat,
					'zmember'	=> $_SESSION['uid'],
					':upic'     =>$picProfile
					

				));

				// Echo Success Message

				$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Inserted</div>';

				header('Location: profile.php#my-ads');

			}

		} else {

			echo "<div class='container'>";

			$theMsg = '<div class="alert alert-danger">Sorry You Cant Browse This Page Directly</div>';

			redirectHome($theMsg);

			echo "</div>";

		}

		echo "</div>";

	

	
	
	}	
				
		

?>
	<div style="text-align: center;
				font-style: inherit;
				font-weight: 800;
				margin-left: -212px;
				margin-bottom: 58px;
				padding-top: 47px;
				font-size: 30px;">
			New items
			</div>
			<div class="container">
				<form class="form-horizontal" action="newad.php" method="POST" enctype="multipart/form-data">
					<!-- Start Name Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Name</label>
						<div class="col-sm-10 col-md-6">
							<input 
								type="text" 
								name="name" 
								class="form-control" 
								required="required"  
								placeholder="Name of The Item" />
						</div>
					</div>
					<!-- End Name Field -->
					<!-- Start Price Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Price</label>
						<div class="col-sm-10 col-md-6">
							<input 
								type="text" 
								name="price" 
								class="form-control" 
								required="required" 
								placeholder="Price of The Item" />
						</div>
					</div>
					<!-- End Price Field -->
					<!-- Start Country Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Country</label>
						<div class="col-sm-10 col-md-6">
							<input 
								type="text" 
								name="country" 
								class="form-control" 
								required="required" 
								placeholder="Country of Made" />
						</div>
					</div>
					<!-- End Country Field -->
					<!-- Start Status Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Status</label>
						<div class="col-sm-10 col-md-6">
							<select name="status">
								<option value="0">...</option>
								<option value="1">New</option>
								<option value="2">Like New</option>
								<option value="3">Used</option>
								<option value="4">Very Old</option>
							</select>
						</div>
					</div>
					<!-- End Status Field -->
					<!-- Start Categories Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Category</label>
						<div class="col-sm-10 col-md-6">
							<select name="category">
								<option value="0">...</option>
								<?php
									$allCats = getAllFrom("*", "categories", "where parent = 0", "", "ID");
									foreach ($allCats as $cat) {
										echo "<option value='" . $cat['ID'] . "'>" . $cat['Name'] . "</option>";
										$childCats = getAllFrom("*", "categories", "where parent = {$cat['ID']}", "", "ID");
										foreach ($childCats as $child) {
											echo "<option value='" . $child['ID'] . "'>--- " . $child['Name'] . "</option>";
										}
									}
								?>
							</select>
						</div>
					</div>
					<!-- End Categories Field -->
					<!-- Start image Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">Image</label>
						<div class="col-sm-10 col-md-6">
					<input type="file" name="profile" class="form-control" required="" accept="*/image">
					</div>
					</div>
					<!-- End Tags Field -->
					<!-- Start Submit Field -->
					<div class="form-group form-group-lg">
						<div class="col-sm-offset-2 col-sm-10">
							<input type="submit" value="Add Item" class="btn btn-primary btn-sm"  name="newad"/>
						</div>
					</div>
					<!-- End Submit Field -->
				</form>
			</div>

				<!-- Start Loopiong Through Errors -->
				<?php
					if (isset($succesMsg)) {
						echo '<div class="alert alert-success">' . $succesMsg . '</div>';
					}
				?>
				<!-- End Loopiong Through Errors -->
			</div>
		</div>
	</div>
</div>
<?php
	} else {
		header('Location: login.php');
		exit();
	}
	include $tpl . 'footer.php';
	ob_end_flush();
?>