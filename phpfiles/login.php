<?php
include("user_auth.php");
include("conn.php");
if (isset($_POST['login']) && !empty($_POST['email']) 
               && !empty($_POST['password'])) 
	{
		$username=$_POST['email'];
		$password=$_POST['password'];
	
		$sql="SELECT * FROM login_details WHERE email='$username' AND password='$password'";
	
		$result=$con->query($sql);
		$count=$result->num_rows;
	
		if($count>0)
			{
				$row=$result->fetch_assoc();
				$_SESSION['uid']=$row['id'];
							
				if($row['status']==1)
					{
						if($row['user_type']=="coordinator")
							{
								echo "<script type='text/javascript'> window.location.href='coordinatorhome.php'; </script>";								
								}
								else if($row['user_type']=="Judge")
								{
									echo "<script type='text/javascript'> window.location.href='judgehome.php'; </script>";	
								}
								else if($row['user_type']=="Advocate")
								{
									echo "<script type='text/javascript'> window.location.href='advocate_home.php'; </script>";	
								}
								else if($row['user_type']=="public")
								{
									echo "<script type='text/javascript'> window.location.href='userhome.php'; </script>";	
								}
								
							}
							else
							{
								$_SESSION['error_message'] = "Sorry, You cant login";
							}
						}
						else
						{
							 $_SESSION['error_message'] = "Invalid Username or Password";
                  			
						}
        }
	
include('header2.php');
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
                                <h3>Login Here</h3>
                            </div>
							<?php if (isset($_SESSION['error_message'])) { ?>
            <div class="alert alert-danger" role="alert">
				<?php echo $_SESSION['error_message']; ?>
		  </div>
        <?php unset($_SESSION['error_message']); } ?>
                            <div class="contact-form">
                                <form method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
  </div>
  
						
  <button type="submit" class="btn" name="login">Submit</button>
  <button type="reset" class="btn">Reset</button>								
	
</form>


                            </div>
                            <p align="right"><a href="user_registration.php">New User?</a></p>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- Contact End -->


            <!-- Newsletter Start -->
            
            <!-- Newsletter End -->


            <!-- Footer Start -->
  <?php include('footer2.php'); ?>
