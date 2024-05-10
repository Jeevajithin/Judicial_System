<?php
include("user_auth.php");
if(!isset($user))
{
	echo "<script>window.location='../index.php'</script>";	
}
else
{
	
include('advocate_header.php');
	
$case_id=$_REQUEST['case_id'];
	
$sql="SELECT * FROM user_details u JOIN case_details c ON u.user_id = c.user_id WHERE c.case_id = '$case_id'";
$result=$con->query($sql);
$row=$result->fetch_assoc();
	
$user_id=$row['user_id'];

$sql1="SELECT * FROM `advocate_details` WHERE userid in (SELECT advocate_id FROM case_handling_advocates WHERE user_id='$user_id' and case_id='$case_id')";
$result1=$con->query($sql1);
$row1=$result1->fetch_assoc();

$advocate_id=$row1['userid'];
	
$sql2="SELECT * FROM `case_documents` WHERE case_id='$case_id' and advocate_id='$advocate_id'";
$result2=$con->query($sql2);
	
$defendent_id=$row['defendent_id'];




	
?>          
            <!-- Service Start -->
            <div class="service">
                <div class="container">
                    <div class="section-header">
					<h3>Welcome <?php echo $usern['name']; ?></h3>
                    </div>
					<div class="row">
                        <div class="col-12">
                            <h2><?php echo $row['case_title']; ?> (<?php echo $row['case_number']; ?>)</h2>
                            <h3>Case Category: <?php echo $row['category']; ?></h3>
                            <h5>Incident Date: <?php echo $row['incident_date']; ?></h5>
                            <p>
                                <?php echo $row['description']; ?>
                          </p>
							<div class="row">
								<div class="col-6">
									<h5>Plaintiff Details</h5>
							
                            <table class="table table-bordered">
							<tr>
								<td width="108">Plaintiff Name</td>
								<td width="108"><?php echo $row['name']; ?></td>
							</tr>
							<tr>
								<td width="108">Address</td>
								<td width="108"><?php echo $row['address']; ?></td>
							</tr>
							<tr>
								<td width="108">Email Address</td>
								<td width="108"><?php echo $row['email']; ?></td>
							</tr>
							<tr>
								<td width="108">Advocate</td>
								<td width="108"><?php echo $row1['name']; ?></td>
							</tr>
							
						</table>
						<h5>Documents Details</h5>
						<table class="table table-bordered">
							<tr>
								<td width="108">Type</td>
								<td width="108">Description</td>
								<td width="108">Uploaded Date</td>
							</tr>
							<?php
							while($row2=$result2->fetch_assoc())
							{							
							?>
							<tr>
								<td width="108"><a href="../uploads/<?php echo $row2['file_name']; ?>" target="_blank"><?php echo $row2['document_type']; ?></a></td>
								<td width="108"><?php echo $row2['description_details']; ?></td>
								<td width="108"><?php echo $row2['upload_date']; ?></td>
							</tr>
							<?php
							}
								?>
						</table>
								</div>
								<div class="col-6">
									<h5>Defendent Details</h5>
									<?php
									if($defendent_id!=NULL)
									{
										
$sql_d="SELECT * FROM user_details u JOIN case_details c ON u.user_id = c.defendent_id WHERE c.case_id = '$case_id'";
$result_d=$con->query($sql_d);
$row_d=$result_d->fetch_assoc();
										
$sql1_d="SELECT * FROM `advocate_details` WHERE userid in (SELECT advocate_id FROM case_handling_advocates WHERE user_id='$defendent_id' and case_id='$case_id')";
$result1_d=$con->query($sql1_d);
$row1_d=$result1_d->fetch_assoc();

$advocate_id_d=$row1_d['userid'];
	
$sql2_d="SELECT * FROM `case_documents` WHERE case_id='$case_id' and advocate_id='$advocate_id_d'";
$result2_d=$con->query($sql2_d);
									
									?>
							
                            <table class="table table-bordered">
							<tr>
								<td width="108">Defendent Name</td>
								<td width="108"><?php echo $row_d['name']; ?></td>
							</tr>
							<tr>
								<td width="108">Address</td>
								<td width="108"><?php echo $row_d['address']; ?></td>
							</tr>
							<tr>
								<td width="108">Email Address</td>
								<td width="108"><?php echo $row_d['email']; ?></td>
							</tr>
							<tr>
								<td width="108">Advocate</td>
								<td width="108"><?php echo $row1_d['name']; ?></td>
							</tr>
						</table>
									
						<h5>Documents Details</h5>
						<table class="table table-bordered">
							<tr>
								<td width="108">Type</td>
								<td width="108">Description</td>
								<td width="108">Uploaded Date</td>
							</tr>
							<?php
							while($row2_d=$result2_d->fetch_assoc())
							{							
							?>
							<tr>
								<td width="108"><a href="../uploads/<?php echo $row2_d['file_name']; ?>" target="_blank"><?php echo $row2_d['document_type']; ?></a></td>
								<td width="108"><?php echo $row2_d['description_details']; ?></td>
								<td width="108"><?php echo $row2_d['upload_date']; ?></td>
							</tr>
							<?php
							}
								?>
						</table>
									<?php } else {echo "<p>No Defendent Details</p>";} ?>
								</div>
							</div>
                          
                            <h5>Recent Hearing Details</h5>
                          <ul class="list-group">
							<?php
								$i=1;
								$sql3="SELECT * FROM `hearing_schedule` WHERE case_id='$case_id'";
								$result3=$con->query($sql3);
								while($row3=$result3->fetch_assoc())
								{
							?>
							<li class="list-group-item">Hearing <?php echo $i; ?>: (<?php echo $row3['hearing_date']; ?>) :-- <?php echo $row3['description']; ?></li>

							<?php
									$hearing_id = $row3['hearing_id'];
									$i++;
								}
							?>
                                
                            </ul>
						<p>&nbsp;</p>
					<?php
	$sql_j="SELECT * FROM `judgement_details` WHERE case_id='$case_id'";
$result_j=$con->query($sql_j);
$count_j=$result_j->num_rows;
	if($count_j>0)
	{
	
$row_j=$result_j->fetch_assoc();
	
	
					?>
							
						<h3>Final Judgement: Date - <?php echo $row_j['judgement_date']; ?> </h3>
							 <h4 style="border: solid thin #05A836; background-color:#A5C7BB; color:#191717 ; padding: 10px;">
                              Court rules in favour of 
								<?php
								if($row['user_id']==$row_j['success_user_id'])
								{
									echo "plantiff: ". $row['name'];
								}
								else if($row_d['user_id']==$row_j['success_user_id'])
								{
									echo "defendant: ". $row_d['name'];
								}
								?>
                            </h4>
                            <h4 style="border: solid thin #96A1F4; background-color: #96A1F4; color:#191717 ; padding: 10px;">
                               Notes: <?php echo $row_j['judgement_notes']; ?>
                            </h4>
						 
							<h4 style="border: solid thin #96A1F4; background-color:#D48599; color:#191717 ; padding: 10px;">Penalty: <?php echo $row_j['judgement_penalty']; ?></h4>
							<?php } ?>
                      </div>
                    </div>
                    
                </div>
            </div>
            <!-- Service End -->
            
				
            
            

            <!-- Footer Start -->
            <?php include('footer2.php'); } ?>
