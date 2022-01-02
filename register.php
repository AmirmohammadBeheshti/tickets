<?php
include('dbconfig.php');

if (isset($_POST['insert'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userSql = "SELECT * FROM `users`";
    $allUsers = $conn->query($userSql);
    $isValid = 0;
    $i = 0;
    foreach ($allUsers as $row) {
        if ($username == $row['username']) {
            $isValid = 1;
            break;
        } else {
            $isValid = 0;
        }
    }
    echo $isValid;
if(!$isValid) {
    $sql = function () use (&$username, &$password) {
        return "INSERT INTO `users`(`isAdmin`, `username`, `password`) VALUES (false , '$username' , '$password' )";
    };
    $finalSql = $sql();
    $conn->query($finalSql); 

    echo '<script>
    alert("ثبت نام با موفقیت انجام شد");
    window.location.href="login.php";
    </script>';
}else{
    echo '<script>
    alert("نام کاربری تکراری است");
    </script>';
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css" />
</head>

<body>
    <div class="container center_page text-right">
        <div class="set_shadow p-3 mb-5 bg-white rounded">
            <h4 class="mb-3 text-success">ثبت نام</h4>
            <form method="post">
                <input class="form-control mt-2" type="text" name="username" value="mohammadAmin" placeholder="نام کاربری خود را وارد کنید">
                <input class="form-control mt-3" type="password" name="password" value="Bayazidi" placeholder="رمز عبور خود را وارد کنید">
                <input type="submit" class="btn btn-primary mt-3 w-100" name="insert" value="ثبت نام" />
            </form>
            <a class="btn btn-success mt-3" href="login.php">ورود</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>

</html>