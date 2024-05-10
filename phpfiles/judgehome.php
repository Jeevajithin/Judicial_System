<?php
include("user_auth.php");
if(!isset($user))
{
	echo "<script>window.location='../index.php'</script>";	
}
else
{
include('judge_header.php');
	
	$current_date=date("Y-m-d");
	
	$sql="SELECT cd.* FROM case_details cd JOIN hearing_schedule hs ON cd.case_id = hs.case_id WHERE hs.judge_id ='$user' AND hs.hearing_date = '$current_date' AND cd.case_status = 'Hearing' and hs.hearing_status='0' ";
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
						<h3>Today's Hearing</h3>
							<?php
$count=$result->num_rows;
if($count>0)
{
?>
						<table class="table table-bordered">
							<tr>
								<td width="108">Case Number</td>
								<td width="108">Case Title</td>
								<td width="56">Category</td>
								<td width="96">Case Details</td>
								<td width="115">Incident Date</td>
								<td width="165"></td>								
						    </tr>
							
							<?php
					while($row=$result->fetch_assoc())
					{
						?>
							<tr>
								<td><?php echo $row['case_number']; ?></td>
								<td><?php echo $row['case_title']; ?></td>
								<td><?php echo $row['category']; ?></td>
								<td><textarea style="width: 250px;"><?php echo $row['description']; ?></textarea></td>
								<td><?php echo $row['incident_date']; ?></td>
								<td>
									<a href="view_case_details.php?case_id=<?php echo $row['case_id'];  ?>" style="background-color: #aa9166; color: black;padding: 8px; margin-left: 5px; border-radius: 5px">View Details</a>
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
