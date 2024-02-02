<?php
/* The above code is a PHP script that allows an admin user to send a bill to a member. It starts by
checking if the admin user is logged in. If not, it redirects them to the admin login page. */

session_start();
include 'config.php';
include 'curd_functions.php';

if (isset($_SESSION['admin_email']) && isset($_SESSION['admin_pwd'])) {

if(isset($_POST['submit'])){
$res = savedata($_POST,'bills');
if($res){
    echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>';
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo '<script>
        $(document).ready(function(){
            Swal.fire({
                title: "Bill Sent!",
                text: "You sent the bill!",
                icon: "success",
                confirmButtonText: "Okay"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "bills.php";
                }
            });
        });
    </script>';
    exit();
}   
}
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/d07f35fca2.js" crossorigin="anonymous"></script>
<script src="./js/script.js"></script>
    <link rel="stylesheet" href="./css/stl.css">
    <title>Send Bill</title>
</head>
<body id="body-pd">
<?php
include 'functions.php';
side_bar();
?>
    <div class="container">
    <div class="row mt-5">
        <div class="col-lg-9 m-auto mt-5" style="box-shadow: 1px 1px 8px 0 black; background-color: #f8f9fa;">
    <form action="" class="p-3" method="post" onsubmit = "return bills()">
        <h2 class="h-2">Enter Bill Info</h2>
        <hr>
        <div class="row">
            <div class="col">
            <label for="member_id" class="form-label"><b style="font-size:20px;">Member Id:</b></label>
            <span class="text-danger" id="id_err"></span>
            <input type="text" name="member_id" id="member_id" class="form-control" onchange="fetchMemberDetails()"><br>
            </div>
            <div class="col">
            <label for="member_name" class="form-label"><b style="font-size:20px;">Member Name:</b></label>
            <input type="text" name="member_name" id="member_name" class="form-control" readonly><br>

            </div>
        </div>
        <div class="row">
            <div class="col">
            <label for="wing" class="form-label"><b style="font-size:20px;">Wing:</b></label>
            <input type="text" name="wing" id="wing" class="form-control" readonly><br>
            </div>
            <div class="col">
            <label for="flat_number" class="form-label"><b style="font-size:20px;">Flat number:</b></label>
            <input type="text" name="flat_number" id="flat_number" class="form-control" readonly><br>
            </div>
        </div>
        <div class="row">
            <div class="col">
            <label for="bill_type" class="form-label"><b style="font-size:20px;">BIll Type:</b></label>
            <span class="text-danger" id="bill_err"></span>
        <input type="text" name="bill_type" class="form-control" id="bill_type"><br>
            </div>
            <div class="col">
            <label for="charge" class="form-label"><b style="font-size:20px;">Charge:</b></label>
            <span class="text-danger" id="charge_err"></span>
        <input type="number" name="charge" class="form-control" id="charge"><br>
            </div>
        </div>
        <div class="row">
            <div class="col">
            <label for="last_date" class="form-label"><b style="font-size:20px;">Last Date:</b></label>
            <span class="text-danger" id="date_err"></span>
        <input type="date" name="last_date" class="form-control" id="last_date"><br>
            </div>
        <div class="col">
        <input type="hidden" name="status" class="form-control" value="pending">
        <div class="modal-footer">
        <input type="submit" value="Send Bill " name="submit" class="btn btn-success">
        <a href="bills.php" class="btn btn-danger">Cancel</a>
</div>
</div>
</div>
        </form>
    </div>
    </div>
    </div>
    <!-- <script src = "validation.js"></script> -->
    <script>
function fetchMemberDetails() {
    var member_id = $('#member_id').val();

    $.ajax({
        url: 'fetch_member_details.php', // Change this to the actual PHP file handling the AJAX request
        type: 'POST',
        data: { member_id: member_id },
        success: function(data) {
            var details = JSON.parse(data);
            $('#member_name').val(details.member_name);
            $('#wing').val(details.wing);
            $('#flat_number').val(details.flat_number);
        }
    });
}


function bills(){
    let valid = true;
    let id = document.getElementById('member_id').value;
    let bill_type = document.getElementById('bill_type').value;
    let charge = document.getElementById('charge').value;
    let mem_name = document.getElementById('member_name').value;
    let wing = document.getElementById('wing').value;
    let flat_num = document.getElementById('flat_number').value;
    let last_date = document.getElementById('last_date').value;
    

    if (id === '' || !/^[0-9]+$/.test(id)) {
        document.getElementById('id_err').innerHTML = "* Please enter a valid id";
        valid = false;
    }
    else if(mem_name == '' || wing == '' || flat_num =='' || id<=0){
        document.getElementById('id_err').innerHTML = "* Please enter a valid id";
    } else {
        document.getElementById('id_err').innerHTML = '';
    }

    if(bill_type == ''){
        document.getElementById('bill_err').innerHTML = "* Please enter bill type";
        valid = false;
    }else {
        document.getElementById('bill_err').innerHTML = '';
    }

    if (charge === '' || !/^[0-9]+$/.test(charge)) {
        document.getElementById('charge_err').innerHTML = "* Please enter a valid charge of bill";
        valid = false;
    } else {
        document.getElementById('charge_err').innerHTML = '';
    }

    let today = new Date().toISOString().split('T')[0]; // Get today's date in "YYYY-MM-DD" format

if (last_date === '' || last_date < today) {
    valid = false;
    document.getElementById('date_err').innerHTML = "* Please select today or a future date only";
} else {
    document.getElementById('date_err').innerHTML = '';
}

    return valid;
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