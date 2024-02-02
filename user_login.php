<?php
/* Login or signup page for a user */
session_start();
include 'config.php';
// include 'curd_functions.php';

$error = [];

if (isset($_POST['login'])) {
  $mail = $_POST['email'];
  $pwd = $_POST['pswd'];

  $select = "SELECT * FROM register WHERE mail='$mail' && pwd='$pwd' ";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        if($row['mail'] == $mail && $row['pwd'] == $pwd){
          $_SESSION['pwd'] = $row['pwd']; 
          $_SESSION['mail'] = $row['mail'];
          header('location: user_home.php');
          exit();
      }
    }
        else {

          $error[] = "Incorrect E-mail Id or Password!";

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
  <title>Login or Register</title>
</head>
<body>
<main>
    <div class="button-box">
      <div class="btn-active-back"></div>
      <button class="toggle-btn login-btn">&nbsp;&nbsp;Login</button>
      <button class="toggle-btn register-btn">&nbsp;&nbsp;Register</button>
    </div>
    <div class="form-box">
      <form class="login-form" action="" method="post" onSubmit="login_validation()">
      <?php
                    if (!empty($error)) {
                        foreach ($error as $error) {
                            echo '<p class="text-danger">' . $error . '</p><br>';
                        }
                    }
                    ?>
                    <br><br><br><br>
        <div class="input-box">
          <input type="email" id="mail" name="email" required />
          <label for="mail">Email Id <span class= "text-danger" id="mail_err"></span></label>
        </div>
        <div class="input-box">
          <input type="password" id="password" name="pswd" required />
          <label for="password">Password <span class= "text-danger" id="mail_err"></span></label>
        </div>
        <div class="check-box">
          <!-- <input type="checkbox" id="login-checkbox" />
          <label for="login-checkbox">Remember me</label> -->
          <span>Forgot password?</span>
        </div>
        <input type="submit" name="login" value="Login" class="submit-button">
      </form>

      <form class="register-form" action="user_register.php" method="post" onsubmit="return valid_reg()">
        <div class="input-box">
          <input type="text" id="member_name" name="member_name" required />
          <label for="member_name">Name <span class= "text-danger" id="name_err"></span></label>
        </div>
        <div class="input-box">
          <input type="email" id="email" name="mail" required />
          <label for="email">Email Id <span class= "text-danger" id="mail_err"></span></label>
        </div>
        <div class="input-box">
          <input type="text" id="contact" name="contact" required />
          <label for="contact">Contact No. <span class= "text-danger" id="contact_err"></span></label>
        </div>
        <div class="input-box">
          <input type="password" id="pwd" name="pwd" required />
          <label for="pwd">Password <span class= "text-danger" id="pwd_err"></span></label>
        </div>
        <div class="input-box">
          <input type="text" id="wing" name="wing" required />
          <label for="wing">Wing <span class= "text-danger" id="wing_err"></span></label>
        </div>
        <div class="input-box">
          <input type="number" id="flat_num" name="flat_num" required />
          <label for="flat_num">Flat Number</label>
        </div>
        <!-- <div class="check-box">
          <input type="checkbox" id="register-checkbox" />
          <label for="register-checkbox">Agree to the terms & conditions</label>
        </div> -->
        <input type="submit" name="register" value="Register" class="submit-button">
          <!-- <span></span>
          <span></span>
          <span></span>
          <span></span> -->
          <!-- Register
        </button> -->
      </form>
    </div>
  </main>
  <script>
    const login = document.querySelector(".login-btn");
const register = document.querySelector(".register-btn");
const loginForm = document.querySelector(".login-form");
const registerForm = document.querySelector(".register-form");
const btnActiveBack = document.querySelector(".btn-active-back");

login.addEventListener("click", () => {
  btnActiveBack.style.left = "0px";
  registerForm.style.left = "115%";
  loginForm.style.left = "0px";
});

register.addEventListener("click", () => {
  btnActiveBack.style.left = "50%";
  registerForm.style.left = "0px";
  loginForm.style.left = "-115%";
});

  </script>
  <script src="validation.js"></script>
</body>
</html>

