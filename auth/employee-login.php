<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./dist/css/style.css">
    <title>Login</title>
</head>

<body>
    <div class="container cus-login">
        <div class="row cus-login">
            <div class=" text-center cus-login">
                <h5>LOGIN</h5>
            </div>
            <div class="card-body">
                <form role="form" action="login-employee.php" method="POST">
                    <div class="form-group">
                        <label for="manv">Employee ID:</label>
                        <input type="manv" class="form-control" placeholder="Nhập mã nhân viên" name="manv" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                    </div>
                    <div class="form-group cus-form">
                        <button type="submit" name="submit" class="btn btn-outline-dark btn-cus">Login</button>
                    </div>
                    <br />
                    <div class="">
                        <p class="">Switch to client login <a href="login.php">client Login</a></p>
                    </div>  
                </form>
            </div>
        </div>
</body>

</html>