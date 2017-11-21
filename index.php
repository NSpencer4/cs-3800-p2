<?php
session_start();
require_once('process.php');
$process = new process();

if (!isset($_SESSION['inventory'])) {
    $_SESSION['inventory'] = $process->readInventory();
}
if (!isset($_SESSION['customers'])) {
    $_SESSION['customers'] = $process->readCustomers();
}
if (isset($_POST['Method']) && isset($_SESSION['inventory'])) {
    $process->add($_POST['firstname'],$_POST['lastname'],$_POST['date'],$_SESSION['inventory'][$_POST['CarIndex']]['car']);
}
if (isset($_POST['CarIndex'])) {
    $_SESSION['inventory'] = $process->carStatusChange($_SESSION['inventory'], $_POST['CarIndex'], "Reserved");
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
            <?php
            include('templates/header.php');
            if (isset($_POST['firstname'])) {
                echo "<h2>";
                $name = $_POST['firstname'];
                //HEREDOC
                echo <<<EOT
                We look forward to meeting with you 
                $name !
EOT;
                echo "</h2>";
            }

            ?>
            <section id="main-container">
                <table>
                    <?php
                    $rowCount = 0;
                    foreach ($_SESSION['inventory'] as $key=>$car){
                        echo '<form action="form.php" method="POST">';

                        if ($rowCount === 0) {
                            echo "<tr>";
                        }
                        echo "<td>";
                        echo "<div class='cards'>";
                        echo $car['car']."<br>";
                        echo "<img class='car-img' src='".$car['image']."'><br>";
                        echo $car['price']."<br>";
                        echo '<input type="hidden" name="CarIndex" value="'.$key.'">';
                        if (strpos( $car['status'], "Reserved" ) !== false) {
                          echo '<input type="submit" class="btn modify" name="Method" value="Reserved" disabled>';
                        } else {
                          echo '<input type="submit" class="btn modify" name="Method" value="More Info">';
                        }
                        echo "</div>";
                        echo "</td>";
                        echo '</form>';
                        if ($rowCount === 3) {
                            echo "</tr>";
                        }
                        $rowCount++;

                        if ($rowCount === 4) {
                            $rowCount = 0;
                        }
                    }
                    ?>
                </table>
            </section>
            <?php include('templates/footer.php'); ?>
        </main>
    </body>
</html>