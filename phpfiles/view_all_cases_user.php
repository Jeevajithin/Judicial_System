<?php
include("user_auth.php");
include('user_header.php');
if(!isset($user))
{
	echo "<script>window.location='../index.php'</script>";	
}
else
{
	$ad_id=$_REQUEST['aid'];
		$sql="SELECT * FROM case_details WHERE case_status='Closed' and case_id in (SELECT case_id FROM `case_handling_advocates` where advocate_id='$ad_id')";
		$result=$con->query($sql);
?>
            
            <div class="service">
                <div class="container">
                    <div class="section-header">
					<h3>Welcome <?php echo $usern['name']; ?></h3>
                    </div>
					<div class="row">
					<?php include('laws.php'); ?>
						<div class="col-lg-9">
						
							
					<div class="row">
						<div class="col-12">
						<h3>All Cases</h3>
							<?php
$count=$result->num_rows;
if($count>0)
{
?>
						<table class="table table-bordered">
							<tr>
								<td width="125">Case Number</td>
								<td width="125">Case Title</td>
								<td width="61">Category</td>
								<td width="123">Incident Date</td>
								<td width="129"></td>								
						    </tr>
							
							<?php
					while($row=$result->fetch_assoc())
					{
						?>
							<tr>
								<td><?php echo $row['case_number']; ?></td>
								<td><?php echo $row['case_title']; ?></td>
								<td><?php echo $row['category']; ?></td>
								<td><?php echo $row['incident_date']; ?></td>
								<td>
									<?php
									$case_id=$row['case_id'];
						
									$sql_="SELECT success_user_id FROM judgement_details WHERE case_id=1 and success_user_id in (SELECT user_id FROM case_handling_advocates WHERE case_id='$case_id' and advocate_id='$ad_id')";
									$res_=$con->query($sql_);
									$count_=$res_->num_rows;
									if($count_>0)
									{
									?>
									<span style="background-color:#82C3AC; color: black;padding: 8px; margin-left: 5px; border-radius: 5px">Won</span>
									<?php } else {
									?>
									<span style="background-color:#E3A1A2; color: black;padding: 8px; margin-left: 5px; border-radius: 5px">Failed</span>
									<?php } ?>
									
									
								</td>								
						    </tr>
						<?php } ?>
						</table>
							<?php } else {echo "<h6>No Details</h6>";} ?>
					</div>
					</div>

							
						</div>
					</div>
                    
                </div>
            </div>
            <!-- Service End -->
            
				
            
            

            <!-- Footer Start -->
            <?php include('footer2.php'); } ?>
