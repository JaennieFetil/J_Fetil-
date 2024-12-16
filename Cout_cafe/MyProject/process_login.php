
<?php
include_once "connect.php";
session_start();


if(isset($_POST['f_username'])){
    $uname = $_POST['f_username'];
    $pword = $_POST['f_password'];
    
    $sql_check_user_info = "SELECT *
                              FROM user_info
                            WHERE username = '$uname'
                              AND password = '$pword'
                            ";
    $sql_result = mysqli_query($conn,$sql_check_user_info);
    $count_result = mysqli_num_rows($sql_result);
    
    if($count_result == 1){
        //existing user
        $row = mysqli_fetch_assoc($sql_result);
        
        //create session variables
        $_SESSION['user_info_id'] = $row['user_info_id'];
        $_SESSION['user_info_username'] = $row['username'];
        $_SESSION['user_info_password'] = $row['password'];
        $_SESSION['user_info_fullname'] = $row['fullname'];
        $_SESSION['user_info_address'] = $row['address'];
        $_SESSION['user_info_contact_no'] = $row['contact_no'];
        $_SESSION['user_info_gender'] = $row['gender'];
        
        $_SESSION['user_info_user_type'] = $row['user_type'];
       
        if($row['user_type'] == 'A'){
            //admin
            header("location: admin/index.php?page=home");
        }
        else if($row['user_type'] == 'C'){
            //common user
            header("location: menu.php?page=home");
        }
        else{
            header("location: index.php?error=user_not_found");
        }
    }
    else{
        //username and password does not exist
    
       header("location: form.php?error=user_not_exist");
    }
}

?>