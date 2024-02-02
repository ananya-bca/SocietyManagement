<?php
/* The above code is a PHP script that is used to add visitor information to a database. It starts by
checking if the user is logged in as an admin. If not, it redirects them to the admin login page. */

session_start();
include 'config.php';
include 'curd_functions.php';

if (isset($_SESSION['admin_email']) && isset($_SESSION['admin_pwd'])) {

if (isset($_POST['save'])) {
    $res = savedata($_POST, 'visitors');
    if ($res) {
        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>';
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
            $(document).ready(function(){
                Swal.fire({
                    title: "Good job!",
                    text: "You clicked the button!",
                    icon: "success",
                    confirmButtonText: "Okay"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "visitors.php";
                    }
                });
            });
        </script>';
        // Prevent further execution of PHP code
        exit();
    }
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/logo.webp">
    <title>Add Visitor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/d07f35fca2.js" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
    <script src="./js/validation.js"></script>

    <link rel="stylesheet" href="./css/stl.css">
</head>

<body id="body-pd">
    <?php
    include 'functions.php';
    side_bar();
    ?>
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-9 m-auto mt-5" style="box-shadow: 1px 1px 8px 0 black; background-color: #f8f9fa;">
                <form action="" class="p-3" method="post" onsubmit="return visitor()">
                    <h2 class="h-2">Add Visitor Info</h2>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <label for="v_name" class="form-label"><b style="font-size:20px;">Enter visitor name:</b></label>
                            <span class="text-danger" id="name_err"></span>
                            <input type="text" name="v_name" class="form-control" id="vis_name"><br>
                        </div>
                        <div class="col">
                            <label for="v_contact" class="form-label"><b style="font-size:20px;">Enter visitor contact no.:</b></label>
                            <span class="text-danger" id="contact_err"></span>
                            <input type="text" name="v_contact" class="form-control" id="vis_contact"><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="v_wing" class="form-label"><b style="font-size:20px;">Enter wing:</b></label>
                            <span class="text-danger" id="wing_err"></span>
                            <select name="v_wing" id="vis_wing" class="form-select">
                                <option value="dis" selected disabled>--select--</option>
                                <?php
                                $sql = "SELECT wing FROM wing";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                        <option value="<?php echo $row['wing']; ?>"><?php echo $row['wing']; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="v_flat" class="form-label"><b style="font-size:20px;">Enter flat number:</b></label>
                            <span class="text-danger" id="flat_err"></span>
                            <input type="text" name="v_flat" class="form-control" id="vis_flat"><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="v_floor" class="form-label"><b style="font-size:20px;">Enter floor number:</b></label>
                            <span class="text-danger" id="floor_err"></span>
                            <input type="text" name="v_floor" class="form-control" id="vis_floor"><br>
                        </div>
                        <div class="col">
                            <label for="v_date" class="form-label"><b style="font-size:20px;">Enter date:</b></label>
                            <input type="date" name="v_date" class="form-control" value="<?php echo date('Y-m-d'); ?>"><br>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" value="Save" name="save" class="btn btn-success">
                        <a href="members.php" class="btn btn-danger">Cancel</a>
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