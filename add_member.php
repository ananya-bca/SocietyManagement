<?php

/* This code is a PHP script that is used to add a new member to a database. It starts by checking
if the user is logged in as an admin. If not, it redirects them to the admin login page. */

session_start();
include 'config.php';
include 'curd_functions.php';

if (isset($_SESSION['admin_email']) && isset($_SESSION['admin_pwd'])) {

$error = [];

if (isset($_POST['save'])) {
    $wing = $_POST['wing'];
    $flat_num = $_POST['flat_number'];
    
    $update = "UPDATE flat SET status = 'Booked' WHERE flat_wing = '$wing' AND flat_number = '$flat_num'";
    $qry = mysqli_query($conn, $update);
    $select = "SELECT * FROM members";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        if ($row['wing'] == $_POST['wing'] && $row['flat_number'] == $_POST['flat_number']) {
            $error[] = "Flat already registerd!";
        }
        else if($row['email'] == $_POST['email']){
            $error[] = "Member already registerd!";
        } else {
            $res = savedata($_POST, 'members');
            if ($res) {
                echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>';
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                echo '<script>
                    $(document).ready(function(){
                        Swal.fire({
                            title: "Member added!",
                            text: "You added a member!",
                            icon: "success",
                            confirmButtonText: "Okay"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "members.php";
                            }
                        });
                    });
                </script>';
                exit();
            }
        }
    }
}
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/logo.webp">
    <title>Add Member</title>
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
                <form action="" class="p-3" method="post" onsubmit = "return member()">
                    <h2 class="h-2">Add New Member</h2>
                    <hr>
                    <?php
                    if (!empty($error)) {
                        foreach ($error as $error) {
                            echo '<p class="btn btn-danger">' . $error . '</p><br>';
                        }
                    }
                    ?>
                    <div class="row">
                        <div class="col">
                            <label for="member_name" class="form-label"><b style="font-size:20px;">Enter Member name:</b></label>
                            <span class="text-danger" id="name_err"></span>
                            <input type="text" name="member_name" class="form-control" id="member_name"><br>
                        </div>
                        <div class="col">
                            <label for="email" class="form-label"><b style="font-size:20px;">Enter member email:</b></label>
                            <span class="text-danger" id="mail_err"></span>
                            <input type="email" name="email" class="form-control" id="email"><br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="contact" class="form-label"><b style="font-size:20px;">Enter member contact no.:</b></label>
                            <span class="text-danger" id="contact_err"></span>
                            <input type="text" name="contact" class="form-control" id="contact"><br>
                        </div>
                        <div class="col">
                            <label for="wing" class="form-label"><b style="font-size:20px;">Enter wing:</b></label>
                            <span class="text-danger" id="wing_err"></span>
                            <select name="wing" id="wing" class="form-select" onchange="getFlatNumbers()">
                                <option value="" selected disabled>-- Select Wing --</option>
                                <?php
                                $sql = "SELECT wing FROM wing";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='{$row['wing']}'>{$row['wing']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="flat_number" class="form-label"><b style="font-size:20px;">Enter flat number:</b></label>
                            <span class="text-danger" id="flat_err"></span>
                            <select name="flat_number" id="flat_number" class="form-select" onchange="getFlatFloor()">
                            </select>
                        </div>
                        <div class="col">
                            <label for="floor_number" class="form-label"><b style="font-size:20px;">Enter floor number:</b></label>
                            <span class="text-danger" id="floor_err"></span>
                            <input type="number" name="floor_number" id="flat_floor" class="form-control" id="floor_number" readonly><br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="date" class="form-label"><b style="font-size:20px;">Enter date:</b></label>
                            <span class="text-danger" id="date_err"></span>
                            <input type="date" name="date" class="form-control" id="date" value="<?php echo date("Y-m-d"); ?>"><br>
                        </div>
                        <div class="col">
                            <div class="modal-footer">
                                <input type="submit" value="Save" name="save" class="btn btn-success">
                                <a href="members.php" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- <script src = "validation.js"></script> -->

<script>
    function member() {
    let valid = true;
    let member_name = document.getElementById('member_name').value;
    let email = document.getElementById('email').value;
    let contact = document.getElementById('contact').value;
    let wing = document.getElementById('wing').value;
    let flat = document.getElementById('flat_number').value;
    let floor = document.getElementById('flat_floor').value; // Corrected ID
    let dt = document.getElementById('date').value;

    let nameRegex = /^[a-zA-Z]+$/;
    if (member_name === '' || !nameRegex.test(member_name) || member_name.length < 5) {
        valid = false;
        document.getElementById('name_err').innerHTML = "* Please enter a valid name with at least 5 characters";
    } else {
        document.getElementById('name_err').innerHTML = '';
    }

    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === '' || !emailRegex.test(email)) {
        valid = false;
        document.getElementById('mail_err').innerHTML = "* Please enter a valid email address";
    } else {
        document.getElementById('mail_err').innerHTML = '';
    }

    let contactRegex = /^[0-9]+$/;
    if (contact === '' || !contactRegex.test(contact) || contact.length !== 10) {
        valid = false;
        document.getElementById('contact_err').innerHTML = "* Please enter a valid 10-digit phone number";
    } else {
        document.getElementById('contact_err').innerHTML = '';
    }

    if (wing === 'dis' || wing === '') {
        document.getElementById('wing_err').innerHTML = "* Please select your wing";
        valid = false;
    } else {
        document.getElementById('wing_err').innerHTML = '';
    }

    if (flat === '' || !/^[0-9]+$/.test(flat)) {
        document.getElementById('flat_err').innerHTML = "* Please enter a valid flat number";
        valid = false;
    } else {
        document.getElementById('flat_err').innerHTML = '';
    }

    if (floor === '' || !/^[0-9]+$/.test(floor)) {
        document.getElementById('floor_err').innerHTML = "* Please enter a valid floor number";
        valid = false;
    } else {
        document.getElementById('floor_err').innerHTML = '';
    }

    if (dt === '') {
        document.getElementById('date_err').innerHTML = "* Please enter date";
        valid = false;
    } else {
        document.getElementById('date_err').innerHTML = '';
    }

    return valid;
}


    function getFlatNumbers() {
        var selectedWing = document.getElementById("wing").value;

        $.ajax({
            type: "POST",
            url: "get_flat_numbers.php", 
            data: { wing: selectedWing },
            success: function(response) {
            $("#flat_number").html(response);
            $("#flat_floor").val('');
            }
        });
    }

    function getFlatFloor() {
        var selectedFlatNumber = document.getElementById("flat_number").value;

        $.ajax({
            type: "POST",
            url: "get_flat_floor.php", 
            data: { flat_number: selectedFlatNumber },
            success: function(response) {
            $("#flat_floor").val(response);
            }
        });
    }

</script>
</body>
</html>
<?php
}
else{
    header('location:admin_login.php');
}
?>
