<?php
session_start();
if (!isset($_SESSION['exotic_inventory'])) {
    $_SESSION['exotic_inventory'] = $functions->readInventory();
}
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
        <h2>About Us</h2>
        <h3>Nicholas Spencer</h3>
        <p>
            I worked on the backend logic for the service request, history, and form validation. This involved
            reading and storing data into our database as well as ensuring the appointment times are appropriate.
        </p><br>
        <h3>Brandon Howard</h3>
        <p>
            Front end design along with wrote the templates that displayed the data from the backend functions.
            Wrote the read inventory function where it reads the car information
            that is stored into a session array.
        </p><br>
    </section>
    <?php include('templates/footer.php'); ?>
</main>
</body>
</html>
