<?php
include("user_auth.php");
include('user_header.php');
if(!isset($user))
{
	echo "<script>window.location='../index.php'</script>";	
}
else
{
$crud = new CRUD();
$table = 'case_details';

$sql="SELECT cd.*, ch.*, ad.* FROM case_details cd JOIN case_handling_advocates ch ON cd.case_id = ch.case_id JOIN advocate_details ad ON ch.advocate_id = ad.userid WHERE ch.user_id = '$user'";
$result=$con->query($sql);

$advocate_details = $crud->select_all("advocate_details");

if(isset($_REQUEST['req_id'])&& isset($_REQUEST['advocate_id']))
{
	$case_id=$_REQUEST['req_id'];
	$advocate_id=$_REQUEST['advocate_id'];	
	$sql_check="SELECT * FROM `case_handling_advocates` WHERE advocate_id='$advocate_id' AND case_id='$case_id'";
	$result_check=$con->query($sql_check);
	$count_check=$result_check->num_rows;
	
	if ($count_check>0) 
	{
		echo "<script>alert('Already Request has sent');</script>";
	}

	else
	{
		$data = array(
        'case_id' => $case_id,
        'advocate_id' => $advocate_id,
        'user_id' => $user,
        'status' => 0      
    );
    $table = "case_handling_advocates";
    $inserted = $crud->insert($table, $data);

    if($inserted) 
	{
        echo "<script>alert('Your Request has been sent');</script>";
		echo "<script>window.location.href='request_advocates.php'</script>";
    } 
	else 
	{
        echo "<script>alert('Failed! Try again');</script>";
    }
		
	}
}

?>
            <!-- Nav Bar End -->
            
            
            <!-- Carousel Start -->
            
            <!-- Carousel End -->
            
            
            <!-- Top Feature Start-->
            
            <!-- Top Feature End-->
            
            
            <!-- About Start -->
            
            <!-- About End -->


            <!-- Service Start -->
            <div class="service">
                <div class="container">
                    <div class="section-header">
					<h3>Welcome <?php echo $usern['name']; ?></h3>
                    </div>
					<div class="row">
					<?php include('laws.php'); ?>
						<div class="col-lg-9">
						
							<?php
						  
						  ?>
					<div class="row">
						<div class="col-12">
						<h4>My Recent Cases</h4>
						<table class="table table-bordered">
							<tr>
								<td width="121">Defendant Name</td>
								<td width="85">Category</td>
								<td width="84">Case Details</td>
								<td width="128">Incident Date</td>
								<td width="183">Advocate</td>
								<td width="167">Case Status</td>								
						    </tr>
							
							<?php
					while($row=$result->fetch_assoc())
					{
						?>
							<tr>
								<td><?php echo $row['defendant_name']; ?></td>
								<td><?php echo $row['category']; ?></td>
								<td><textarea style="width: 250px;"><?php echo $row['description']; ?></textarea></td>
								<td><?php echo $row['incident_date']; ?></td>
								<td>Adv. <?php echo $row['name']; ?></td>
								<td>
									<?php
									if($row['status']==1)
									{
										echo " Accepted";
									}
									else if($row['status']==2)
									{
										echo " Rejected";
									}
									else 
									{
										echo " Pending";
									}
									
									?>								
									</td>								
						    </tr>
						<?php } ?>
						</table>
					</div>
					</div>
				
			<?php 	 ?>
							
						</div>
					</div>
                    
                </div>
            </div>
            <!-- Service End -->
            

            <!-- Footer Start -->
            <?php include('footer2.php');  ?>

<script>
    document.getElementById('confirmLink').addEventListener('click', function() {
        var selectedValue = document.getElementById('advSelect').value;
        if (selectedValue !== "Select") {
            var form = document.getElementById('myForm');
            var formAction = form.getAttribute('action');
            var caseId = '<?php echo $detail['case_id']; ?>';
            var link = 'request_advocates.php?req_id=' + caseId + '&advocate_id=' + selectedValue;
            window.location.href = link;
        } else {
            alert("Please select an advocate.");
        }
    });
</script>
<?php } ?>



