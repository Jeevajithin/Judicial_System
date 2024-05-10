<?php
include("user_auth.php");
if(!isset($user))
{
	echo "<script>window.location='../index.php'</script>";	
}
else
{
	
include('coordinator_header.php');
	
	if(isset($_REQUEST['submit'])) {
		
		$case_id=$_REQUEST['case_id'];
		$case_handling_id=$_REQUEST['case_han_id'];
		$case_title=$_REQUEST['case_title'];
 
    $crud = new CRUD();
		
	
    $data = array(
        'case_id' => $case_id,
        'hearing_date' => $_POST['hearing_date'],
		'judge_id' => $_POST['judge'],
		'description' => $_POST['description'],
        'hearing_status' => 0
    );

    $table = "hearing_schedule"; 
		
    $inserted = $crud->insert($table, $data);
		
		
		$sql_up="UPDATE `case_details` SET `case_status` = 'Hearing', `case_title` = '$case_title' WHERE `case_details`.`case_id` = '$case_id'";
	
	$result_up=$con->query($sql_up);
		
		if($inserted) 
	{
        echo "<script>alert('Hearing has been scheduled');</script>";
		echo "<script>window.location.href='view_requests_coordinator.php'</script>";
    } 
	else 
	{
        echo "<script>alert('Failed! Try again');</script>";
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
	  
						<h3>Assign a Judge</h3>
						<div class="contact-form">
<form enctype="multipart/form-data" method="post" action="">	
	<div class="form-group">
    <label for="exampleInputPassword1">Case Title</label>
    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="" name="case_title" required>
  </div>
	
	<div class="form-group">
    <label for="exampleFormControlSelect1">Select Judge</label>
		
    <select class="form-control" id="exampleFormControlSelect1" name="judge" required>
		<option value="">-Select-</option>
      <?php
		$sql="select * from judge_details";
		$result=$con->query($sql);
		while($row=$result->fetch_assoc())
			{
	?>
		<option value="<?php echo $row['user_id']; ?>"><?php echo $row['name']; ?></option>
    <?php
			}
	?>
    </select>
		
  </div>
	<div class="form-group">
	  <label for="exampleFormControlTextarea1">Any Description</label>
    <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
</div>
	
	
  <div class="form-group">
    <label for="exampleInputPassword1">Hearing Date</label>
    <input type="date" class="form-control" id="exampleInputPassword1" placeholder="" name="hearing_date" min="<?php echo date('Y-m-d'); ?>" required>
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
