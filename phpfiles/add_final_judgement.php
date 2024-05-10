<?php
include("user_auth.php");
if(!isset($user))
{
	echo "<script>window.location='../index.php'</script>";	
}
else
{
	
include('judge_header.php');
	
$case_id=$_REQUEST['case_id'];
	
$sql="SELECT * FROM `case_details` WHERE case_id='$case_id'";
$result=$con->query($sql);
$row=$result->fetch_assoc();

$sql1="SELECT 
    ud.name AS defendant_name,
    ud2.name AS user_name
FROM 
    case_details cd
JOIN 
    user_details ud ON cd.defendent_id = ud.user_id
JOIN 
    user_details ud2 ON cd.user_id = ud2.user_id
WHERE
    cd.case_id = '$case_id';
";
$result1=$con->query($sql1);
$row1=$result1->fetch_assoc();

	
	if(isset($_REQUEST['submit'])) {
		
		$case_id=$_REQUEST['case_id'];
 
    	$crud = new CRUD();
		
	
		$data = array(
			'case_id' => $case_id,
			'judge_id' => $user,
			'success_user_id' => $_POST['success_user'],
			'judgement_notes' => $_POST['notes'],
			'judgement_penalty' => $_POST['penalty']
		);

    $table = "judgement_details"; 
		
    $inserted = $crud->insert($table, $data);
		
		
		$sql_up="UPDATE `case_details` SET `case_status` = 'Closed' WHERE `case_details`.`case_id` = '$case_id'";
	
	$result_up=$con->query($sql_up);
		
		if($inserted) 
	{
        echo "<script>alert('Final Judgement has been added.');</script>";
		echo "<script>window.location.href='judgehome.php'</script>";
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
	  
						<h3>Final Judgement</h3>
						<div class="contact-form">
<form enctype="multipart/form-data" method="post" action="">
	
	<div class="form-group">
    <label for="exampleInputPassword1">Case Title</label>
    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="" name="case_title" value="<?php echo $row['case_title']; ?>" readonly>
  </div>

	
	<div class="form-group">
    <label for="exampleInputPassword1">Court in favour of</label>
		<br>
    <input type="radio" class="" id="exampleInputPassword1" placeholder="" name="success_user" value="<?php echo $row['user_id']; ?>"> Plaintiff(<?php echo $row1['user_name']; ?>)
			
	<input type="radio" class="" id="exampleInputPassword1" placeholder="" name="success_user" value="<?php echo $row['defendent_id']; ?>"> Defendent(<?php echo $row1['defendant_name']; ?>)
  </div>
<div class="form-group">
	  <label for="exampleFormControlTextarea1">Judgement Notes</label>
    <textarea name="notes" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
</div>
	
	<div class="form-group">
	  <label for="exampleFormControlTextarea1">Penalty</label>
    <textarea name="penalty" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
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


            <!-- Footer Start -->
            <?php include('footer2.php'); } ?>
