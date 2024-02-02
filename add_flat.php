<?php

/* The given code is a PHP script that handles the form submission for adding a new flat. Here's a
breakdown of what the code does: */

session_start();
include 'config.php';
include 'curd_functions.php';
if (isset($_SESSION['admin_email']) && isset($_SESSION['admin_pwd'])) {

$error = [];
if (isset($_POST['save'])) {
    $flatNumber = $_POST['flat_number'];
    $flatWing = $_POST['flat_wing'];

    $select = "SELECT * FROM flat WHERE flat_number = '$flatNumber' AND flat_wing = '$flatWing'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $error[] = "Flat already exists!";
    } else {
        $res = savedata($_POST, 'flat');
        if ($res) {
            // Form submission successful, display SweetAlert
            echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>';
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>
                $(document).ready(function(){
                    Swal.fire({
                        title: "Flat added!",
                        text: "You added the flat!",
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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/logo.webp">
    <title>Add Flat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/d07f35fca2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/stl.css">
    <script src="./js/script.js"></script>
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
                    <h2 class="h-2">Add New Flat</h2>
                    <hr>
                    <?php
                    if (!empty($error)) {
                        foreach ($error as $individualError) {
                            echo '<p class="btn btn-danger">' . $individualError . '</p><br>';
                        }
                    }                    
                    ?>
                    <label for="wing" class="form-label"><b style="font-size:20px;">Enter Wing:</b></label>
                    <span class="text-danger" id="wing_err"></span>
                    <select name="flat_wing" id="wing" class="form-select">
                        <option value="dis" selected disabled>--select--</option>

                        <?php
                        $sql = "SELECT wing FROM wing";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <option value="<?php echo $row['wing']; ?>">
                        <?php echo $row['wing']; ?>
                        </option>
                        <?php
                        }
                        }   
                        ?>
                    </select>

                    <label for="flat_number" class="form-label"><b style="font-size:20px;">Enter Flat number:</b></label>
                    <span class="text-danger" id="flat_err"></span>
                    <input type="number" name="flat_number" id="flat_number" class="form-control"><br>

                    <label for="flat_floor" class="form-label"><b style="font-size:20px;">Enter Flat Floor:</b></label>
                    <span class="text-danger" id="floor_err"></span>
                    <input type="number" name="flat_floor" id="flat_floor" class="form-control"><br>

                    <input type="hidden" name="status" id="status" class="form-control" value="Available"><br>

                    <div class="modal-footer">
                        <input type="submit" value="Save" name="save" class="btn btn-success">
                        <a href="flats.php" class="btn btn-danger">Cancel</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script src="validation.js"></script>
</body>

</html>
<?php
}
else{
    header('location:admin_login.php');
}
?>