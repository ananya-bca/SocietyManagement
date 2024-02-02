<?php
// Home page of user

session_start();
include 'config.php';

if (isset($_SESSION['mail']) && isset($_SESSION['pwd'])) {

$mail = $_SESSION['mail'];

$select = "SELECT * FROM members WHERE email = '{$mail}'";
//echo $select;
$result = mysqli_query($conn, $select);
if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
        $wing = $row['wing'];
        $flat_number = $row['flat_number'];
        $member_id = $row['member_id'];
        $name = $row['member_name'];
    }
}

?>
<!DOCTYPE html>
<html lang="en">
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
            .col{
                background-color:#61677A;
                color:white;
                margin:1%;
                padding:1%;
                font-size:25px;
                text-align:center;
                border-radius:10px;
                box-shadow:2px 2px 8px 0 black;
            }
            i{
                float:left;
            }
        </style>
</head>
<body id="body-pd">

<?php
include 'functions.php';
user_side_bar();
?>
<h4 style = "padding-top:20px;"> Hi <?php
echo $name;
?>, Welcome To Your Society Account!
</h4><br>
<?php 
          $sql = "SELECT * from complain WHERE member_id = $member_id"; 
    if ($result = mysqli_query($conn, $sql)) { 
        $complain = mysqli_num_rows( $result );  
} 


$sql = "SELECT * from bills WHERE member_id = $member_id"; 
if ($result = mysqli_query($conn, $sql)) { 
    $bills = mysqli_num_rows( $result );  
} 

$sql = "SELECT * from notice WHERE member_id = $member_id || member_id = 0"; 
if ($result = mysqli_query($conn, $sql)) { 
    $notice = mysqli_num_rows( $result );  
} 

$sql = "SELECT * FROM visitors WHERE v_wing = '$wing' AND v_flat = '$flat_number'";
if ($result = mysqli_query($conn, $sql)) {
    $visitor = mysqli_num_rows($result);
}

?>

<div class="container">
  <div class="row row-cols-5">
    <!-- <div class="col">
    <i class='fa fa-list-ul'></i> <br>Flat: <?php //echo $flat; ?></div>
    <div class="col">
    <i class='	fa fa-users'></i> <br> Member: <?php //echo $member; ?></div> -->
    <div class="col">
    <i class='	fa fa-file'></i> <br>Bill: <?php echo $bills; ?></div>
    <div class="col">
    <i class='fa fa-exclamation-circle'></i> <br>Complain: <?php echo $complain; ?></div>
    <div class="col">
    <i class='fa fa-users'></i> <br>Visitor: <?php echo $visitor; ?></div>
    <div class="col">
    <i class='fa fa-bell'></i> <br>Notice: <?php echo $notice; ?></div>
  <!-- <div class="col">
    <i class='	fa fa-users'></i> <br> Contact List: <?php //echo //$contact; ?></div> -->
</div>
</div>
    
</body>
</html>

<?php
}
else{
    header('location:user_login.php');
}
?>