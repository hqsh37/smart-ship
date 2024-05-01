<!DOCTYPE html>
<html>

<head>
    <title>Login Form</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" href="./dist/css/style.css">
</head>

<body>
    <div class="container cus-signup">
        <div class="row px-3">
            <div class="col-lg-12 col-xl-12 card flex-row mx-auto px-0">
                <div class="card-body col-lg-12">
                    <h4 class="title text-center mt-4">
                        SIGN UP
                    </h4>

                    <form action="" method="POST">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for=""><b>Họ và tên:</b></label>
                                <input type="text" class="form-control" placeholder="Họ và tên" value="">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for=""><b>Số điện thoại:</b></label>
                                <input type="number" class="form-control" placeholder="Số điện thoại" min="0" value="">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for=""><b>Email:</b></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend3">@</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Email">
                                </div>
                            </div>


                            <div class="col-md-6 mb-3">
                                <label for="validationServer03"><b>Năm sinh:</b></label>
                                <input type="date" class="form-control" placeholder="City">

                            </div>

                            <div class="col-md-6 mb-3">
                                <label for=""><b>Giới tính:</b> </label>
                                <input type="radio" name="gender" id="" class="ml-3">
                                <label for="">Nam</label>
                                <input type="radio" name="gender" id="" class="ml-3">
                                <label for="">Nữ</label>

                            </div>

                            <div class="col-md-12 mb-3">
                                <label for=""><b>Mật khẩu:</b></label>
                                <input type="password" class="form-control" placeholder="mật khẩu" min="0" value="">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for=""><b>Nhập lại mật khẩu:</b></label>
                                <input type="password" class="form-control" placeholder="nhập lại mật khẩu" min="0"
                                    value="">
                            </div>
                        </div>
                        <div class="form-row">
                        </div>
                        <div class="text-center">
                            <input type="submit" value="Sign up" class="btn btn-primary">
                        </div>
                        <hr class="my-1">
                        <div class="text-center mb-2">
                            You already have a Sign up?
                            <b><a href="login.php" class="text-danger"> Login </a></b>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>