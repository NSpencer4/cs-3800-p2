<?php
session_start();
if (!isset($_SESSION['exotic_inventory'])) {
    $_SESSION['exotic_inventory'] = $process->readInventory();
}
require_once('functions.php');
require_once('open-db.php');
$functions = new functions();
$services = $functions->get_services($db);
$appointments = $functions->get_appointments($db);
$available_times = $functions->get_appointment_times($db, $appointments);
?>
<!DOCTYPE html>
<html>
<head>
    <title>BHowdy's Exotic Car Dealership</title>
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="shortcut icon" href="images/favicon.ico" />
</head>
<body>
<main id="container" class="cards">
    <?php include('templates/header.php'); ?>
    <section id="main-container">
        <?php
        if (!isset($_SESSION['login-type']) || !isset($_SESSION['login']) || $_SESSION['login'] == 'deny' || !isset($_SESSION['login']) || $_SESSION['login'] == 'deny') {
            echo "You are not logged in. Please login and try again. Redirecting to the homepage in 3 seconds.";
            header( "refresh:3; url=login_start.php" );
        } else {
            echo "<h2>Scheduling Page</h2><br>";
            echo '<form action="confirmation.php" id="reserveform" method="POST">';
            foreach ($services as $service) {
              echo '<label for="service-'.$service['service_id'].'">'.$service['serv_description'].'</label>';
              echo '<input type="radio" name="service" value="'.$service['service_id'].'"><br><br>';
            }
            echo '<label for="service_date">Appointment Date</label>';
            echo '<select name="service_date">';
            foreach ($available_times as $key=>$available_time) {
              echo '<option value='.$key.'>'.$available_time.'</option>';
            }
            echo '</select><br><br>';
            echo '<textarea placeholder="Customer Comments" rows="4" cols="50" maxlength="200" name="cust_comments" form="reserveform"></textarea><br><br>';
            echo '<input type="hidden" name="cust_email" value="'.$_SESSION['user'].'">';
            echo '<input type="submit" class="btn modify" name="Method" value="Request">';
            echo '</form>';
        }
        ?>
    </section>
    <?php include('templates/footer.php'); ?>
</main>
</body>
</html>
