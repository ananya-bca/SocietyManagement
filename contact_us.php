<?php
/* The code you provided is a PHP script that handles form submission. */

if(isset($_POST['submit'])){
    include 'curd_functions.php';
    $res = savedata($_POST,'contact_us');

    if ($res) {

        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>';
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
           $(document).ready(function(){
                Swal.fire({
                    title: "Message Sent!",
                    text: "You message has been sent!",
                    icon: "success",
                    confirmButtonText: "Okay"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "home.php";
                    }
                });
            });
        </script>';
    // Prevent further execution of PHP code
    exit();
    }  
}
?>