<?php
    include "Userinfor.php";
    include "db.php";
    include "functions.php";
    $c_info = new UserInfo();

        $app_images_arr = app_img_arr();

        $local_images_arr = get_local_image();


        $all_photos =  array_merge($app_images_arr,$local_images_arr);
          $rand_photo = rand(0,count($all_photos));
          $photo = "";
        if(is_array($all_photos[$rand_photo])){

            $photo = $all_photos[$rand_photo]['urls']['regular'];
        }else {

           $photo = $all_photos[$rand_photo];
        }



   $user_agent = $_SERVER['HTTP_USER_AGENT'];
          $user_ip = $c_info->get_ip();
          $user_device = $c_info->get_device();
           $uniq =check_uniq($user_ip,'is_uniq','visitor');

   if(isset($_GET['get_data'])){

      $photo = $_GET['get_data'];

       insert_visit_data($user_ip,$user_agent,$user_device, $uniq, $photo);

   }

   if(isset($_POST['submit']) && $_FILES['img']['name']!==''){
       $img_name = $_FILES['img']['name'];
       $post_image_temp = $_FILES['img']['tmp_name'];

        move_uploaded_file($post_image_temp,"./images/$img_name");
        if(check_uniq("$img_name","name","local_img")===1){
            insert_local_image($img_name);
        }

   }



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-5 mb-5 display-4">Shri lanka gallery</h1>
        <p class="text-center"><a href="analitics.php">Images static interface</a></p>
        <div class="row justify-content-center">
            <a href="http://www.srilankaembassy.ru/ru/" id="send" target="_blank">
                <img src="<?php echo $photo; ?>" alt="" class="rounded"  width="492" height="328">
            </a>
        </div>
        <h2 class="text-center mt-5 mb-5 display-4">Add new Images</h2>
        <div class="row justify-content-center">
            <form action="index.php" method="post" enctype="multipart/form-data">
                <input type="file" name="img" id="img">
                <input type="hidden" name="img_chek" value="check">
                <input type="submit" name="submit" id="submit" class="btn btn-primary">
            </form>
        </div>


        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("#send").click(function (e) {
               console.log("src", e.target.src)
             $.get(`index2.php?get_data=${e.target.src}`)
                location.reload()
            })





        })
    </script>
</body>
</html>