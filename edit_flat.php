<?php
/* The above code is a PHP script that handles the editing of flat information in a database. It starts
by checking if the user is logged in as an admin. If not, it redirects them to the admin login page. */

session_start();
include 'config.php';
include 'curd_functions.php';

if (isset($_SESSION['admin_email']) && isset($_SESSION['admin_pwd'])) {

$id = $_GET['id'];

if (isset($_POST['submit'])) {
    $submittedWing = $_POST['flat_wing'];
    $submittedNumber = $_POST['flat_number'];
    $submittedFloor = $_POST['flat_floor'];

    // Check if the submitted flat already exists
    $checkQuery = "SELECT * FROM flat WHERE flat_wing = '$submittedWing' AND flat_number = '$submittedNumber' AND flat_floor = '$submittedFloor'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $error[] = "Flat already exists!";
    } else {
        // Continue with the update logic
        $id = $_POST['flat_id'];
        $columnData = array(
            'flat_wing' => $submittedWing,
            'flat_number' => $submittedNumber,
            'flat_floor' => $submittedFloor,
            'status' => $_POST['status']
        );

        include 'curd_functions.php';
        $result = updateData('flat', $id, $columnData, 'flat_id');

        if ($result) {
            // Form submission successful, display SweetAlert
            echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>';
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>
                $(document).ready(function(){
                    Swal.fire({
                        title: "Flat updated!",
                        text: "Your flat information updated!",
                        icon: "success",
                        confirmButtonText: "Okay"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "flats.php";
                        }
                    });
                });
            </script>';
            // Prevent further execution of PHP code
            exit();
        }
    }
}


$select = "SELECT * FROM flat WHERE flat_id = {$id}";
$result = mysqli_query($conn, $select);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/logo.webp">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/d07f35fca2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/stl.css">
    <script src="./js/script.js"></script>
    <style>
        form {
            padding: 20px;
        }
    </style>
    <title>Edit Flat Info</title>
</head>

<body id="body-pd">
    <?php
    include 'functions.php';
    side_bar();
    ?>
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-9 m-auto mt-5" style="box-shadow: 1px 1px 8px 0 black; background-color: #f8f9fa;">
                <form action="" class="p-3" method="post" onSubmit="return flat()">
                    <h2 class="h-2">Edit Flat Info</h2>
                    <hr>
                    <?php
                    if (isset($error)) {
                        foreach ($error as $error) {
                            echo '<p class="btn btn-danger">' . $error . '</p><br>';
                        }
                    }
                    ?>
                    <input type="hidden" name="flat_id" value="<?php echo $row['flat_id']; ?>" required><br><br>
                    <label for="wing" class="form-label"><b>Flat wing:</b></label>
                    <span class="text-danger" id="wing_err"></span>
                    <select name="flat_wing" class="form-select" id="wing">
                        <?php
                        $sql = "SELECT wing FROM wing";
                        $result = mysqli_query($conn, $sql);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($courseRow = mysqli_fetch_assoc($result)) {
                                $optionValue = $courseRow['wing'];
                                $selected = ($optionValue == $row['flat_wing']) ? 'selected' : '';
                        ?>
                                <option value="<?php echo $optionValue; ?>" <?php echo $selected; ?>><?php echo $optionValue; ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                    <label for="flat_number" class="form-label"><b>Flat number:</b></label>
                    <span class="text-danger" id="flat_err"></span>
                    <input type="text" id="flat_number" name="flat_number" class="form-control" value="<?php echo $row['flat_number'] ?>"><br>
                    <label for="flat_floor" class="form-label"><b>Flat floor:</b></label>
                    <span class="text-danger" id="floor_err"></span>
                    <input type="text" id="flat_floor" name="flat_floor" class="form-control" value="<?php echo $row['flat_floor'] ?>"><br>
                    <label for="status" class="form-label">Status:</label>
                    <select name="status" id="status" class="form-select">
                        <?php
                        $sql = "SELECT status FROM flat WHERE flat_id = {$row['flat_id']}";
                        $result = mysqli_query($conn, $sql);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($statusRow = mysqli_fetch_assoc($result)) {
                                $optionValue = $statusRow['status'];
                                $selected = ($optionValue == $row['status']) ? 'selected' : '';
                        ?>
                                <option value="<?php echo $optionValue; ?>" <?php echo $selected; ?>><?php echo $optionValue; ?></option>
                        <?php
                                if ($row['status'] == "Available") {
                        ?>
                                    <option value="Booked">Booked</option>
                                <?php
                                } else {
                                ?>
                                    <option value="Available">Available</option>
                        <?php
                                }
                            }
                        }
                        ?>
                    </select>

                    <div class="modal-footer">
                        <input type="submit" name="submit" value="Edit" class="btn btn-success">
                        <a href="flats.php" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="./js/validation.js"></script>
</body>

</html>
<?php
    }
}
}
else{
  header('location:admin_login.php');
}
?>
