<?php
session_start();
require "config.php";

    if(!isset($_SESSION['login_user']))
    {
       header("location: ../../signin/universal-signin.php");
       exit();
    }
?>