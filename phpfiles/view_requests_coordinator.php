<?php
include("user_auth.php");
include('coordinator_header.php');


$sql="SELECT cd.*, ch.* FROM case_handling_advocates ch JOIN case_details cd ON ch.case_id = cd.case_id WHERE cd.case_status = 'Requesting'";
$result=$con->query($sql);

?>
           
        <!-- Service Start -->
            <div class="service">
                <div class="container">
                    <div class="section-header">
					<h3>Welcome <?php echo $usern['name']; ?></h3>
                    </div>
					<div class="row">
						
						<div class="col-lg-12">
						
							<?php
						  
						  ?>
					<div class="row">
						<div class="col-12">
						<h4>New Requests</h4>
							<?php
$count=$result->num_rows;
if($count>0)
{
?>
						<table class="table table-bordered">
							<tr>
								<td width="108">Plaintiff Name</td>
								<td width="108">Defendant Name</td>
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
								<td><?php echo $row['defendant_name']; ?></td>
								<td><?php echo $row['category']; ?></td>
								<td><textarea style="width: 250px;"><?php echo $row['description']; ?></textarea></td>
								<td><?php echo $row['incident_date']; ?></td>
								<td>
									<a href="schedule_hearing.php?case_id=<?php echo $row['case_id']; ?>&case_han_id=<?php echo $row['id']; ?>" style="background-color: #aa9166; color: black;padding: 8px; margin-left: 5px; border-radius: 5px">Schedule Hearing</a>
								</td>								
						    </tr>
						<?php } ?>
						</table>
							<?php } else {echo "<h6>No Details</h6><p></p><p></p><p></p>";} ?>
					</div>
					</div>
				
			<?php 	 ?>
							
						</div>
					</div>
                    
                </div>
            </div>
            <!-- Service End -->
            

            <!-- Footer Start -->
            <?php include('footer2.php'); ?>

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



