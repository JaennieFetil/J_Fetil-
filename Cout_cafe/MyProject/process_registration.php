<?php
require_once "connect.php";

$fullname =  $_POST['r_fullname'];
$uname =  $_POST['r_username'];
$passwd = $_POST['r_passwrd'];
$conf_passwd = $_POST['r_conf_passwrd'];
$address =  $_POST['r_address'];
$contact = $_POST['r_contact'];
$gender = $_POST['r_gender'];


function chk_pass($p1, $p2) {
  return ($p1 == $p2) ? 1:0;
}
 
    if(!chk_pass($passwd, $conf_passwd)){
        header("location: registration.php?error=password_mismatch");
        die;
    }

//This will check if the username is already existing
$sql_chk_user = "SELECT user_info_id FROM user_info
                  WHERE username = '$uname'";
//this will execute the SQL above.
$sql_result = mysqli_query($conn, $sql_chk_user);
//This will count the result of the above SQL
$count_result = mysqli_num_rows($sql_result);

if($count_result > 0){
    //user already exists
    header("location: lp.php?error=user_already_exist");
}
else {
    //user can register
    $sql_new_user = "INSERT INTO user_info
                      (username, password, fullname, address, contact_no, gender, user_type)
                     VALUES
                      ('$uname','$passwd','$fullname','$address','$contact','$gender', 'C')
                     ";
    $execute_query = mysqli_query($conn,$sql_new_user);
    
    if(!$execute_query){
       header("location: lp.php?error=Insert_Failed");
    }
    else{
       header("location: loginform.php?msg=successfully_registered");
    }
    
}
        