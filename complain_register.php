<?php
/* The code you provided is a PHP script that registers a complaint form for a user who is logged in.
Here is a breakdown of what the code does: */

session_start();
include 'config.php';

if (isset($_SESSION['mail']) && isset($_SESSION['pwd'])) {
$mail = $_SESSION['mail'];

$select = "SELECT * FROM members WHERE email = '{$mail}'";
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
    <title>Complain Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/d07f35fca2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="./css/stl.css">
    <script src="./js/script.js"></script>
</head>

<body id="body-pd">
    <?php
    include 'functions.php';
    user_side_bar();
    ?>
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-5 m-auto mt-5" style="box-shadow: 1px 1px 8px 0 black; background-color: #f8f9fa;">
                <form action="" class="p-3" method="post" onsubmit="return complain()">
                    <h2 class="h-2">Register your complain</h2>
                    <hr>
                    <input type="hidden" name="member_id" value="<?php echo $row['member_id']; ?>">
                    <input type="hidden" name="member_name" value="<?php echo $row['member_name']; ?>">

                    <label for="sub" class="form-label"><b style="font-size:20px;">Subject</b></label>
                    <span class="text-danger" id="sub_err"></span><br>
                    <input type="text" name="subject" id="sub" class="form-control"><br>

                    <label for="date" class="form-label"><b style="font-size:20px;">Date</b></label>
                    <input type="date" name="complain_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly><br>

                    <label for="msg" class="form-label"><b style="font-size:20px;">Message</b></label>
                    <span class="text-danger" id="msg_err"></span><br>
                    <textarea name="message" class="form-control" id="msg" rows="3"></textarea><br>
                    <input type="hidden" name="status" value="unsolved">
                    <div class="modal-footer">
                        <input type="submit" value="Register" name="register" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="validation.js"></script>
    <?php
    }
} else {
    echo "error.";
}

include 'config.php';
include 'curd_functions.php';

if (isset($_POST['register'])) {
    $res = savedata($_POST, 'complain');
    if ($res) {
?>
        <script>
            Swal.fire({
                title: "Complain Registered!",
                text: "Your complain has been registered!",
                icon: "success",
                confirmButtonText: "Okay"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'complain_register.php';
                }
            });
        </script>
<?php
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