<?php
include("user_auth.php");
if(!isset($user))
{
	echo "<script>window.location='../index.php'</script>";	
}
else
{
	
include('advocate_header.php');
	$sql="SELECT cd.*, ch.* FROM case_handling_advocates ch JOIN case_details cd ON ch.case_id = cd.case_id WHERE ch.advocate_id = '$user' AND ch.status = 0 limit 10;
";
$result=$con->query($sql);
$count_check=$result->num_rows;
?>
            

            <!-- Service Start -->
            <div class="service">
                <div class="container">
                    <div class="section-header">
                        <h3>Welcome <?php  echo $usern['name']; ?></h3>
                    </div>
					<div class="row">
					<?php include('laws.php'); ?>
						<div class="col-lg-9">
						
							<div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fa fa-landmark"></i>
									
                                </div>
                             
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fa fa-users"></i></div>
                               </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-6">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fa fa-gavel"></i>
                                </div>
							</div>
                        </div>
                        
                    </div>
							
					<div class="row">
						<div class="col-12">
						<h4>Recent Requests</h4>
							<?php
							if($count_check>0)
							{
							?>
						<table class="table table-bordered">
							<tr>
								<td width="108">Client Name</td>
								<td width="56">Category</td>
								<td width="96">Case Details</td>
								<td width="115">Incident Date</td>
								<td width="165"></td>								
						    </tr>
							
							<?php
					while($row=$result->fetch_assoc())
					{
						$user_id=$row['user_id'];
						?>
							<tr>
								<td>
									<?php
									$sql_u="SELECT * FROM `user_details` WHERE user_id='$user_id'";
									$result_u=$con->query($sql_u);
									$row_u=$result_u->fetch_assoc();
									echo $row_u['name'];
									?>
								</td>
								<td><?php echo $row['category']; ?></td>
								<td><textarea style="width: 250px;"><?php echo $row['description']; ?></textarea></td>
								<td><?php echo $row['incident_date']; ?></td>
								<td>
									<a href="approve_cases_adv.php?id=<?php echo $row['id']; ?>" style="background-color: #aa9166; color: black;padding: 8px; margin-left: 5px; border-radius: 5px">View Details</a>
								</td>								
						    </tr>
						<?php } ?>
						</table>
							<?php } else { echo"<h5>No new Requests</h5>"; } ?>
					</div>
					</div>
					
						</div>
					</div>
                    
                </div>
            </div>
            <!-- Service End -->
            
				
            
            

            <!-- Footer Start -->
            <?php include('footer2.php'); } ?>
