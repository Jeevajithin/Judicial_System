<?php
include("user_auth.php");
include('advocate_header.php');

$sql="SELECT cd.*, ch.* FROM case_handling_advocates ch JOIN case_details cd ON ch.case_id = cd.case_id WHERE ch.advocate_id = '$user' AND ch.status = 1 and case_status='Closed'";
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
              <?php if ($result->num_rows > 0) { ?>
              <div class="row">
                  <div class="col-12">
                    <h4>Closed Cases</h4>
                      <table class="table table-bordered" id="example">
                          <thead>
                              <tr>
                                  <th width="114">Defendant Name</th>
                                  <th width="62">Category</th>
                                  <th width="70">Case Details</th>
                                  <th width="87">Incident Date</th>
								  <th width="87">Closed Date</th>
								  <th width="87">Status</th>
                                  <th width="117">Action</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php 
							while($row = $result->fetch_assoc()) {
								
							$case_id=$row['case_id'];
	
							$sql1="SELECT * FROM `judgement_details` where case_id='$case_id'";
							$result1=$con->query($sql1);
							$row1 = $result1->fetch_assoc();
	
								$success_user=$row1['success_user_id'];
		
		$sql2="SELECT * FROM `case_handling_advocates` WHERE case_id='$case_id' and advocate_id='$user' and user_id='$success_user' and status=1";
							$result2=$con->query($sql2);
								$count=$result2->num_rows;
							
								
							  
							  ?>
                              <tr>
                                  <td><?php echo $row['defendant_name']; ?></td>
                                  <td><?php echo $row['category']; ?></td>
                                  <td><textarea style="width: 250px;"><?php echo $row['description']; ?></textarea></td>
                                  <td><?php echo $row['incident_date']; ?></td>
								  <td><?php echo $row1['judgement_date']; ?></td>
								  <td><?php if($count>0){echo "<h5 style='color:green;'>Success</h5>";} else { echo "<h5 style='color:red;'>Failed</h5>";}?></td>
                                  <td>
                                      <a href="view_case_details_a.php?case_id=<?php echo $row['case_id'];  ?>" style="background-color: #aa9166; color: black;padding: 8px; margin-left: 5px; border-radius: 5px">View Details</a>
                                  </td>
                              </tr>
                              <?php } ?>
                          </tbody>
                      </table>
                    </div>
                </div>
                <?php } else { ?>
                <div class="alert alert-info" role="alert">No cases found.</div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->

<!-- Footer Start -->
<?php include('footer2.php'); ?>

<script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
