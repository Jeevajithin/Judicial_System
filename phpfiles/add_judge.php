<?php
include("user_auth.php");
	
include('adminheader.php');
if(!isset($user))
{
	echo "<script>window.location='../index.php'</script>";	
}
else
{
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		$email=$_POST['email'];
	$sql_check="select * from login_details where email='$email'";
	$result_check=$con->query($sql_check);
	$count_check=$result_check->num_rows;
	if ($count_check>0) 
	{
		echo "<script>alert('Email Id already exists!');</script>";	
	}
		else
		{
			
		
 
    $crud = new CRUD();
	$log = new CRUD();
	
	$log_data = array(
        'email' => $_POST['email'],
        'password' => $_POST['password'],
		'user_type' => "Judge",
		'status' => 1
    );
	
	$log_inserted = $log->insert("login_details", $log_data);
	if ($log_inserted) 
	{
		$last_inserted_id = $log->getLastInsertedId();
	
    	$target_dir = "../uploads/";
	$photo="user/".rand().basename($_FILES["photo"]["name"]);
	
    $target_file = $target_dir .$photo;
	

    $data = array(
		'user_id' => $last_inserted_id,
        'name' => $_POST['name'],
        'gender' => $_POST['gender'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'specialization' => $_POST['specialization'],
        'address' => $_POST['address'],
        'description' => $_POST['about'],
		'photo' => $photo,
		'status' => 1,
    );

  
    move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);

    $table = "judge_details"; 
    $inserted = $crud->insert($table, $data);
		
	}
	
}
	    
}

?>
            
            <!-- Service Start -->
            <div class="service">
                <div class="container">
                    <div class="section-header">
                    <h3>Welcome <?php echo $usern['name']; ?></h3>
                    </div>
					<div class="row">
          <?php include('laws.php'); ?>
						<div class="col-lg-9" style="border: solid 1px #060505; padding: 20px 20px;">
						
							
					<div class="row">
						<div class="col-12">
	<?php
	if (@$inserted) 
	{
      echo '<div class="alert alert-success alert-dismissible" role="alert">
      Successfully User Details Created!</div>';
    } 
	
							?>
						<h3>Add New Judge</h3>
						<div class="contact-form">
<form enctype="multipart/form-data" method="post" action="add_judge.php">
	<div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="name" required>
    </div>
	
	<div class="form-group">
    <label for="exampleFormControlSelect1">Gender</label>
    <select class="form-control" id="exampleFormControlSelect1" name="gender" required>
	  <option value="">-Select-</option>
      <option>Male</option>
      <option>Female</option>
      <option>Other</option>
    </select>
  </div>
	
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="email" required>
    </div>
	
	<div class="form-group">
    <label for="exampleInputEmail1">Phone Number</label>
    <input type="phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="phone" required>
    </div>
	
	<div class="form-group">
    <label for="exampleFormControlSelect1">Specialization</label>
    <select class="form-control" id="exampleFormControlSelect1" name="specialization" required>
      <option value="">-Select-</option>
      <option>Civil Judges</option>
      <option>Criminal Judges</option>
      <option>Specialized Tribunals and Courts</option>
	  <option>Family Court Judges</option>
    </select>
  </div>
	
	<div class="form-group">
    <label for="exampleFormControlTextarea1">Address</label>
    <textarea name="address" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
  </div>
	
	<div class="form-group">
    <label for="exampleFormControlTextarea1">About Judge</label>
    <textarea name="about" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
  </div>
	
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" required>
  </div>
	
<div class="form-group">
    <label for="exampleFormControlFile1">Upload Profile Photo</label>
    <input type="file" name="photo" class="form-control-file" id="exampleFormControlFile1" required>
  </div>
  
						
  <button type="submit" class="btn">Submit</button>
  <button type="reset" class="btn">Reset</button>								
	
</form>
                            </div>
					</div>
					</div>
				
			
							
						</div>
					</div>
                    
                </div>
            </div>
            <!-- Service End -->
            
				
            
            

            <!-- Footer Start -->
            <?php include('footer2.php'); } ?>
