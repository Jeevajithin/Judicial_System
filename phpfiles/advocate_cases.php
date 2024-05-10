<?php
include("user_auth.php");
include('advocate_header.php');

$sql="SELECT cd.*, ch.* FROM case_handling_advocates ch JOIN case_details cd ON ch.case_id = cd.case_id WHERE ch.advocate_id = '$user' AND ch.status = 1 and case_status!='Closed'";
$result=$con->query($sql);
?>

<!-- Service Start -->
<div class="service">
    <div class="container">
        <div class="section-header">
        <h3>Welcome <?php echo $usern['name']; ?></h3>
        </div>
        <div class="row">
        <?php include('laws.php'); ?>
            <div class="col-lg-9">
                <?php if ($result->num_rows > 0) { ?>
                <div class="row">
                  <div class="col-12">
                    <h4>All Cases</h4>
                      <table class="table table-bordered" id="example">
                          <thead>
                              <tr>
                                  <th width="114">Defendant Name</th>
                                  <th width="62">Category</th>
                                  <th width="70">Case Details</th>
                                  <th width="87">Incident Date</th>
                                  <th width="117">Action</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php while($row = $result->fetch_assoc()) { ?>
                              <tr>
                                  <td><?php echo $row['defendant_name']; ?></td>
                                  <td><?php echo $row['category']; ?></td>
                                  <td><textarea style="width: 250px;"><?php echo $row['description']; ?></textarea></td>
                                  <td><?php echo $row['incident_date']; ?></td>
                                  <td>
                                      <a href="add_case_study.php?case_han_id=<?php echo $row['id']; ?>&case_id=<?php echo $row['case_id']; ?>" style="background-color: #aa9166; color: black;padding: 8px; margin-left: 5px; border-radius: 5px">Add Details</a>
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
