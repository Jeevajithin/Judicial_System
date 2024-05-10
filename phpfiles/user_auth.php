<?php
session_start();
include("crud.php");
include("conn.php");
if(isset($_REQUEST['log'])=="1")
{
session_destroy();
echo "<script>window.location='../index.php'</script>";	
}
if(isset($_SESSION['uid']))
{
	$user=$_SESSION['uid'];
}
?>