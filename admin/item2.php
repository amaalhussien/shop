<?php

	/*
	================================================
	== Items Page
	================================================
	*/

	ob_start(); // Output Buffering Start

	session_start();

	$pageTitle = 'Items';

	if (isset($_SESSION['Username'])) {

		include 'init.php';
?>
<?php
if(isset($_POST['btn-add']))
	{
		
		$images=$_FILES['profile']['name'];
		$tmp_dir=$_FILES['profile']['tmp_name'];
		$imageSize=$_FILES['profile']['size'];

		$upload_dir='uploads/';
		$imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
		$valid_extensions=array('jpeg', 'jpg', 'png', 'gif', 'pdf');
		$picProfile=rand(1000, 1000000).".".$imgExt;
		move_uploaded_file($tmp_dir, $upload_dir.$picProfile);
		$stmt=$con->prepare('INSERT INTO items(Image) VALUES (:upic)');
		$stmt->bindParam(':upic', $picProfile);
		if($stmt->execute())
		{



            
			?>
			<script>
				alert("new record successul");
				window.location.href=('index.php');
			</script>
		<?php
		}else {
        
        }
        
        
    }?>

        <div class="container">
		<div class="add-form">
			<h1 class="text-center">Please Insert new Item image</h1>
			<form method="post" enctype="multipart/form-data">
				<label>Picture Profile</label>
				<input type="file" name="profile" class="form-control" required="" accept="*/image">
				<button type="submit" name="btn-add">Add New </button>
				
			</form>
		</div>
		<hr style="border-top: 2px red solid;">
	</div>	

<?php
    }
    ?>