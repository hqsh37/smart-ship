<?php
$path = isset($_GET['page1']) ? '.' : ''; 
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
    rel="stylesheet">
<link rel="stylesheet" href="<?php echo $path; ?>./assets/font/themify-icons/themify-icons.css">
<!-- Include Tippy.js from CDN -->
<script src="https://unpkg.com/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/tippy.js@6.3.1/dist/tippy-bundle.umd.min.js"></script>
<!-- Include Tippy.js theme CSS -->
<link rel="stylesheet" href="https://unpkg.com/tippy.js@6.3.1/dist/tippy.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>
<!-- NOTE: prior to v2.2.1 tiny-slider.js need to be in <body> -->
<link rel="stylesheet" href="<?php echo $path; ?>./assets/css/custom.css">
<link rel="stylesheet" href="<?php echo $path; ?>./assets/css/styleCustomer.css">