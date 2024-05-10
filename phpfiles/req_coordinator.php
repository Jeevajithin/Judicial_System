<?php
include("user_auth.php");
include('advocate_header.php');


$sql="SELECT cd.*, ch.*, cd.user_id AS first_user_id  FROM case_handling_advocates ch JOIN case_details cd ON ch.case_id = cd.case_id WHERE ch.advocate_id = '$user' AND ch.status = 1 and cd.case_status='Pending'";
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
						<h4>New Cases to File</h4>
						<table class="table table-bordered" id="example">
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
						?>
							<tr>
								<td>
									<?php
									$pid=$row['first_user_id']; 
									$sql2="SELECT * FROM `user_details` WHERE user_id='$pid'";
									$result2=$con->query($sql2);
									$row2=$result2->fetch_assoc();
						            echo $row2['name'];
									?>
								</td>
								<td><?php echo $row['defendant_name']; ?></td>
								<td><?php echo $row['category']; ?></td>
								<td><textarea style="width: 250px;"><?php echo $row['description']; ?></textarea></td>
								<td><?php echo $row['incident_date']; ?></td>
								<td>
									<a href="update_case_adv.php?req_case_id=<?php echo $row['case_id']; ?>" style="background-color: #aa9166; color: black;padding: 8px; margin-left: 5px; border-radius: 5px">File Case to Court</a>
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
            <?php include('footer2.php'); ?>
<script type="text/javascript">
			$(document).ready( function () {
    $('#example').DataTable();
} );
			</script>



