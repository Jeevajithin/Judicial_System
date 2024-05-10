<?php
include("user_auth.php");
include('adminheader.php');
if(!isset($user))
{
	echo "<script>window.location='../index.php'</script>";	
}
else
{
		$sql="SELECT * FROM `user_details`";
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
						<table class="table table-bordered">
							<tr>
								<td width="125">Name</td>
								<td width="125">Email</td>
								<td width="61">Contact Number</td>
								<td width="85">Address</td>
															
						    </tr>
							
							<?php
					while($row=$result->fetch_assoc())
					{
						?>
							<tr>
								<td><?php echo $row['name']; ?>
								<br><small><a href="../uploads/user/215602843NF.PNG" target="_blank">Click here to view Id proof</a></small>
								</td>
								<td><?php echo $row['email']; ?></td>
								<td><?php echo $row['phone']; ?></td>
								<td><?php echo $row['address']; ?></td>
																
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
