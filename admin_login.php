<?php
/* The code provided is a PHP script that handles a login form. Here's a breakdown of what it does: */

session_start();
include 'config.php';

$errors = []; // Change variable name to $errors

if (isset($_POST['submit'])) {

    $email = $_POST['mail'];
    $pwd = $_POST['pwd'];

    // $adm_mail = "admin@gmail.com";
    // $adm_pwd = "admin123";

    $select = "SELECT * FROM admin_login WHERE mail='$email' && pwd='$pwd' ";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        if($row['mail'] == $email && $row['pwd'] == $pwd){
          $_SESSION['admin_pwd'] = $row['pwd']; 
          $_SESSION['admin_email'] = $row['mail'];
          header('location: admin_home.php');
          exit();
      }
    }
        else {

          $errors[] = "Incorrect E-mail Id or Password!";

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/d07f35fca2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/login_style.css">
    <title>Sign in Form</title>
</head>

<body>
    <main>
        <div class="form-box">
            <form class="login-form" action="" method="post">
                <h2 style="color:white; margin-top:50px;">LOGIN FORM</h2>

                <?php
                if (!empty($errors)) {
                    foreach ($errors as $error) { // Change variable name to $errors
                        echo '<p class="text-danger">' . $error . '</p><br>';
                    }
                }
                ?>

                <div class="input-box" style="margin-top:100px;">
                    <input type="email" id="mail" name="mail" required />
                    <label for="mail">E-mail</label>
                </div>
                <div class="input-box">
                    <input type="password" id="password" name="pwd" required />
                    <label for="password">Password</label>
                </div>
                <input type="submit" name="submit" class="submit-button" value="login">
            </form>
        </div>
    </main>
</body>

</html>
