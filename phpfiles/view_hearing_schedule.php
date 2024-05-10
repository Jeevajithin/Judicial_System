<?php
include("user_auth.php");
include('judge_header.php');
if(!isset($user))
{
	echo "<script>window.location='../index.php'</script>";	
}
else
{
	$current_date=date("Y-m-d");
	
	$sql="SELECT cd.* FROM case_details cd JOIN hearing_schedule hs ON cd.case_id = hs.case_id WHERE hs.judge_id ='$user' AND hs.hearing_date = '$current_date' AND cd.case_status = 'Hearing' and hs.hearing_status='0' ";
	
	$result=$con->query($sql);
	$count_check=$result->num_rows;
	
	if(isset($_REQUEST['search']))
	{
		
		$current_date=$_POST['date'];
		
		$sql="SELECT cd.* FROM case_details cd JOIN hearing_schedule hs ON cd.case_id = hs.case_id WHERE hs.judge_id ='$user' AND hs.hearing_date = '$current_date' AND cd.case_status = 'Hearing' and hs.hearing_status='0' ";
$result=$con->query($sql);
		$count=$result->num_rows;
	}
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
						
							<div class="row">
								<div class="col-md-8"></div>
								<div class="col-md-4"><div class="contact-form">
<form enctype="multipart/form-data" method="post" action="">
<div class="form-group">
    <label for="exampleInputPassword1">Incident Date</label>
    <input type="date" class="form-control" id="exampleInputPassword1" placeholder="" name="date">
</div>				
<div align="right"><button type="submit" name="search">Search</button></div>								
	
</form>
                            </div></div>
							</div>
							<hr>
							<p></p>
							<h4>Upcoming Hearing Schedule</h4>
							<?php
							if($count_check>0 || @$count>0)
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
									<a href="view_case_details_j.php?case_id=<?php echo $row['case_id'];  ?>" style="background-color: #aa9166; color: black;padding: 8px; margin-left: 5px; border-radius: 5px">View Details</a>
								</td>								
						    </tr>
						<?php } ?>
						</table>
							<?php } else{ echo "<h6>No Hearing scheduled</h6>";} ?>
					</div>
					</div>

							
						</div>
					</div>
                    
                </div>
            </div>
            <!-- Service End -->
            
				
            
            

            <!-- Footer Start -->
            <?php include('footer2.php'); } ?>
