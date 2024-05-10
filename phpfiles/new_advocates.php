<?php
include("user_auth.php");
include('adminheader.php');
if(!isset($user))
{
	echo "<script>window.location='../index.php'</script>";	
}
else
{
	if(isset($_REQUEST['update']))
	{
		if(isset($_REQUEST['aid']))
		{
			$uid=$_REQUEST['aid'];
			$sql1="UPDATE `login_details` SET `status` = '1' WHERE `login_details`.`id` = '$uid'";
		}
		else if(isset($_REQUEST['rid']))
		{
			$uid=$_REQUEST['rid'];
			$sql1="UPDATE `login_details` SET `status` = '2' WHERE `login_details`.`id` = '$uid'";
		}
		
		
		$result1=$con->query($sql1);
		
		if($result1)
		{
			echo "<script> alert('Status Updated!'); </script>";
			echo "<script> window.location.href='new_advocates.php'</script>";
		}
		else
		{
			echo "<script> alert('Failed!'); </script>";
		}
	}
?>
            
            <div class="service">
                <div class="container">
                    <div class="section-header">
					<h3>Welcome <?php echo $usern['name']; ?></h3>
                    </div>
					<div class="row">
						<div class="col-lg-3">
						<div class="side_panel_custom">
						<div class="col-md-12 col-lg-12">
                            <div class="footer-link">
                                <h2>Services Areas</h2>
                                <a href="">Civil Law</a>
                                <a href="">Family Law</a>
                                <a href="">Business Law</a>
                                <a href="">Education Law</a>
                                <a href="">Immigration Law</a>
                            </div>
                        </div>
						</div>
						</div>
						<div class="col-lg-9">
						
							<?php
						$sql1="SELECT * FROM `advocate_details` where userid in (SELECT id FROM login_details WHERE status=0 and user_type='Advocate')";
						$result1=$con->query($sql1);
						
						  ?>
					<div class="row">
						<div class="col-12">
						<h3>New Advocates</h3>
							<?php
$count=$result1->num_rows;
if($count>0)
{
?>
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
								  
								  <a href="new_advocates.php?aid=<?php echo $row1['userid']; ?>&update=1" style="background-color: #aa9166; color: black;padding: 8px; margin-left: 5px; border-radius: 5px">Approve</a>
								  
								<a href="new_advocates.php?rid=<?php echo $row1['userid']; ?>&update=1" style="background-color: #aa9166; color: black;padding: 8px; margin-left: 5px; border-radius: 5px">Reject</a>
								</td>
						    </tr>
						<?php } ?>
						</table>
							<?php } else {echo "<h6>No Advocate Details</h6>";} ?>
					</div>
					</div>

							
						</div>
					</div>
                    
                </div>
            </div>
     

            <!-- Footer Start -->
            <?php include('footer2.php'); } ?>
