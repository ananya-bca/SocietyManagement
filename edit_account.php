<?php
/* This code is a PHP script that is used to edit a user account. */

session_start();
include 'config.php';

if (isset($_SESSION['mail']) && isset($_SESSION['pwd'])) {

$fid = $_GET['id'];
$select = "SELECT * FROM register WHERE member_id = {$fid}";
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
    <script src="./js/validation.js"></script>
    <title>Edit Account</title>
</head>
<body id="body-pd">
    <?php
        include 'functions.php';
        user_side_bar();
    ?>
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-5 m-auto mt-5" style="box-shadow: 1px 1px 8px 0 black; background-color: #f8f9fa;">
                <form action="" class="p-3" method="post" onsubmit="return edit_ac()">
                    <input type="hidden" name="member_id" value="<?php echo $row['member_id']; ?>">
                    <label for="flat_wing" class="form-label"><b>Name:</b></label>
                    <span class="text-danger" id="name_err"></span>
                    <input type="text" name="member_name" class="form-control" id="member_name" value="<?php echo $row['member_name'] ?>"><br>

                    <label for="flat_number" class="form-label"><b>Email Id:</b></label>
                    <span class="text-danger" id="mail_err"></span>
                    <input type="text" name="mail" class="form-control" id="email" value="<?php echo $row['mail'] ?>" readonly><br>

                    <label for="flat_floor" class="form-label"><b>Contact No.:</b></label>
                    <span class="text-danger" id="contact_err"></span>
                    <input type="text" name="contact" class="form-control" id="contact" value="<?php echo $row['contact'] ?>"><br>

                    <input type="hidden" name="pwd" value="<?php echo $row['pwd']; ?>">
                    <input type="hidden" name="wing" value="<?php echo $row['wing']; ?>">
                    <input type="hidden" name="flat_num" value="<?php echo $row['flat_num']; ?>">

                    <div class="modal-footer">
                        <input type="submit" name="submit" value="Edit" class="btn btn-success">
                        <a href="course.php" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
    }
}

if (isset($_POST['submit'])) {
    $id = $_POST['member_id'];
    $columnData = array(
        'member_name' => $_POST['member_name'],
        'mail' => $_POST['mail'],
        'contact' => $_POST['contact'],
        'pwd' => $_POST['pwd'],
        'wing' => $_POST['wing'],
        'flat_num' => $_POST['flat_num']
        // Add more columns as needed
    );
    include 'curd_functions.php';
    $result = updateData('register', $id, $columnData, 'member_id');

    if ($result) {
        // Form submission successful, display SweetAlert
        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>';
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
                $(document).ready(function(){
                    Swal.fire({
                        title: "Data Updated!",
                        text: "You data has been updated!",
                        icon: "success",
                        confirmButtonText: "Okay"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "user_account.php";
                        }
                    });
                });
            </script>';
        // Prevent further execution of PHP code
        exit();
    }
}
?>

</body>
</html>
<?php
}
else{
    header('location:user_login.php');
}
?>