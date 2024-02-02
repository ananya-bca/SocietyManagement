<?php
/* The above code is a PHP script that handles the editing of member information in a database. It starts
by checking if the user is logged in as an admin. If not, it redirects them to the admin login page. */

session_start();
include 'config.php';
include 'curd_functions.php';

if (isset($_SESSION['admin_email']) && isset($_SESSION['admin_pwd'])) {

$fid = $_GET['id'];

if (isset($_POST['submit'])) {
    $id = $_POST['flat_id'];
    $columnData = array(
        'member_name' => $_POST['member_name'],
        'email' => $_POST['email'],
        'contact' => $_POST['contact'],
        'wing' => $_POST['wing'],
        'flat_number' => $_POST['flat_number'],
        'floor_number' => $_POST['floor_number'],
        'date' => $_POST['date']
    );
    $result = updateData('members', $id, $columnData, 'member_id');

    if ($result) {
        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>';
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
            $(document).ready(function(){
                Swal.fire({
                    title: "Updated!",
                    text: "Member information updated!",
                    icon: "success",
                    confirmButtonText: "Okay"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "members.php";
                    }
                });
            });
        </script>';
        // Prevent further execution of PHP code
        exit();
    }
}

$select = "SELECT * FROM members WHERE member_id = {$fid}";
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
    <title>Edit Member Info</title>
</head>

<body id="body-pd">
    <?php
    include 'functions.php';
    side_bar();
    ?>
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-9 m-auto mt-5" style="box-shadow: 1px 1px 8px 0 black; background-color: #f8f9fa;">
                <form action="" class="p-3" method="post" onsubmit="return member()">
                    <h2 class="h-2">Edit Member Info</h2>
                    <hr>
                    <?php
                    if (!empty($error)) {
                        foreach ($error as $error) {
                            echo '<p class="btn btn-danger">' . $error . '</p><br>';
                        }
                    }
                    ?>
                    <input type="hidden" name="flat_id" value="<?php echo $row['member_id']; ?>" required><br><br>
                    <div class="row">
                        <div class="col">
                            <label for="member_name" class="form-label"><b>Member name:</b></label>
                            <span class="text-danger" id="name_err"></span>
                            <input type="text" name="member_name" class="form-control" id="member_name" value="<?php echo $row['member_name'] ?>"><br>
                        </div>
                        <div class="col">
                            <label for="email" class="form-label"><b>Member email:</b></label>
                            <span class="text-danger" id="mail_err"></span>
                            <input type="email" name="email" class="form-control" id="email" value="<?php echo $row['email'] ?>"><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="contact" class="form-label"><b>Contact:</b></label>
                            <span class="text-danger" id="contact_err"></span>
                            <input type="text" name="contact" class="form-control" id="contact" value="<?php echo $row['contact'] ?>"><br>
                        </div>
                        <div class="col">
                            <label for="wing" class="form-label"><b>Flat wing:</b></label>
                            <span class="text-danger" id="wing_err"></span>
                            <input type="text" name="wing" class="form-control" id="wing" value="<?php echo $row['wing'] ?>" readonly><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="flat_number" class="form-label"><b>Flat number:</b></label>
                            <span class="text-danger" id="flat_err"></span>
                            <input type="text" name="flat_number" class="form-control" id="flat_number" value="<?php echo $row['flat_number'] ?>" readonly><br>
                        </div>
                        <div class="col">
                            <label for="floor_number" class="form-label"><b>Flat floor:</b></label>
                            <span class="text-danger" id="floor_err"></span>
                            <input type="text" name="floor_number" class="form-control" id="floor_number" value="<?php echo $row['floor_number'] ?>" readonly><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="date" class="form-label"><b>Date:</b></label>
                            <span class="text-danger" id="date_err"></span>
                            <input type="date" name="date" class="form-control" id="date" value="<?php echo $row['date'] ?>"><br>
                        </div>
                        <div class="col">
                            <div class="modal-footer">
                                <input type="submit" name="submit" value="Edit" class="btn btn-success">
                                <a href="members.php" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
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
