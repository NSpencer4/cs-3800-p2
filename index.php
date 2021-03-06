<?php
session_start();
require_once('open-db.php');
include('functions.php');
if (!isset($_SESSION['exotic_inventory'])) {
    $_SESSION['exotic_inventory'] = readInventory();
}
if (isset($_POST['Method']) && isset($_SESSION['exotic_inventory'])) {
    add($_POST['firstname'],$_POST['lastname'],$_POST['date'],$_SESSION['exotic_inventory'][$_POST['CarIndex']]['car']);
}
if (isset($_POST['CarIndex'])) {
    $_SESSION['exotic_inventory'] = carStatusChange($_SESSION['exotic_inventory'], $_POST['CarIndex'], "Reserved");
}
?>
<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>
    <body>
        <main id="container" class="cards">
            <?php
            include('templates/navbar.php');
            ?>
            <section id="main-container">
                <table>
                    <?php
                    $rowCount = 0;
                    foreach ($_SESSION['exotic_inventory'] as $key=>$car){
                        echo '<form action="showroom.php" method="POST">';

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
