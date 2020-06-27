<?php
include "db.php";
include "functions.php";

$app_images_arr = app_img_arr();

$local_images_arr = get_local_image();


$all_photos =  array_merge($app_images_arr,$local_images_arr);

if(isset($_GET['data'])){

    $the_image_name = $_GET['data'];
    $visit_users =  get_all_visits($the_image_name);

    $uniq_visits =[];
    $mobile_device =[];
    $tablet_device =[];
    $computer_device =[];

    foreach($visit_users as $val){
        if($val['device_type']==='Mobile'){
            $mobile_device[]=$val;
        }elseif ($val['is_uniq'] === '1'){
            $uniq_visits[]=$val;
        }elseif ($val['device_type']==='Tablet'){
            $tablet_device[]=$val;
        }elseif ($val['device_type']==='Computer'){
            $computer_device[]=$val;
        }


    }

    $statistic_uniq = get_procent(count($visit_users),count($uniq_visits));
    $statistic_mobile = get_procent(count($visit_users),count($mobile_device));
    $statistic_tablet = get_procent(count($visit_users),count($tablet_device));
    $statistic_computer = get_procent(count($visit_users),count($computer_device));


}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <h1 class="text-center mt-5 mb-5 display-4">Click on image to receive the statistics</h1>
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <ul class="row">
                <?php
                foreach ($all_photos as $photo){
                            if(is_array($photo)){
                              echo "<li class='list-group-item'><a href='analitics.php?data={$photo['urls']['regular']}'><img src='{$photo['urls']['regular']}' width='50' alt=\"\"/></a></li>";
                            }else {
                                echo "<li class='list-group-item'><a href='analitics.php?data={$photo}'><img src='{$photo}' width='50' alt=\"\"/></a></li>";
                            }
                        }
                ?>

            </ul>
        </div>
        <div class="col-lg-7">
            <p class="text-center"><a href="index.php">Galley Witget</a></p>
            <div class="jumbotron vertical-center mt-5">
                <p>Unoq Visitors <?php echo $statistic_uniq;?>%</p>
                <p>Mobile device <?php echo $statistic_mobile;?>%</p>
                <p>Tablet device <?php echo $statistic_tablet;?>%</p>
                <p>Computer device <?php echo $statistic_computer;?>%</p>
            </div>


        </div>
    </div>
</div>
</body>
</html>
