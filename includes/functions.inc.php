<?php

function sanitizeData($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

function emptySignupInput($fullname, $email, $username, $pwd, $confirm_pwd)
{
    $result = "";
    if (empty($fullname) || empty($email) || empty($username) || empty($pwd) || empty($confirm_pwd)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}
function invalidEmail($email)
{
    $result = "";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function invalidUsername($username)
{
    $result = "";
    if (!preg_match("/^[a-zA-Z][a-zA-Z0-9_.-]{2,15}$/", $username)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}
function pwdMatch($pwd, $confirm_pwd)
{
    $result = "";
    if ($pwd !== $confirm_pwd) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function userAlreadyExists($db_connection, $username, $email)
{
    $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = mysqli_stmt_init($db_connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../sign-up.php?error=stmt_failed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    // Executing statement
    mysqli_stmt_execute($stmt);

    $retrieved_data = mysqli_stmt_get_result($stmt);

    $row = mysqli_fetch_assoc($retrieved_data);

    mysqli_stmt_close($stmt);
    if ($row) {
        return $row;
    } else {
        $result = false;
        return $result;
    }
}
function createUser($db_connection, $fullname, $email, $username, $pwd)
{
    $sql = "INSERT INTO users(name, email, username, pwd) VALUES (?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($db_connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../sign-up.php?error=stmt_failed");
        exit();
    }

    $hash_pwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $fullname, $email, $username, $hash_pwd);
    // Executing statement
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    header("location: ../login.php?error=none");
    exit();
}


// LOGIN FUNCTIONS

function emptyLoginInput($username, $pwd)
{
    $result = "";
    if (empty($username) || empty($pwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function loginUser($connection, $username, $pwd)
{
    $getUser = userAlreadyExists($connection, $username, $username);
    if (!$getUser) {
        header("location: ../login.php?error=wrong_input");
        exit();
    }
    $checkPassword = password_verify($pwd, $getUser["pwd"]);

    if(!$checkPassword){
        header("location: ../login.php?error=wrong_password");
        exit();
    }
    else{
        session_start();

        $_SESSION["username"] = $getUser["username"];
        $_SESSION["fullname"] = $getUser["name"];
        $_SESSION["email"] = $getUser["email"];
        $_SESSION['id'] = $getUser["id"];
        $_SESSION["gender"] = $getUser["gender"];
        $_SESSION["phone_number"] = $getUser["phone_number"];
        $_SESSION["profile_picture"] = $getUser["profile_picture"];
        $_SESSION['dob'] = $getUser["dob"];


        header("location: ../index.php");
        exit();
    }
}

function updateUser($db_connection,$userId, $username, $gender,$phone_number, $dob, $profile_pictureNewName){
        //echo "Debug Info:<br>";
        //echo "User ID: " . htmlspecialchars($userId) . "<br>";
        //echo "Username: " . htmlspecialchars($username) . "<br>";
        //echo "Phone Number: " . htmlspecialchars($phone_number) . "<br>";
        //echo "DOB: " . htmlspecialchars($dob) . "<br>";
        //echo "Sex: " . htmlspecialchars($gender) . "<br>";
        //echo "Profile Picture Name: " . htmlspecialchars($profile_pictureNewName) . "<br>";
        $sql = "UPDATE users SET username = ?, gender = ?, phone_number = ?, dob = ?, profile_picture = ? WHERE id = ?";
        $stmt = mysqli_stmt_init($db_connection);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../update_profile.php?error=stmt_failed");
            exit();
        }
    
        mysqli_stmt_bind_param($stmt, "sssssi", $username, $gender,$phone_number, $dob, $profile_pictureNewName, $userId,);
        if(!mysqli_stmt_execute($stmt)) {
            header("location: ../update_profile.php?error=updatefailed");
            exit();
        };
        mysqli_stmt_close($stmt);

        $getUpdate = userAlreadyExists($db_connection, $username, $username);
        if ($getUpdate !== false){
            session_start();

            $_SESSION["username"] = $getUpdate["username"];
            $_SESSION["phone_number"] = $getUpdate["phone_number"];
            $_SESSION["dob"] = $getUpdate["dob"];
            $_SESSION["gender"] = $getUpdate["gender"];
            $_SESSION["profile_picture"] = $getUpdate["profile_picture"];

            header("location: ../profile.php?error=none");
            exit();
        }
}
            
