<?php
/* This code is a PHP script that generates a report of society bills. */

session_start();
include 'config.php';

if (isset($_SESSION['admin_email']) && isset($_SESSION['admin_pwd'])) {

if(isset($_POST['save'])){
    $month = $_POST['month'];
    $status = $_POST['status'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/logo.webp">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Report</title>
    <style>
        body {
            width: 95%;
            margin: 0;
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
            border: 2px solid black;
            padding: 10px;
            margin: 20px;
            justify-content: space-around;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div style="display:flex; justify-content:space-around;">
        <h4>Society Bills Report</h4>
        <h5 style="float:right;">Month: <?php echo $month; ?></h5>
        </div>
        <?php
        $select = "SELECT bill_id, member_name,wing,flat_number, bill_type, charge FROM bills WHERE status = '$status'";
        $res = $conn->query($select);
    
        $arr_data = $res->fetch_all(MYSQLI_ASSOC);
    
        $fieldinfo = $res->fetch_fields();
    
        echo '<table class="table table-bordered table-striped table-hover" id="mytable">';
        echo '<tr style="background-color:#9b9eaa; color:black;"><th scope="col">#';
        
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
        <div class="modal-footer">
        <input type="button" id="printpagebutton" class="btn btn-success" name="submit" value="Print" onclick="printpage()">
        </div>
    </div>
    <script type="text/javascript">
    function printpage() {
        var printButton = document.getElementById("printpagebutton");
        printButton.style.visibility = 'hidden';
        window.print();
        printButton.style.visibility = 'visible';
    }
</script>
</body>
</html>

<?php
}
}
else{
  header('location:admin_login.php');
}
?>