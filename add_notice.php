<?php
/* The above code is a PHP script that handles the form submission for adding a notice. It includes
necessary files, starts a session, and checks if the form has been submitted. If the form has been
submitted, it calls the `savedata()` function to save the form data to the database. If the data is
successfully saved, it displays a success message using SweetAlert and redirects the user to the
notice.php page. */

session_start();
include 'config.php';
include 'curd_functions.php';

if (isset($_SESSION['admin_email']) && isset($_SESSION['admin_pwd'])) {

if(isset($_POST['save'])){
    $res = savedata($_POST,'notice');
    if ($res) {
        // Form submission successful, display SweetAlert
        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>';
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
            $(document).ready(function(){
            Swal.fire({
                title: "Notice Sent!",
                text: "You sent the notice!",
                icon: "success",
                confirmButtonText: "Okay"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "notice.php";
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
    <title>Add Notice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">  
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/d07f35fca2.js" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
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
                <form action="" class="p-3" method="post" onsubmit = "return notice()">
                    <h2 class="h-2">Add Notice</h2>
                    <hr>

                    <div class="row">
                        <div class="col">
                            <label for="n_name" class="form-label"><b style="font-size:20px;">Notice name:</b></label>
                            <span class="text-danger" id="not_name_err"></span>
                            <input type="text" name="n_name" id="not_name" class="form-control"><br>
                        </div>
                        <div class="col">
                            <label for="n_sub" class="form-label"><b style="font-size:20px;">Subject:</b></label>
                            <span class="text-danger" id="not_sub_err"></span>
                            <input type="text" name="n_sub" id="not_sub" class="form-control"><br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="notice_type" class="form-label"><b style="font-size:20px;">Notice Type:</b></label>
                            <span class="text-danger" id="notice_type_err"></span>
                            <select name="notice_type" id="notice_type" class="form-select" onchange="toggleMemberIdInput()">
                                <option value="dis" selected disabled>-- select --</option>
                                <option value="all_members">All Members</option>
                                <option value="Particular_member">Particular Member</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="member_id" class="form-label"><b style="font-size:20px;">Member Id:</b></label>
                            <input type="number" name="member_id" class="form-control" id="member_id">
                        </div>
                    </div>

                    <label for="date" class="form-label"><b style="font-size:20px;">Date:</b></label>
                    <input type="date" name="date" class="form-control" id="dt" value="<?php echo date('Y-m-d'); ?>" readonly>

                    <label for="message" class="form-label"><b style="font-size:20px;">Message:</b></label>
                    <span class="text-danger" id="msg_err"></span>
                    <textarea name="message" class="form-control" id="msg" rows="3"></textarea><br>
        
                    <div class="modal-footer">
                        <input type="submit" value="Save" name="save" class="btn btn-success">
                        <a href="flats.php" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function toggleMemberIdInput() {
            var noticeType = document.getElementById('notice_type').value;
            var memberIdInput = document.getElementById('member_id');

        // Check the selected option and set the readonly attribute and value accordingly
        if (noticeType === 'all_members') {
            memberIdInput.readOnly = true;
            memberIdInput.value = 0;
        } else {
            memberIdInput.readOnly = false;
            memberIdInput.value = ''; // You may want to clear the value when allowing input
        }
    }

    function notice() {
        // Reset error messages
        document.getElementById('not_name_err').innerHTML = '';
        document.getElementById('not_sub_err').innerHTML = '';
        document.getElementById('notice_type_err').innerHTML = '';
        document.getElementById('msg_err').innerHTML = '';

        let valid = true;

        let not_name = document.getElementById('not_name').value;
        let not_sub = document.getElementById('not_sub').value;
        let notice_type = document.getElementById('notice_type').value;
        let member_id = document.getElementById('member_id').value;
        let dt = document.getElementById('dt').value;
        let msg = document.getElementById('msg').value;

        // 1. Notice Name Validation
     if (not_name === '' || not_name.length < 5) {
        valid = false;
        document.getElementById('not_name_err').innerHTML = "* Please enter a valid notice name with at least 5 characters";
    }

    // 2. Subject Validation
    if (not_sub === '' || not_sub.length < 5) {
        valid = false;
        document.getElementById('not_sub_err').innerHTML = "* Please enter a valid subject with at least 5 characters";
    }

    // 3. Notice Type Validation
    if (notice_type === '' || notice_type === 'dis' || (notice_type === 'Particular_member' && member_id === '')) {
        valid = false;
        document.getElementById('notice_type_err').innerHTML = "* Please select a valid notice type and provide member ID if needed";
    }

    if (msg === '' || msg.length < 20 || msg.length > 200) {
        valid = false;
        document.getElementById('msg_err').innerHTML = "* Please enter a message between 20 and 200 characters";
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