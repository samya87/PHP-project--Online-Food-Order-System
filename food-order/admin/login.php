<?php include('../config/constants.php'); ?>
<html>
	<head>
		<title>Login - Food order system</title>
		<link rel="stylesheet" href="../css/admin.css">
	</head>

	<body>
		<div class="login">
			<h1 class="text-center">Login</h1>
			<br><br>
				
			<?php
				if(isset($_SESSION['login']))
				{
					echo $_SESSION['login'];
					unset($_SESSION['login']);
				}
				if(isset($_SESSION['no-login-message']))
				{
					echo $_SESSION['no-login-message'];
					unset($_SESSION['no-login-message']);
				}
			?>
			<br><br>
						
						
			<!-- Login form starts here-->
			<form action="" method="POST" class="text-center">
				Username:<br>
				<input type="text" name="username" placeholder="Enter username"><br><br>
					
				Password:<br>
				<input type="password" name="password" placeholder="Enter password"><br><br>
					
				<input type="submit" name="submit" value="Login" class="btn-primary"><br><br>
			</form>
			<p class="text-center">Developed by - <a href="#">Kamrunnesa</a></p>

		</div>
	</body>
</html>

<?php
	//cehck whether the submit btn is clicked or not
	if(isset($_POST['submit']))
	{
		//process for login
		//1.get the data from login form
		
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		
		//SQL to check whether the username and password exists or not
		$sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
		$res = mysqli_query($conn, $sql);
		
		//4.count rows to chwck whwther the user exists or not
		$count=mysqli_num_rows($res);
		
		if($count ==1)
		{
			//user available and login success
			$_SESSION['login'] = "<div class='success text-center'> Login Successful </div>";
			$_SESSION['user'] = $username; //to check whwther the user is logged in or not and lohout will unset it
			
			//redirect to homepage/dashboard
			header('location:'.SITEURL.'admin/');
		}
		else
		{
			//user not available
			$_SESSION['login'] = "<div class='error text-center'> Username and password did not match </div>";
			//redirect to homepage/dashboard
			header('location:'.SITEURL.'admin/login.php');
		}
	}
?>