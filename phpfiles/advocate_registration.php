<?php
include("user_auth.php");
include("conn.php");
include('header2.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $crud = new CRUD();
	
	$email=$_POST['email'];
	$sql_check="select * from login_details where email='$email'";
	$result_check=$con->query($sql_check);
	$count_check=$result_check->num_rows;
	if ($count_check>0) {
		echo "<script>alert('Email Id already exists!');</script>";	
	} else {
		$log_data = array(
			'email' => $_POST['email'],
			'password' => $_POST['password'],
			'user_type' => "Advocate",
			'status' => 0
		);
		
		$log_inserted = $crud->insert("login_details", $log_data);
		if ($log_inserted) {
			$last_inserted_id = $crud->getLastInsertedId();
			
			$target_dir = "../uploads/";
			
			$photo = "user/" . rand() . basename($_FILES["photo"]["name"]);
			$target_file = $target_dir . $photo;
			
			$photo1 = "user/" . rand() . basename($_FILES["photo1"]["name"]);
			$target_file1 = $target_dir . $photo1;


			if ($_FILES["photo"]["error"] !== UPLOAD_ERR_OK) 
			{
				echo "File upload failed with error code: " . $_FILES["photo"]["error"];
			} else {

				if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
					move_uploaded_file($_FILES["photo1"]["tmp_name"], $target_file1);
					$data = array(
						'userid' => $last_inserted_id,
						'name' => $_POST['name'],
						'phone' => $_POST['phone'],
						'email' => $_POST['email'],
						'address' => $_POST['address'],
						'licence_number' => $_POST['licence_number'],
						'bar_association' => $_POST['bar_association'],
						'experience' => $_POST['experience'],
						'qualification' => $_POST['qualification'],
						'photo' => $photo,
						'id_proof' => $photo1
					);

					$table = "advocate_details"; 
					$inserted = $crud->insert($table, $data);
					
				} 
			}
		}
	}
}
?>


            <!-- Nav Bar End -->
            
            
            <!-- Page Header Start -->
            <div class="page-header">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h2>Law Portal</h2>
                        </div>
                        <div class="col-12">
                            <a href="">Home</a>
                            <a href="">Login</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page Header End -->


            <!-- Contact Start -->
            <div class="about">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-6">
                            <div class="about-img">
                                <img src="../template/img/about.jpg" alt="Image">
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6" style="border: solid 1px #060505; padding: 55px 20px;">
                            <div class="section-header">
                                <h3>Register here</h3>
                            </div>
							<?php
	if (@$inserted) 
	{
      echo '<div class="alert alert-success alert-dismissible" role="alert">
      Successfully User Details Created! Please wait for admin approval!</div>';
    } 
	?>
							
							<?php if (isset($_SESSION['error_message'])) { ?>
            <div class="alert alert-danger" role="alert">
				<?php echo $_SESSION['error_message']; ?>
		  </div>
        <?php unset($_SESSION['error_message']); } ?>
                            <div class="contact-form">
                                <form method="post" action="advocate_registration.php" enctype="multipart/form-data">
									
<div class="form-group">
    <label for="exampleInputEmail1"> Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="name" required>
    
  </div>								
									
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="email" required>  
  </div>
									
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1"  name="password" required>
  </div>
  
<div class="form-group">
    <label for="exampleInputEmail1">Phone Number</label>
    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="phone" required>  
  </div>

<div class="form-group">
    <label for="exampleInputEmail1">Address</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="address" required>
    
  </div>
									
<div class="form-group">
    <label for="exampleInputEmail1">Experience</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="experience" required>
    
  </div>
<div class="form-group">
    <label for="exampleInputEmail1">Licence Number</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="licence_number" required>
    
  </div>
									
<div class="form-group">
    <label for="exampleInputEmail1">Bar Association Details</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="bar_association" required>
    
  </div>
									

<div class="form-group">
    <label for="exampleInputEmail1">Qualification</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="qualification" required>
    
  </div>

<div class="form-group">
    <label for="exampleInputEmail1">Photo</label>
    <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="photo" required>
    
  </div>								
	
<div class="form-group">
    <label for="exampleInputEmail1">Upload your ID Proof (Prefer Aadhar)</label>
    <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="photo1" required>
    
  </div>								
						
  <button type="submit" class="btn" name="login">Submit</button>
  <button type="reset" class="btn">Reset</button>								
	
</form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Contact End -->


            <!-- Newsletter Start -->
            
            <!-- Newsletter End -->


            <!-- Footer Start -->
  <?php include('footer2.php'); ?>
