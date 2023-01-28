<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Change Password</h1>
		<br></br>

		<?php
			if(isset($_GET['id']))
			{
				$id=$_GET['id'];
			}
		?>

		<form action="" method="POST">

			<table class="tbl-full">
				<tr>
					<td>Current Password: </td>
					<td>
						<input type="password" name="current_password" placeholder="old password"></input>
					</td>
				</tr>

				<tr>
					<td>New Password: </td>
					<td>
						<input type="password" name="new_password" placeholder="new password"></input>
					</td>
				</tr>

				<tr>
					<td>Confirm Password: </td>
					<td>
						<input type="password" name="confirm_password" placeholder="Confirm password"></input>
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="hidden" name="id" value=""
							<?php echo $id; ?>">
						</input>
						<input type="submit" name="submit" value="Change password" class="btn-secondary"></input>
					</td>
				</tr>

			</table>
		</form>
	</div>
</div>

<?php
	//check whwether the submit button  clickde or not
	if(isset($_POST['submit']))
	{
		//echo "cliked";
		
		//1.get the data from form
		$current_password= md5($_POST['current_password']);
		$new_password= md5($_POST['new_password']);
		$confirm_password= md5($_POST['confirm_password']);
		
		//2. check whwther the user with current i and  current passowrd exists or not
		$sql="SELECT * FROM tbl_admin WHERE id='$id' AND password='$current_password'";
		
		//execute the query
		$res= mysqli_query($conn, $sql);
		
		if($res==true)
		{
			//check whether the data is available or not
			$count= mysqli_num_rows($res);
			
			if($count == 1)	
			{
				//user exits and pass can be changed
				//echo" user found";
				//3.check whether the new password and confirm password match or not
				if($new_password == $confirm_password)
				{
					//update the password
					$sql2 = "UPDATE tbl_admin SET
						password ='$new_password'
						WHERE id=$id";
						
					//execute the query
					$res2= mysqli_query($conn, $sql2);
				
					//check whether thw query executed or nt
					if($res2==true)
					{
						//display sucess message
						//redirect to manage admin with suxccess message
						$_SESSION ['change-pwd'] = "<div class ='success'> password changed. </div>";
						//redirect the user
						header('location:'.SITEURL.'admin/manage-admin.php');
					}
					else
					{
						//display error message
						//redirect to manage admin with error message
						$_SESSION ['change-pwd'] = "<div class ='error'> Failed to change password. </div>";
						//redirect the user
						header('location:'.SITEURL.'admin/manage-admin.php');
					}
				}
				else
				{
					$_SESSION ['pwd-not-match'] = "<div class ='error'> password did not match. </div>";
					//redirect the user
					header('location:'.SITEURL.'admin/manage-admin.php');
				}
			}
			else
			{
				//user doesnt exit and pass can't be changed
				$_SESSION ['user-not-found'] = "<div class ='error'> User not found. </div>";
				//redirect the user
				header('location:'.SITEURL.'admin/manage-admin.php');
			}
		}
		
		//4.change passowrd if all above is true
	}
?>


<?php include('partials/footer.php'); ?>