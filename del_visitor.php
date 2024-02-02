<?php
session_start();
include 'config.php';

if (isset($_SESSION['admin_email']) && isset($_SESSION['admin_pwd'])) {

$id = $_GET['id'];
?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>

<body>
  <script type="text/javascript">
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      
       if (result.isConfirmed) {
        window.location.href = "delete_visitor.php?id=" + <?php echo $id; ?>;
       }
       else {
        window.location.href='visitors.php';
      }
    });
  </script>
</body>
</html>
<?php
}
else{
  header('location:admin_login.php');
}
?>
