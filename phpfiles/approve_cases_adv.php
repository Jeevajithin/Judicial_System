<?php
include("user_auth.php");
include('advocate_header.php');

$id=$_REQUEST['id'];

$sql="SELECT 
    cd.*,
    ua.*,
    ud.*
FROM 
    case_handling_advocates AS ua
JOIN
    case_details AS cd ON ua.case_id = cd.case_id
JOIN
    user_details AS ud ON ua.user_id = ud.user_id
WHERE
    ua.id = '$id'";

$result=$con->query($sql);
$row=$result->fetch_assoc();


if(isset($_REQUEST['ac_id']))
{
	$req_id=$_REQUEST['ac_id'];
	
	
	$sql_check="UPDATE `case_handling_advocates` SET `status` = '1' WHERE `case_handling_advocates`.`id` = '$req_id'";
	$result_check=$con->query($sql_check);
	$count_check=$con->affected_rows;
	
	if ($count_check>0) 
	{
		echo "<script>alert('You have accepted the case');</script>";

		echo "<script>window.location.href='view_request.php'</script>";
    } 
	else 
	{
        echo "<script>alert('Failed! Try again');</script>";
    }
		
}
if(isset($_REQUEST['rc_id']))
{
	$req_id=$_REQUEST['rc_id'];
	
	
	$sql_check="UPDATE `case_handling_advocates` SET `status` = '2' WHERE `case_handling_advocates`.`id` = '$req_id'";
	$result_check=$con->query($sql_check);
	$count_check=$con->affected_rows;
	
	if ($count_check>0) 
	{
		echo "<script>alert('You have rejected the case');</script>";

		echo "<script>window.location.href='view_request.php'</script>";
    } 
	else 
	{
        echo "<script>alert('Failed! Try again');</script>";
    }
		
}

?>
            <!-- Nav Bar End -->
            
            
            <!-- Carousel Start -->
            
            <!-- Carousel End -->
            
            
            <!-- Top Feature Start-->
            
            <!-- Top Feature End-->
            
            
            <!-- About Start -->
            
            <!-- About End -->


            <!-- Service Start -->
            <div class="service">
                <div class="container">
                    <div class="section-header">
					<h3>Welcome <?php echo $usern['name']; ?></h3>
                    </div>
					<div class="row">
					<?php include('laws.php'); ?>
						<div class="col-lg-9">
						
							<?php
						  
						  ?>
					<div class="row">
						<div class="col-12">
						<h4>Case Details</h4>
						<table class="table table-bordered">
							<tr>
								<td width="108">Defendant Name</td>
								<td width="108">Plaintiff Name</td>
								<td width="56">Category</td>
								<td width="96">Case Details</td>
								<td width="115">Incident Date</td>				
						    </tr>							
							<?php
					
											?>
							<tr>
								<td><?php echo $row['defendant_name']; ?></td>
								<td>
								<?php
									$pid=@$row['first_user_id']; 
									$sql2="SELECT * FROM `user_details` WHERE user_id='1'";
									$result2=$con->query($sql2);
									$row2=$result2->fetch_assoc();
						            echo $row2['name'];
									?>
								</td>
								<td><?php echo $row['category']; ?></td>
								<td><textarea style="width: 250px;"><?php echo $row['description']; ?></textarea></td>
								<td><?php echo $row['incident_date']; ?></td>							
						    </tr>						
						</table>
							<h4>Client Details</h4>
							<table class="table table-bordered">
							<tr>
								<td width="108">Client Name</td>
								<td width="56">email</td>
								<td width="96">Contact Number</td>
								<td width="115">Address</td>							
						    </tr>
							
							<?php
					
											?>
							<tr>
								<td><?php echo $row['name']; ?></td>
								<td><?php echo $row['email']; ?></td>
								<td><?php echo $row['phone']; ?></td>
								<td><?php echo $row['address']; ?></td>
							 						
						    </tr>						
						</table>
							
							
						  <div align="right">
							<a href="approve_cases_adv.php?ac_id=<?php echo $id; ?>&id=<?php echo $id; ?>" style="background-color: #aa9166; color: black;padding: 8px; margin-left: 5px; border-radius: 5px">Accept Case</a>
							<a href="approve_cases_adv.php?rc_id=<?php echo $id; ?>&id=<?php echo $id; ?>" style="background-color: #aa9166; color: black;padding: 8px; margin-left: 5px; border-radius: 5px">Reject</a>
							</div>
					</div>
					</div>

							
						</div>
					</div>
                    
                </div>
            </div>
            <!-- Service End -->
            

            <!-- Footer Start -->
            <?php include('footer2.php'); ?>





