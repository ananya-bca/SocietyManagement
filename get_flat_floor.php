<?php
/* This code is a PHP script that handles a POST request. and get the flat_floor as per flat_number */

include 'config.php';

if (isset($_POST['flat_number'])) {
    $selectedFlatNumber = $_POST['flat_number'];
    
    // Fetch flat floor based on the selected flat number
    $sql = "SELECT flat_floor FROM flat WHERE flat_number = '$selectedFlatNumber'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Return the flat floor value
        $row = mysqli_fetch_assoc($result);
        echo $row['flat_floor'];
    } else {
        echo 'Error fetching flat floor';
    }
} else {
    echo 'Invalid request';
}
?>
