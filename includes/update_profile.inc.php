<?php 

session_start();

        if (isset($_POST["submit"])) {
            require_once 'functions.inc.php';
            require_once 'db-handler.inc.php';
            $userId = $_SESSION['id'];
            $username = sanitizeData($_POST['username']);
            $gender = sanitizeData($_POST['gender']);
            $phone_number = sanitizeData($_POST['phone_number']);
            $dob = sanitizeData($_POST['dob']);
            $profile_picture = $_FILES['profile_picture'];
            // print_r($profile_picture);
            $profile_pictureName = $profile_picture['name'];
            $profile_pictureTmpName = $profile_picture['tmp_name'];
            $profile_pictureErr = $profile_picture['error'];
            $profile_pictureSize = $profile_picture['size'];
            $profile_pictureType = $profile_picture['type'];

            $profile_pictureExt = explode('.', 
            $profile_pictureName);
            $profile_pictureActualExt = strtolower(end($profile_pictureExt));
            print_r($profile_pictureActualExt);
            $allowedExt = array ("jpg", "jpeg", "png", "gif");

            if(in_array($profile_pictureActualExt, $allowedExt)){
                if ($profile_pictureErr == 0){
                    if  ($profile_pictureSize < 10000000){
                        $profile_pictureNewName = $username .  date("Y-m-d-h-i-sa") . "." . 
                        $profile_pictureActualExt;
                        $profile_pictureActualDestination = "../uploads/" . $profile_pictureNewName;
                        move_uploaded_file($profile_pictureTmpName, $profile_pictureActualDestination );
                        echo $profile_pictureNewName . "uploaded successfully";
                    }
                    else{
                    header("location: ../update_profile.php?error=filetoolarge");
                    exit(); }
                }
                else{
                header("location: ../update_profile.php?error=fileerr");
                    exit(); }

                    updateUser($db_connection,$userId, $username, $gender,$phone_number, $dob, $profile_pictureNewName);
            }
            else{
                    header("location: ../update_profile.php?error=invalidfiletype");
                    exit(); }                

        }