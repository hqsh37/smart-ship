<?php
$path = isset($_GET['page1']) ? '.' : ''; 
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
rel="stylesheet">
<link rel="stylesheet" href="<?php echo $app->geturl("assets/font/themify-icons/themify-icons.css"); ?>">
<!-- CSS bootstap -->
<link rel="stylesheet" href="<?php echo $app->geturl("assets/bootstrap-5.0.2-dist/css/bootstrap.min.css"); ?>">
<!-- Include Tippy.js from CDN -->
<script src="https://unpkg.com/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/tippy.js@6.3.1/dist/tippy-bundle.umd.min.js"></script>
<!-- NOTE: prior to v2.2.1 tiny-slider.js need to be in <body> -->
<link rel="stylesheet" href="<?php echo $app->geturl("assets/css/custom.css"); ?>">
<link rel="stylesheet" href="<?php echo $app->geturl("assets/css/styleCustomer.css"); ?>">