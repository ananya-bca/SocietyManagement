<?php
/* The code you provided is a PHP script that displays a table of complaints for a logged-in user.*/

session_start();
include 'config.php';

if (isset($_SESSION['mail']) && isset($_SESSION['pwd'])) {

$mail = $_SESSION['mail'];

$select = "SELECT * FROM members WHERE email = '{$mail}'";
//echo $select;
$result = mysqli_query($conn, $select);
if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
        $member_id = $row['member_id'];
    }
}
?>
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
        </style>
    <title>My Complaints</title>
</head>
<body id="body-pd">
<?php
include 'functions.php';
user_side_bar();
?>
<div class="container">
  <h3 class="text-center">My Complaints</h3>
  <hr>
  <!-- <label for="search"><b>Search</b></label>
  <input type="search" name="search" id="search" onkeyup="search_bar()" placeholder="search by name"><br><br> -->
<?php
// include 'savedata.php';
// show_data('bills');

$select = "SELECT complain_id, subject, reply_msg FROM comp_reply WHERE member_id ='$member_id'";
    $res = $conn->query($select);

    $arr_data = $res->fetch_all(MYSQLI_ASSOC);

    $fieldinfo = $res->fetch_fields();

    echo '<table class="table table-bordered table-striped table-hover" id="mytable">';
    echo '<tr style="background-color:#61677A; color:white;"><th scope="col">#';
    
    foreach ($fieldinfo as $val) {
        echo '<th scope="col">' . $val->name . '</th>';
    }
    
    echo '</tr>';

    $no = 1;
    foreach ($arr_data as $row) {
        echo '<tr class="filter"><td>' . $no++ . '</td>';

        foreach ($row as $key => $value) {
            echo '<td>' . $value . '</td>';
        }
    }

?>

</div>
</body>
</html>
<?php
}
else{
    header('location:user_login.php');
}
?>