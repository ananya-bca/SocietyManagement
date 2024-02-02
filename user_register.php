<?php
/* The given code is a PHP script that handles the registration process for a user. */

session_start();
include 'config.php';
include 'curd_functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="./images/logo.webp">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php
if (isset($_POST['register'])) {
    $mail = $_POST['mail'];
    $wing = $_POST['wing'];
    $flat_num = $_POST['flat_num'];

    // Validate and sanitize user input

    $select = "SELECT * FROM members WHERE email=? AND wing=? AND flat_number=?";
    $stmt = mysqli_prepare($conn, $select);
    mysqli_stmt_bind_param($stmt, "sss", $mail, $wing, $flat_num);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        if ($row['email'] == $mail && $row['wing'] == $wing && $row['flat_number'] == $flat_num) {
            // Additional checks if needed

            $select2 = "SELECT * FROM register WHERE mail=? AND wing=? AND flat_num=?";
            $stmt2 = mysqli_prepare($conn, $select2);
            mysqli_stmt_bind_param($stmt2, "sss", $mail, $wing, $flat_num);
            mysqli_stmt_execute($stmt2);
            $result2 = mysqli_stmt_get_result($stmt2);

            if (mysqli_num_rows($result2) > 0) {
                ?>
                <script>
                // Using SweetAlert to show an alert box
                Swal.fire({
                    title: "User Already Registered",
                    text: "You are already registered. Redirecting to login page.",
                    icon: "info",
                    confirmButtonText: "Okay"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'user_login.php';
                    }
                });
            </script>
            <?php
            } else {
                // User is not registered, proceed with registration
                $res = savedata($_POST, 'register');
                if ($res) {
                    ?>
                    <script>
                        Swal.fire({
                            title: "Welcome...",
                            text: "You are successfully registered!",
                            icon: "success",
                            confirmButtonText: "Okay"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'user_login.php';
                            }
                        });
                    </script>
                    <?php
                    exit(); // Exit after displaying success message
                }
            }
        }
    } else {
        ?>

        <script>
        // Using SweetAlert to show an alert box
        Swal.fire({
            title: "Not a society Member",
            text: "You are not a registered member of society.",
            icon: "info",
            confirmButtonText: "Okay"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'user_login.php';
            }
        });
    </script>
    <?php
    }
    exit();
}
?>

</body>
</html>
