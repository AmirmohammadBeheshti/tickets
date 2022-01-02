<?php
include('dbconfig.php');

if (isset($_POST['submitBtn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = function () use (&$username, &$password) {
        return "SELECT * FROM  `users` WHERE username = '$username' && password='$password'";
    };
    $finalSql = $sql();
    $getResult = $conn->query($finalSql);
    $i = 0;
    $isAdmin = 0;
    foreach ($getResult as $row) {
        $i++;
        $isAdmin = $row['isAdmin'];
        setcookie("isAdmin", $isAdmin , time() + 2 * 24 * 60 * 60);
        setcookie("userId", $row['id'], time() + 2 * 24 * 60 * 60);
    }
    if($i !== 0){
        echo '
        <script>
        alert("ورود با موفقیت انجام شد");
        </script>
        ';
        if($isAdmin){
            echo '<script>
        window.location.href = "index.php";
            </script>';
        }else{
            echo '<script>
            window.location.href = "tickets.php";
                </script>';
        }
    }else{
        echo '
        <script>
        alert("نام کاربری یا رمز عبور اشتباه است");
        </script>
        ';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css" />
    <title>Login Page</title>
</head>

<body>
    <div class="container center_page text-right">
        <div class="set_shadow p-3 mb-5 bg-white rounded">
            <h4 class="mb-3 text-success">ورود</h4>
            <form method="post">
                <input class="form-control mt-2" type="text" name="username" placeholder="نام کاربری خود را وارد کنید">
                <input class="form-control mt-3" type="password" name="password" placeholder="رمز عبور خود را وارد کنید">
                <input type="submit" class="btn btn-primary mt-3 w-100" name="submitBtn" value="ورود" />
            </form>
            <a class="btn btn-success mt-3" href="register.php">ثبت نام</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>