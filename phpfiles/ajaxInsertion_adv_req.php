<?php 
include("user_auth.php");

if(isset($_POST["advocate"]) && isset($_POST["case_id"])) {
    $advocate = $_POST["advocate"];
    $case_id = $_POST["case_id"];



    $crud = new CRUD();
    $data = array(
        'case_id' => $case_id,
        'advocate_id' => $advocate,
        'user_id' => $user,
        'status' => 0      
    );
    $table = "case_handling_advocates";
    $inserted = $crud->insert($table, $data);

    if($inserted) {
        echo "true";
    } else {
        echo "false";
    }
} else {
    echo "false";
}
?>
