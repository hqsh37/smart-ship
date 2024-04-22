<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart ship</title>
    <?php
    // import css
    include './assets/css/style.css.php';
    ?>
</head>

<body>
    <div>
        <?php
        $page1 = isset($_GET['page1']) ? $_GET['page1'] : '0';
        include 'header.php';
        $url = isset($_GET['page']) ? $_GET['page'] : '/';
        if (strpos($url, 'smartShip/') === 0) {
            $url = substr($url, strlen('smartShip/'));
        }
        
        // echo $url."\t".$page1;
        echo '<div class="body">';

        switch($url) {
            case 'home':
                include 'View/main.php';
                break;
            case 'qlDH':
                if(!!$page1 && $page1 === "detail-product") {
                    include 'View/qlDH/chitietDH.php';
                    break;
                }
                include 'View/qlDH.php';
                break;
            case 'tien-trinh':
                include 'View/tientrinh.php';
                break;
            case 'qlDT':
                include 'View/qlDoanhThu.php';
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