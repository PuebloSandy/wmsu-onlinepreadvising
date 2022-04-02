<?php
	session_start();
    require "config.php";
	require "alertmessage.php";
	require_once("checksession.php");

	if(isset($_POST['logout']))
	{
		$id = $_POST['id'];

		$get_usser = mysqli_query($connection,"SELECT * FROM tbluser WHERE id='$id'");
		while($ko = mysqli_fetch_array($get_usser))
		{
			$username = $ko['username'];
		}

		unset($id);
		session_destroy();
		$_SESSION['status'] = "Successfully Sign out";
    	$_SESSION['status_code'] = "success";
		header("location: ../../signin/universal-signin.php");
	}
?>