<?php
include("user_auth.php");
include('adminheader.php');
if(!isset($user))
{
	echo "<script>window.location='../index.php'</script>";	
}
else
{
?>
            
            <div class="service">
                <div class="container">
                    <div class="section-header">
					<h3>Welcome <?php echo $usern['name']; ?></h3>
                    </div>
					<div class="row">
					<?php include('laws.php'); ?>
						<div class="col-lg-9">
						
							<?php
						$sql1="SELECT * FROM `advocate_details` where userid in (SELECT id FROM login_details WHERE status=1 and user_type='Advocate')";
						$result1=$con->query($sql1);
						
						  ?>
					<div class="row">
						<div class="col-12">
						<h3>New Advocates</h3>
						<table class="table table-bordered">
							
							<?php
							while($row1=$result1->fetch_assoc()) 
							{
							?>
						<tr>
							  <td width="20%" rowspan="4" scope="col"><img src="../uploads/<?php echo $row1['photo']; ?>" width="130">
								<br><?php echo $row1['name']; ?>
								</td>
							  <td width="23%" scope="col">Licence Number</td>
							  <td width="23%" scope="col"><?php echo $row1['licence_number']; ?></td>
							  <td width="22%" scope="col"><?php echo $row1['qualification']; ?></td>
							</tr>
							<tr>
							  <td scope="col">Email</td>
							  <td scope="col"><?php echo $row1['email']; ?></td>
							  <td width="22%" scope="col">&nbsp;</td>
						    </tr>
							<tr>
							  <td scope="col">Phone</td>
							  <td scope="col"><?php echo $row1['phone']; ?></td>
							  <td width="22%" scope="col">
								  <small><a href="../uploads/<?php echo $row1['id_proof']; ?>" target="_blank">Click to view ID Proof</a></small>
								</td>
						    </tr>
							<tr>
							  <td height="55" scope="col">Bar Association</td>
							  <td scope="col"><?php echo $row1['bar_association']; ?></td>
							  <td width="22%" scope="col">
								 
								</td>
						    </tr>
						<?php } ?>
						</table>
					</div>
					</div>

							
						</div>
					</div>
                    
                </div>
            </div>
            <!-- Service End -->
            
				
            
            

            <!-- Footer Start -->
            <?php include('footer2.php'); } ?>
