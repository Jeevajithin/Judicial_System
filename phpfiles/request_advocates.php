<?php
include("user_auth.php");
include('user_header.php');
if(!isset($user))
{
	echo "<script>window.location='../index.php'</script>";	
}
else
{
$crud = new CRUD();
$table = 'case_details';

$sql = "SELECT * FROM `case_details` WHERE (user_id='$user' OR defendent_id='$user') AND case_id NOT IN (SELECT case_id FROM case_handling_advocates WHERE user_id='$user')";
$result = $con->query($sql);

$advocate_details = $crud->select_all("advocate_details");

if (isset($_REQUEST['req_id']) && isset($_REQUEST['advocate_id'])) {
    $case_id = $_REQUEST['req_id'];
    $advocate_id = $_REQUEST['advocate_id'];	
    $sql_check = "SELECT * FROM `case_handling_advocates` WHERE advocate_id='$advocate_id' AND case_id='$case_id'";
    $result_check = $con->query($sql_check);
    $count_check = $result_check->num_rows;

    if ($count_check > 0) {
        echo "<script>alert('Request already sent');</script>";
    } else {
        $data = array(
            'case_id' => $case_id,
            'advocate_id' => $advocate_id,
            'user_id' => $user,
            'status' => 0
        );
        $table = "case_handling_advocates";
        $inserted = $crud->insert($table, $data);

        if ($inserted) {
            echo "<script>alert('Your request has been sent');</script>";
            echo "<script>window.location.href='request_advocates.php'</script>";
        } else {
            echo "<script>alert('Failed! Please try again.');</script>";
        }
    }
}
?>

<!-- Nav Bar End -->
<!-- Service Start -->
<div class="service">
    <div class="container">
        <div class="section-header">
        <h3>Welcome <?php echo $usern['name']; ?></h3>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h4>My Recent Cases</h4>
                <table class="table table-bordered">
                    <tr>
                        <td>Defendant Name</td>
                        <td>Category</td>
                        <td>Case Details</td>
                        <td>Incident Date</td>
                        <td>Select an Advocate</td>
                    </tr>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['defendant_name']; ?></td>
                            <td><?php echo $row['category']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['incident_date']; ?></td>
                            <td>
                                <form method="post">
                                    <select name="advocate_id" class="form-control" required>
                                        <option value="">Select</option>
                                        <?php
                                        $sql = "SELECT * FROM `advocate_details` WHERE userid IN (SELECT id FROM `login_details` WHERE status=1 AND user_type='Advocate') AND userid NOT IN (SELECT advocate_id FROM case_handling_advocates WHERE case_id='" . $row['case_id'] . "')";
                                        $result_adv = $con->query($sql);
                                        while ($adv_row = $result_adv->fetch_assoc()) {
                                            echo "<option value='" . $adv_row['userid'] . "'>" . $adv_row['name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <input type="hidden" name="req_id" value="<?php echo $row['case_id']; ?>">
                                    <div align="right"><button type="submit" name="submit" style="background-color: #aa9166; color: black;padding: 2px; margin-left: 5px; border-radius: 5px">Submit</button></div>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->

<!-- Footer Start -->
<?php include('footer2.php'); } ?>
