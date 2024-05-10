<?php
include("user_auth.php");
if(!isset($user))
{
	echo "<script>window.location='../index.php'</script>";	
}
else
{
	
include('user_header.php');
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $crud = new CRUD();
	

    $data = array(
        'description' => $_POST['description'],
        'category' => $_POST['category'],
        'defendant_name' => $_POST['defendant_name'],
		'case_status' => "Pending",
		'incident_date' => $_POST['incident_date'],
        'user_id' => $user
    );

    $table = "case_details"; 
    $inserted = $crud->insert($table, $data);
		
	
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
      Case Details Created!</div>';
    } 
	?>
	  
						<h3>Add New Case</h3>
						<div class="contact-form">
<form enctype="multipart/form-data" method="post" action="add_new_case.php">
	
	<div class="form-group">
    <label for="exampleFormControlSelect1">Case Category</label>
    <select class="form-control" id="exampleFormControlSelect1" name="category" required>
      <option value="">-Select-</option>
      <option>Civil</option>
      <option>Criminal</option>
    </select>
  </div>
	
	<div class="form-group">
    <label for="exampleInputEmail1">Defendant Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="defendant_name" required>
    </div>
	<div class="form-group">
	  <label for="exampleFormControlTextarea1">Case Description</label>
    <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
</div>
	
	
  <div class="form-group">
    <label for="exampleInputPassword1">Incident Date</label>
    <input type="date" class="form-control" id="exampleInputPassword1" placeholder="" name="incident_date" required max="<?php echo date('Y-m-d'); ?>">
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
