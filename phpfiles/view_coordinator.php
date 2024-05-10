<?php
include("user_auth.php");
include('adminheader.php');
if(!isset($user))
{
	echo "<script>window.location='../index.php'</script>";	
}
else
{
$crud = new CRUD();
$table = 'coordinator_details';

$all_judges_details = $crud->select_all($table);
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
						  if ($all_judges_details) {
						  ?>
					<div class="row">
						<div class="col-12">
						<h3>Coordinator Details</h3>
						<table width="24%" class="table table-bordered">
							
							<?php
					foreach ($all_judges_details as $detail) {
						?>
						<tr>
							  <th width="23%" scope="col">Gender</th>
							  <th width="23%" scope="col"><?php echo $detail['gender']; ?></th>
						    </tr>
							<tr>
							  <th scope="col">Email</th>
							  <th scope="col"><?php echo $detail['email']; ?></th>
						    </tr>
							<tr>
							  <th scope="col">Phone</th>
							  <th scope="col"><?php echo $detail['phone']; ?></th>
						    </tr>
							<tr>
							  <th height="55" scope="col">Experience</th>
							  <th scope="col"><?php echo $detail['experience']; ?></th>
						    </tr>
						<?php } ?>
						</table>
					</div>
					</div>
				
			<?php } ?>
							
						</div>
					</div>
                    
                </div>
            </div>
            <!-- Service End -->
            
				
            
            

            <!-- Footer Start -->
            <?php include('footer2.php'); } ?>
