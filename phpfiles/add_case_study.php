<?php
include("user_auth.php");
	
include('advocate_header.php');
if(!isset($user))
{
	echo "<script>window.location='../index.php'</script>";	
}
else
{
	if (isset($_REQUEST['submit'])) {	
		
		if(isset($_REQUEST['case_han_id'])&& isset($_REQUEST['case_id']))
		{
			$type=$_POST['type'];
		
		$sql_check="select * from case_documents where document_type='$type'";
		$result_check=$con->query($sql_check);
		$count_check=$result_check->num_rows;
		if ($count_check>0) 
		{
			echo "<script>alert('Document Type already exists!');</script>";	
		}
		else
		{
			
		
    $crud = new CRUD();
			
    	$target_dir = "../uploads/";
	$photo="documents/".rand().basename($_FILES["photo"]["name"]);
	
    $target_file = $target_dir .$photo;
	
		$case_handling_id=$_REQUEST['case_han_id'];
		$case_id=$_REQUEST['case_id'];

    $data = array(
		'case_id' => $case_id,
        'document_type' => $_POST['type'],
        'advocate_id' => $user,
        'case_handling_id' => $case_handling_id,
        'description_details' => $_POST['details'],
		'file_name' => $photo
    );

  
    move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);

    $table = "case_documents"; 
    $inserted = $crud->insert($table, $data);
			
	}
			
	}
	else
	{
		echo "<script>alert('Empty Case Details!')</script>";
		echo "<script>window.location.href='advocate_cases.php'</script>";
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
      Successfully Documents Uploaded!</div>';
    } 
	
							?>
						<h3>Add Case Updates</h3>
						<div class="contact-form">
<form enctype="multipart/form-data" method="post" action="">
	<div class="form-group">
    <label for="exampleInputEmail1">Document Type</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="type" required>
    </div>
	<div class="form-group">
	  <label for="exampleFormControlTextarea1">Details</label>
    <textarea name="details" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
</div>
	<div class="form-group">
	  <label for="exampleFormControlFile1">Upload document</label>
    <input type="file" name="photo" class="form-control-file" id="exampleFormControlFile1" required>
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
