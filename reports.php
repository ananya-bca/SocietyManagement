<?php
/* The code is a PHP script that creates a bill report form. */

session_start();
include 'config.php';

if (isset($_SESSION['admin_email']) && isset($_SESSION['admin_pwd'])) {
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
    <title>Report</title>
</head>
<body id="body-pd">
    <?php
    include 'functions.php';
    side_bar();
    ?>
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-5 m-auto mt-5" style="box-shadow: 1px 1px 8px 0 black; background-color: #f8f9fa;">
                <form action="view_report.php" class="p-3" method="post" onsubmit="return report()">
                <h4>Create a bill report</h4>
                    <label for="wing" class="form-label"><b style="font-size:20px;">Enter Month:</b></label>
                    <span class= "text-danger" id="month_err"></span>
                    <input type="month" name="month" id="month" class="form-control"><br>

                    <label for="status" class="form-label"><b style="font-size:20px;">Status:</b></label>
                    <span class= "text-danger" id="status_err"></span>
                    <select name="status" id="status" class="form-select">
                        <option value="dis">-- select --</option>
                        <option value="pending">Pending</option>
                        <option value="paid">Paid</option>
                    </select>
                    <div class="modal-footer">
                        <input type="submit" value="Create Report" name="save" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="validation.js"></script>
</body>
</html>

<?php
}
else{
  header('location:admin_login.php');
}
?>
