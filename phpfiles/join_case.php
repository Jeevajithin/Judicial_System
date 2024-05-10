<?php
include("user_auth.php");
if(!isset($user))
{
	echo "<script>window.location='../index.php'</script>";	
}
else
{
	
include('user_header.php');
	
	if(isset($_REQUEST['submit'])) {
		
		$case_no=$_REQUEST['case_no'];
		
		$sql_check="SELECT * FROM `case_details` WHERE case_number='$case_no'";
		$result_check=$con->query($sql_check);
		$count_check=$result_check->num_rows;
		if ($count_check>0) 
		{
		
		$sql_up="UPDATE `case_details` SET `defendent_id` = '$user' WHERE `case_details`.`case_number` = '$case_no'";
	
		$result_up=$con->query($sql_up);

			$count_up=$con->affected_rows;
			if($count_up>0)
			{
				echo "<script>alert('Succesfully joined in the existing Case.');</script>";
				echo "<script>window.location.href='userhome.php'</script>";
			} 
			else 
			{
				echo "<script>alert('Failed! Try again');</script>";
			}

		}
		else
		{
			echo "<script>alert('Case Number does not exists!');</script>";
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
	  
						<h3>Join to an existing Case</h3>
						<div class="contact-form">
<form enctype="multipart/form-data" method="post" action="">	
	<div class="form-group">
    <label for="exampleInputPassword1">Case Number</label>
    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="" name="case_no" required>
  </div>
	<button type="submit" class="btn" name="submit">Submit</button>
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
