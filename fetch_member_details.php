<?php
/* This code is a PHP script that handles a POST request to retrieve details of a member
from a database.  */

include 'config.php'; // Include your database connection file

if(isset($_POST['member_id'])) {
    $member_id = $_POST['member_id'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT member_name, wing, flat_number FROM members WHERE member_id = ?");
    $stmt->bind_param("i", $member_id);
    $stmt->execute();
    $stmt->bind_result($member_name, $wing, $flat_number);

    if ($stmt->fetch()) {
        $details = array(
            'member_name' => $member_name,
            'wing' => $wing,
            'flat_number' => $flat_number
        );
        echo json_encode($details);
    } else {
        echo json_encode(array('error' => 'Member not found'));
    }

    $stmt->close();
    $conn->close();
}
?>
