<?php
include("user_auth.php");
include('adminheader.php');
if(!isset($user))
{
	echo "<script>window.location='../index.php'</script>";	
}
else
{
		$sql="SELECT * FROM case_details where case_status !='Pending'";
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
								<td width="85">Case Status</td>
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
								<td><?php echo $row['case_status']; ?></td>
								<td><?php echo $row['incident_date']; ?></td>
								<td>
									<a href="view_case_details_admin.php?case_id=<?php echo $row['case_id'];  ?>" style="background-color: #aa9166; color: black;padding: 8px; margin-left: 5px; border-radius: 5px">View Details</a>
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
