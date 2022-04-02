<?php
    session_start();
    session_destroy();
    include "config.php";
	include "alertmessage.php";
    $_SESSION['status'] = "Your Account is Inactive!! Its been Sign out!";
    $_SESSION['status_code'] = "success";
	header("location: ../../signin/universal-signin.php");
?>