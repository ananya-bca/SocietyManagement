<?php
/* The code you provided is a PHP script that handles the reply functionality for a complaint in an
admin panel. Here's a breakdown of what the code does: */

session_start();
include 'config.php';
include 'curd_functions.php';

if (isset($_SESSION['admin_email']) && isset($_SESSION['admin_pwd'])) {

$id = $_GET['id'];

$error = [];

if (isset($_POST['save'])) {
    $res = savedata($_POST, 'comp_reply');
    $update = "UPDATE complain SET status = 'solved' WHERE complain_id = '$id'";
    $rs = mysqli_query($conn, $update);
    if ($res) {
        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>';
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
            $(document).ready(function(){
                Swal.fire({
                    title: "Message Sent!",
                    text: "You replied complain!",
                    icon: "success",
                    confirmButtonText: "Okay"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "complaints.php";
                    }
                });
            });
        </script>';
        // Prevent further execution of PHP code
        exit();
    }
}

$select = "SELECT * FROM complain WHERE complain_id = $id";
$result = mysqli_query($conn, $select);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/logo.webp">
    <title>Comaplain Reply</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
                <form action="" class="p-3" method="post">
                    <label for="complain_id" class="form-label"><b style="font-size:20px;">Complain Id:</b></label>
                    <input type="text" name="complain_id" class="form-control" value="<?php echo $row['complain_id']; ?>" readonly><br>
                    <label for="member_id" class="form-label"><b style="font-size:20px;">Member Id:</b></label>
                    <input type="text" name="member_id" class="form-control" value="<?php echo $row['member_id']; ?>" readonly><br>
                    <label for="member_id" class="form-label"><b style="font-size:20px;">Subject:</b></label>
                    <input type="text" name="subject" class="form-control" value="<?php echo $row['subject']; ?>" readonly><br>
                    <label for="reply_msg" class="form-label"><b style="font-size:20px;">Message:</b></label>
                    <textarea name="reply_msg" class="form-control" rows="3" minlength="20" maxlength="150" required></textarea><br>

                    <div class="modal-footer">
                        <input type="submit" value=" Send " name="save" class="btn btn-success">
                        <a href="complaints.php" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php
}
}
else{
    header('location:admin_login.php');
}
?>
