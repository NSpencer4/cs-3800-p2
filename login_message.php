<?php
session_start();
require_once('open-db.php');
include('functions.php');
if (!isset($_SESSION['exotic_inventory'])) {
    $_SESSION['exotic_inventory'] = readInventory();
}
$login_status = $_SESSION['login'];
?>
<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>
<body>
<main id="container" class="cards">
    <?php include('templates/navbar.php'); ?>
    <section id="main-container">
        <?php
          if ($login_status == 'accept_existing') {
            echo "<h1>Login successful!</h1>";
          }
           if ($login_status == 'accept_new') {
            echo "<h1>Your account has been created.</h1>";
          }
          else if ($login_status == 'deny'){
            echo "<h1>Login failed.</h1>";
          }
          echo "You will be redirected to the home page in 3 seconds.";
          header( "refresh:3; url=index.php" );
        ?>
    </section>
    <?php include('templates/footer.php'); ?>
</main>
</body>
</html>
