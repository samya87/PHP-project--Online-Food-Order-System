<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Add category page</h1>

		<br><br>
			
		<?php
			if(isset($_SESSION['add']))
			{
				echo $_SESSION['add'];
				unset($_SESSION['add']);
			}
			
			if(isset($_SESSION['upload']))
			{
				echo $_SESSION['upload'];
				unset($_SESSION['upload']);
			}
		?>
		<br><br>
		<!--Add category form starts-->
			<form action="" method="POST" enctype="multipart/form-data">
				<table class="tbl-30">
					<tr>
						<td>Title:</td>
						<td>
							<input type="text" name="title" placeholder="category title"></input>
						</td>
					</tr>

					<tr>
						<td>Select Image :</td>
						<td>
							<input type="file" name="image" ></input>
						</td>
					</tr>
					
					<tr>
						<td>Featured:</td>
						<td>
							<input type="radio" name="Featured" value="YES">Yes
							<input type="radio" name="Featured" value="NO">NO
						</td>
					</tr>

					<tr>
						<td>Active:</td>
						<td>
							<input type="radio" name="Active" value="YES">Yes
							<input type="radio" name="Active" value="NO">NO
						</td>
					</tr>

					<tr>
						<td colspan="2">
							<input type="submit" name="submit" value="Add Category" class="btn-secondary"
						</td>
					</tr>
				</table>
			</form>
		<!--Add category form ends-->
			
		<?php
			//whether the submit btn is clicked or not
			if(isset($_POST['submit']))
			{
				//echo "clicked";
				
				//1.get the value from form
				$title = $_POST['title'];
				
				//for radio input type,to chek whether the btn is selected or not
				if(isset($_POST['featured']))
				{
					//get the value from form
					$featured = $_POST['featured'];
				}
				else 
				{
					//set the default value
					$featured = "NO";
				}
				
				
				if(isset($_POST['active']))
				{
					//get the value from form
					$active = $_POST['active'];
				}
				else 
				{
					//set the default value
					$active = "NO";
				}
				
				//check whether image selected or not na d set the value for image name accordingly
				//print_r($_FILES['image']);
				
				//die();//break the code here
				
				
				if(isset($_FILES['image']['name']))
				{
					//upload the image
					//to upload the image we need image name, source path and dest path
					$image_name = $_FILES['image']['name'];

					//auto-rename our image
					//get the extension of our image e.g. "food1.jpg"
					$ext = end(explode('.',$image_name));

					//rename the Image
					$image_name = "Food_Category_".rand(000, 999).'.'.$ext; //e.g. Food_Category_834.jpg
					
					$source_path = $_FILES['image']['tmp_name'];
					
					$destination_path = "../images/category".$image_name;
					
					//finally upload the image
					$upload = move_uploaded_file($source_path, $destination_path);
					
					//check whther the image is uploaded or not
					//and if the image is not uploaded then we stop th process aand redirect with error message
					if($upload==false)
					{
						//set message
						$_SESSION['upload'] = "<div class='error'> Failed to upload image </div>";
						//redirect to add category page
						header('location:'.SITEURL.'admin/add-category.php');
						//stop the process;
						die();
					}
				}
				else 
				{
					//dont upload the image and set the image name value as blank
					$image_name=" ";
					
				}
				
				
				//2.create sql query to insert cateory into our databse
				$sql = "Insert into tbl_category set
					title= '$title',
					image_name = '$image_name',
					featured = '$featured',
					active = '$active'
				";
				
				$res = mysqli_query($conn, $sql);
				
				//4.check if the query is executed or not and data added or not
				if($res==true)
				{
					//query executed and ctegory added
					$_SESSION['add'] = "<div class='success'>  category Added </div>";
					//redirect to manage category page
					header('location:'.SITEURL.'admin/manage-category.php');
				
				}
				else
				{
					 //failed to add category
					 $_SESSION['add'] = "<div class='error'>failed to add category </div>";
					//redirect to manage category page
					header('location:'.SITEURL.'admin/add-category.php');
				}
			}
			
		?>
	</div>
</div>
<?php include('partials/footer.php'); ?>