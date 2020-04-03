<?php

	/*
	================================================
	== Template Page
	================================================
	*/

	ob_start(); // Output Buffering Start

	session_start();

	$pageTitle = '';

	if (isset($_SESSION['Username'])) {

		include 'init.php';

		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

		if ($do == 'Manage') {
             echo"hello";
          
		} elseif ($do == 'Add') {
			echo"hello2";

		} elseif ($do == 'Insert') {
			echo"hello3";

		} elseif ($do == 'Edit') {

			echo"hello"4;
		} elseif ($do == 'Update') {


		} elseif ($do == 'Delete') {


		} elseif ($do == 'Activate') {


		}

		include $tpl . 'footer.php';

	} else {

		header('Location: index.php');

		exit();
	}

	ob_end_flush(); // Release The Output

?>