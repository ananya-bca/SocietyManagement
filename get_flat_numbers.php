<?php
/* This code is a PHP script that handles a POST request. and get the avilable flat_numbers as per flat_wing. */

include 'config.php';

if (isset($_POST['wing'])) {
    $selectedWing = $_POST['wing'];
    
    // Fetch flat numbers based on the selected wing
    $sql = "SELECT flat_number FROM flat WHERE flat_wing = '$selectedWing' && status = 'Available'";
    $result = mysqli_query($conn, $sql);
    echo "<option value='dis' selected disabled>-- select -- </option>";
    if ($result) {
        // Return options for the flat number dropdown
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='{$row['flat_number']}'>{$row['flat_number']}</option>";
        }
    } else {
        echo "<option value=''>Error fetching flat numbers</option>";
    }
} else {
    echo "<option value=''>Invalid request</option>";
}
?>
