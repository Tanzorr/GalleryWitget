<?php


function check_query($query){
    global  $connect;
    if(!$query){
      echo  mysqli_error($connect);
            die("Wrong request");
    }
}

function check_uniq($user_ip, $phild, $table){
    global  $connect;
    $query = "SELECT * FROM $table WHERE $phild = '{$user_ip}'";
    $selecet_equal_ip = mysqli_query($connect, $query);
    check_query($selecet_equal_ip);
    $row= mysqli_num_rows($selecet_equal_ip);
    if($row>0){
        return 0;
    }else{
        return 1;
    }
}


function insert_visit_data($user_ip, $user_agent,$user_device, $is_unik=1, $clickrd_img){
    global  $connect;
    $query = "INSERT INTO `visitor`( `ip_adres`, `user-agent`, `device_type`, `is_uniq`,`clicked_img`)
                            VALUES ('{$user_ip}','{$user_agent}','{$user_device}',$is_unik,'{$clickrd_img}')";

    $visitor_insert = mysqli_query($connect,$query);

    check_query($visitor_insert);

}

function insert_local_image($img_name){
    global $connect;
    $query =  "INSERT INTO `local_img`( `name`) 
          VALUES ('{$img_name}')";
    $img_insert = mysqli_query($connect, $query);

    check_query($img_insert);
}


function get_local_image(){
    global $connect;
    $query =  "SELECT * FROM `local_img` ";
    $img_all_select = mysqli_query($connect, $query);
    check_query($img_all_select);

    $local_images =[];
    while ($row = mysqli_fetch_assoc( $img_all_select)){

        $local_images[]='./images/'.$row['name'];

    }

    return $local_images;
}

function app_img_arr(){
    $photoUrl ="https://api.unsplash.com/search/photos?per_page=20?page=1&query=Shre%20lanka&client_id=2aEPAfLBxuSoaU7vjXxRjktWmFf7JU1urbvvCXDXa3A";
    $photoUrl = json_decode( file_get_contents($photoUrl),true);
    return $app_images_arr = $photoUrl['results'];
}


function get_all_visits($the_image_name){
    global  $connect;

    $the_image_name;

    $query = "SELECT * FROM `visitor` WHERE `clicked_img`='{$the_image_name}'";
    $get_all_visits= mysqli_query($connect,$query);
    check_query($get_all_visits);
    $all_visits =[];

    while($row = mysqli_fetch_assoc($get_all_visits)){
        $all_visits[]=$row;

    }

    return $all_visits;

}

function get_procent($all, $option){
    if($all!==0 && $option!==0){
        return $one = $option/$all*100;
    }else{
        return 0;
    }

}

