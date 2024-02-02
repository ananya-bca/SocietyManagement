<?php
/* This PHP code is used to display the account information of a user who is logged in. */

session_start();
include 'config.php';

if (isset($_SESSION['mail']) && isset($_SESSION['pwd'])) {

$mail = $_SESSION['mail'];
$select = "SELECT * FROM register WHERE mail = '{$mail}'";
$result = mysqli_query($conn, $select);
if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
        $member_id = $row['member_id'];
    }
}

$select = "SELECT * FROM register WHERE mail = '{$mail}'";
//echo $select;
$result = mysqli_query($conn, $select);
if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/logo.webp">
    <title>Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">  
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/d07f35fca2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/stl.css">
    <script src="./js/script.js"></script>
    <style>
        .card{
            box-shadow: 1px 1px 8px 0 black;
        }
    </style>
</head>
<body id="body-pd">
    <?php include 'functions.php'; user_side_bar(); ?>
    <div class="container mt-4">
        <h2 class="text-center">IDENTITY</h2>
        <div class="card">
            <div class="card-body">
                <i class="fa fa-pen fa-xs position-absolute end-0 text-light"></i>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td><?php echo $row['member_name']; ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><?php echo $row['mail']; ?></td>
                        </tr>
                        <tr>
                            <td>Contact No.</td>
                            <td>:</td>
                            <td><?php echo $row['contact']; ?></td>
                        </tr>
                        <tr>
                            <td>Wing</td>
                            <td>:</td>
                            <td><?php echo $row['wing']; ?></td>
                        </tr>
                        <tr>
                            <td>Flat Number</td>
                            <td>:</td>
                            <td><?php echo $row['flat_num']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-evenly mt-4">
                    <form action="edit_account.php?id=<?php echo $member_id; ?>" method="post">
                        <input type="submit" name="edit" value="Edit Account Info" class="btn btn-success">
                    </form>
                    <form action="change_pass.php" method="post">
                        <input type="submit" name="change" value="Change Password" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
    }
}

}
else{
    header('location:user_login.php');
}
?>
