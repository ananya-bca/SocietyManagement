<?php
/* The above code is a PHP script that handles the editing of wing information in a database. It starts
by checking if the user is logged in as an admin. If not, it redirects them to the admin login page. */

session_start();
include 'config.php';

if (isset($_SESSION['admin_email']) && isset($_SESSION['admin_pwd'])) {

$id = $_GET['id'];

if (isset($_POST['submit'])) {
    $submittedWing = $_POST['wing'];

    // Check if the submitted wing already exists
    $checkQuery = "SELECT * FROM wing WHERE wing = '$submittedWing'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $error[] = "Wing already exists!";
    } else {
        // Continue with the update logic
        $id = $_POST['wing_id'];
        $columnData = array(
            'wing' => $submittedWing
        );

        include 'curd_functions.php';
        $result = updateData('wing', $id, $columnData, 'wing_id');

        if ($result) {
            // Form submission successful, display SweetAlert
            echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>';
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>
                $(document).ready(function(){
                    Swal.fire({
                        title: "Wing updated!",
                        text: "You updated the wing!",
                        icon: "success",
                        confirmButtonText: "Okay"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "wing.php";
                        }
                    });
                });
            </script>';
            // Prevent further execution of PHP code
            exit();
        }
    }
}


$select = "SELECT * FROM wing WHERE wing_id = {$id}";
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
    <title>Edit Wing</title>
</head>

<body id="body-pd">
    <?php
    include 'functions.php';
    side_bar();
    ?>
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-5 m-auto mt-5" style="box-shadow: 1px 1px 8px 0 black; background-color: #f8f9fa;">
                <form action="" class="p-3" method="post" onsubmit="return wng()">
                    <?php
                    if (isset($error)) {
                        foreach ($error as $error) {
                            echo '<p class="btn btn-danger">' . $error . '</p><br>';
                        }
                    }
                    ?>
                    <input type="hidden" name="wing_id" value="<?php echo $row['wing_id']; ?>" required><br><br>
                    <label for="wing" class="form-label"><b>Flat wing:</b></label>
                    <span class="text-danger" id="wing_err"></span>
                    <input type="text" name="wing" id="wing" class="form-control" value="<?php echo $row['wing'] ?>"><br>

                    <div class="modal-footer">
                        <input type="submit" name="submit" value="Edit" class="btn btn-success">
                        <a href="wing.php" class="btn btn-danger">Cancel</a>
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
