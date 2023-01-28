<?php 
	//include constants.php file here
	include('../config/constants.php');
	
	//1. get th id of admin to be deleted
	$id = $_GET['id'];
	
	//2. create sql query to delete admin 
	$sql = "DELETE FROM tbl_admin WHERE id=$id";
	
	//execute the query
	$res= mysqli_query ($conn,$sql);
	
	//check whether the query is executed successfully or not
	if($res == true)
	{
		//query executed sucessfull and admin deleted
		//echo "admin deleted";
		//create sessiion variable to display message
		$_SESSION['delete'] = "<div class='successs'>adminss deleted</div>";
		//redirect to manage admin page
		header('location:'.SITEURL.'admin/manage-admin.php');
	}
	else 
	{
		//failed to delete admin
		//echo "admin couldnt be found";
		
		$_SESSION['delete'] = "<div class='error'>failed to admin delete</div>";
		//redirect to manage admin page
		header('location:'.SITEURL.'admin/manage-admin.php');
	}
	//3. redeirect to manage admin page wit messsage(sucess/error)
?>