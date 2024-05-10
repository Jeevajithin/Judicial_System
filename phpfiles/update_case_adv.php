<?php
include("user_auth.php");
include('advocate_header.php');

$currentYear = date("Y");
$randomDigits = mt_rand(1000, 9999);
$caseNumber = "CASE-" . $currentYear . "-" . $randomDigits;

$case_id=$_REQUEST['req_case_id'];

$sql1="SELECT * FROM `case_details` WHERE case_id='$case_id'";
$result1=$con->query($sql1);
$row1=$result1->fetch_assoc();
if(isset($_REQUEST['update'])) 
{
    $current_date = date('d-m-Y');
    $defendant_name = $_REQUEST['defendant_name'];
    $description = $_REQUEST['description'];
    $incident_date = $_REQUEST['incident_date'];
    
    // Sanitize input to handle single quotes
    $defendant_name = $con->real_escape_string($defendant_name);
    $description = $con->real_escape_string($description);
    
    // Prepare and bind SQL statement
    $stmt = $con->prepare("UPDATE `case_details` SET `case_status` = 'Requesting', `case_number` = ?, `filing_date` = ?, `incident_date` = ?, `defendant_name` = ?, `description` = ? WHERE `case_details`.`case_id` = ?");
    $stmt->bind_param("sssssi", $caseNumber, $current_date, $incident_date, $defendant_name, $description, $case_id);
    
    // Execute prepared statement
    if ($stmt->execute()) {
        echo "<script>alert('Case moved to court');</script>";
        echo "<script>window.location.href='req_coordinator.php';</script>";
    } else {
        echo "<script>alert('Something went wrong!');</script>";
    }
    
    // Close statement
    $stmt->close();
}


$sql="SELECT cd.*, ch.* FROM case_handling_advocates ch JOIN case_details cd ON ch.case_id = cd.case_id WHERE ch.advocate_id = '$user' AND ch.status = 1 and cd.case_status='Pending'";
$result=$con->query($sql);
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
      Case Details Created!</div>';
    } 
	?>
	  
						<h3>Add New Case</h3>
						<div class="contact-form">
<form enctype="multipart/form-data" method="post" action="">
	
	<!--<div class="form-group">
    <label for="exampleFormControlSelect1">Case Number</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="case_no" readonly value="<?php // echo $caseNumber; ?>">
  </div>-->
	
	<!--<div class="form-group">
    <label for="exampleFormControlSelect1">Case Category</label>
    <select class="form-control" id="exampleFormControlSelect1" name="category">
      <option>-Select-</option>
      <option>Civil</option>
      <option>Criminal</option>
    </select>
  </div>-->
	
	<div class="form-group">
    <label for="exampleInputEmail1">Defendant Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="defendant_name" value="<?php echo $row1['defendant_name']; ?>">
    </div>
	<div class="form-group">
	  <label for="exampleFormControlTextarea1">Case Description</label>
    <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo $row1['description']; ?></textarea>
</div>
	
	
  <div class="form-group">
    <label for="exampleInputPassword1">Incident Date</label>
    <input type="date" class="form-control" id="exampleInputPassword1" placeholder="" name="incident_date" value="<?php echo $row1['incident_date']; ?>">
  </div>
	 
						
  <button type="submit" class="btn" name="update">Submit</button>
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
            <?php include('footer2.php'); ?>
<script type="text/javascript">
			$(document).ready( function () {
    $('#example').DataTable();
} );
			</script>



