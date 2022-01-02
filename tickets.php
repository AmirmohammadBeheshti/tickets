<?php
include('dbconfig.php');
include('authUser.php');
//isset check the reguest is valid or not valid
//get and convert to int
// $getUserId = intval($_GET['del']);
$getUserId = $_COOKIE['userId'];
$isAdmin = $_COOKIE['isAdmin'];
if (isset($_POST['submitBtn'])) {
    $title = $_POST['title'];
    $ticketText = $_POST['ticketText'];
    //insert to tickets
    $sql = function () use (&$isAdmin, &$ticketText, &$getUserId, &$title) {
        return "INSERT INTO `ticket_details`(`isAdmin`, `message`,`title`, `user_id`) VALUES ($isAdmin, '$ticketText' , '$title' , $getUserId )";
    };
    $finalSql = $sql();
    $conn->query($finalSql);
    echo '<script>alert("با موفقیت ارسال شد")</script>';
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
    <title>Document</title>
</head>

<body>
    <div class="container mt-5">
        <a href="login.php" class="btn btn-danger w-100 mb-3">خروج</a>

        <div class="tickets">
            <ul class="ticket_list">
            <?php
            $sql = function () use (&$getUserId) {
                return "SELECT *  FROM `ticket_details` WHERE user_id =  $getUserId";
            };
            $finalSql = $sql();
            $getResult = $conn->query($finalSql);
            foreach ($getResult as $row) {
            ?>
                <?php if ($row['isAdmin']) { ?>
                    <li class="ticket_message admin_ticket">
                        <p> عنوان : <?php echo $row['title'] ?></p>
                        <h6 class="primary"> <?php echo $row['message'] ?></h6>
                    </li>
                <? } else { ?>
                    <li class="ticket_message user_ticket">
                        <p> عنوان : <?php echo $row['title'] ?></p>
                        <h6 class="primary"> <?php echo $row['message'] ?></h6>
                    </li>
                <? } ?>


            <? } ?>
            </ul>
        </div>
 
        <div class="mt-3 mb-2">
            <form method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="عنوان را وارد کنید">
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="ticketText" placeholder="متن مورد نظر را وارد کنید" cols="100" rows="5"></textarea>
                </div>

                <input type="submit" class="btn btn-primary w-100" name="submitBtn" value="ارسال" />
            </form>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>