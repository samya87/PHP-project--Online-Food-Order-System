<?php
	//include constant file
	include('../config/constants.php');
	//echo "hi";
	//check whether id and image_name value is set or not
	if(isset($_GET['id']) AND isset($_GET['image_name']))
	{
		//get the value and delete
		//echo "Get the value and delete";
		$id = $_GET['id'];
		$image_name = $_GET['image_name'];
		
		//remove the phhysical image file if available
		if($image_name!="")
		{
			//image is vailable. so remove it
			$path= "../images/category".$image_name;
			//remove the image
			$remove = unlink($path);
			
			//if failed to remove image then add a error mesage and stop the process
			if($remove==false)
			{
				//set the session message
				$_SESSION['remove']= "<div class='error'>Failed to remove category Image.</div>
				//redirect to manage categor page
				header('location:'.SITEURL.'admin/manage-category.php');
				//stop the process
				die();
			}
		}
		//delete data from database
		//sql query to delete data from databse
		$sql = "DELETE FROM tbl_category WHERE id=$id";
		
		//execute the query
		$res = mysqli_query($conn, $sql);
		
		//check whether the data is deleeted from database or  not
		if(res==true)
		{
			//set success message and redirect
			$_SESSION['delete'] = "<div class='success'>Category deleted successfully.</div>";
			//redirect to manage category
			header('location'.SITEURL.'admin/manage-category.php");
		}
		else
		{
			//set fail message and redirect
			$_SESSION['delete'] = "<div class='error'>Failed to delete Category.</div>";
			//redirect to manage category
			header('location'.SITEURL.'admin/manage-category.php");
		}
		
		//redirect to managecategory page with message
	}
	else
	{
		//rediret to mange category page
		header('location:'.SITEURL.'admin/manage-category.php');
	}
?>