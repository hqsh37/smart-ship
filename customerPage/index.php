<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart ship</title>
    <?php
    include './assets/css/style.css.php';
    ?>
</head>

<body>
    <div>
        <?php
        include 'header.php';
        echo '<div class="body">';
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 'home';
        }
        switch($page) {
            case 'qlDH':
                include 'View/qlDH.php';
                break;
            case 'home':
                include 'View/main.php';
                break;
            case 'address':
                include 'View/qlDiachi.php';
                break;
            case 'userInfo':
                include 'View/userInfo.php';
                break;
            case 'createDH':
                include 'View/taoDH.php';
                break;
            default:
                include 'View/main.php';
                break;

        }
        echo '</div>';
        include 'footer.php';
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

        <!-- import main.js -->
        <?php
        include "./assets/js/main.js.php";
        ?>
    </div>
</body>

</html>