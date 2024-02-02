<?php
/* This code provided a PHP script that generates a dashboard page for an admin panel. Here's a
breakdown of what the code does: */

session_start();
include 'config.php';

if (isset($_SESSION['admin_email']) && isset($_SESSION['admin_pwd'])) {
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/logo.webp">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/d07f35fca2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/stl.css">
    <script src="./js/script.js"></script>
    <style>
        .col {
            background-color: #61677A;
            color: white;
            margin: 1%;
            padding: 1%;
            font-size: 24px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 2px 2px 8px 0 black;
        }

        i {
            float: left;
        }
    </style>
</head>

<body id="body-pd">
    <?php
    include 'functions.php';
    side_bar();
    ?>
    <h2>Dashboard</h2><br>

    <?php
    $sql = "SELECT * from flat";
    if ($result = mysqli_query($conn, $sql)) {
        $flat = mysqli_num_rows($result);
    }

    $sql = "SELECT * from flat WHERE status = 'Available'";
    if ($result = mysqli_query($conn, $sql)) {
        $avl_flat = mysqli_num_rows($result);
    }

    $sql = "SELECT * from members";
    if ($result = mysqli_query($conn, $sql)) {
        $member = mysqli_num_rows($result);
    }

    $sql = "SELECT * from bills WHERE status = 'pending'";
    if ($result = mysqli_query($conn, $sql)) {
        $bill = mysqli_num_rows($result);
    }

    $sql = "SELECT * from complain WHERE status = 'unsolved'";
    if ($result = mysqli_query($conn, $sql)) {
        $complain = mysqli_num_rows($result);
    }

    $sql = "SELECT * from visitors";
    if ($result = mysqli_query($conn, $sql)) {
        $visitor = mysqli_num_rows($result);
    }

    $sql = "SELECT * from notice";
    if ($result = mysqli_query($conn, $sql)) {
        $notice = mysqli_num_rows($result);
    }

    $sql = "SELECT * from contact_us WHERE status = ''";
    if ($result = mysqli_query($conn, $sql)) {
        $contact = mysqli_num_rows($result);
    }
    ?>

    <div class="container">
        <div class="row row-cols-5">
            <div class="col">
                <i class='fa fa-list-ul'></i> <br>Total Flats: <?php echo $flat; ?>
            </div>
            <div class="col">
                <i class='fa fa-list-ul'></i> <br>Available Flats: <?php echo $avl_flat; ?>
            </div>
            <div class="col">
                <i class='fa fa-users'></i> <br>Total Members: <?php echo $member; ?>
            </div>
            <div class="col">
                <i class='fa fa-file'></i> <br>Pending Bills: <?php echo $bill; ?>
            </div>
            <div class="col">
                <i class='fa fa-exclamation-circle'></i> <br>New Complaints: <?php echo $complain; ?>
            </div>
            <div class="col">
                <i class='fa fa-users'></i> <br>Flat Visitors: <?php echo $visitor; ?>
            </div>
            <div class="col">
                <i class='fa fa-bell'></i> <br>Notice: <?php echo $notice; ?>
            </div>
            <div class="col">
                <i class='fa fa-users'></i> <br>New Contacts: <?php echo $contact; ?>
            </div>
        </div>
    </div>

<?php
}
else{
    header('location:admin_login.php');
}
?>

</body>
</html>
