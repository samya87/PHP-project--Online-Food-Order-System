<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h4>Add admin</h4>
		<br/><br>
			
		<?php
			if(isset($_SESSION['add'])) //checking whether the session is set or not
			{
				echo $_SESSION['add']; //display the session message if set
				unset($_SESSION['add']); //remove sesssion messsage
			}
		?>

		<form action="" method="POST">
			<table class="tbl-full">
				<tr>
					<td>Full name</td>
					<td>
						<input type="text" name="full_name" placeholder="Enter your name"></input>
					</td>
				</tr>

				<tr>
					<td>Username:</td>
					<td>
						<input type="text" name="username" placeholder="Your username"></input>
					</td>
				</tr>

				<tr>
					<td>Password:</td>
					<td>
						<input type="password" name="password" placeholder="Your password"></input>
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add admin" class="btn-secondary"></input>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
<?php include('partials/footer.php'); ?>


<?php 
	 if(isset($_POST['submit']))
	{	//{echo "button clicked";}
	
		//1. get the data from form
		$full_name= $_POST['full_name'];
		$username= $_POST['username'];
		$password= md5($_POST['password']); //passowrd enrypted withmd5
		
		//2. sql query to save the data in the database
		$sql = "INSERT INTO tbl_admin SET
			full_name='$full_name',
			username = '$username',
			password = '$password'
		";
			
		//echo $sql;
		
		//3. execute query and save the data in database
		$res = mysqli_query($conn, $sql) or die(mysqli_error());
		
		//4. check whether the(query is executed) data is inserted or not and display appropriate message
		if($res == TRUE)
		{
			//echo  "data inserted";
			//create a session variable to display message
			$_SESSION['add'] = "Admin addded successfully";
			//redirect page manage admin
			header("location:".SITEURL.'admin/manage-admin.php');
		}
		else
		{
			//echo "failed to insert data";
			//create a session variable to display message
			$_SESSION['add'] = "Failed to add Admin";
			//redirect page to add admin
			header("location:".SITEURL.'admin/add-admin.php');
		}
		
		//localhost/phpmyadmin/tbl_structure.php?db=food-order&table=tbl_admin
	 }
	 
?>























