<?php
include "../config.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SmartShip</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- header -->
        <?php include "./views/header.php"; ?>

        <!-- sidebar -->
        <aside class="main-sidebar">
            <?php include "./views/left-sidebar.php" ?>
        </aside>
        <!-- main -->
        <div class="content-wrapper">
            <?php $app->run(); ?>
        </div>

        <!-- footer -->
        <?php include "./views/footer.php"?>

    </div>

    <script src="../assets/jQuery/jQuery-2.2.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script>
    $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="dist/js/app.min.js"></script>
    <script src="dist/js/pages/dashboard.js"></script>
    <script src="dist/js/demo.js"></script>
</body>

</html>