<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Ship</title>
    <?php include "./assets/css/style.css.php" ?>
</head>
<body>
    <?php
        include './views/header.php';
        echo "<div class=\"body\">";
        $app->run();
        echo "</div>";
        include './views/footer.php'; 
        include "./assets/js/main.js.php";
    ?>
</body>
</html>
