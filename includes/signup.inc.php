<?php


if (isset($_POST["signup"])) {

    require_once "functions.inc.php";

    $fullname = sanitizeData($_POST["fullname"]);
    $email = sanitizeData($_POST["email"]);
    $username = sanitizeData($_POST["username"]);
    $pwd = sanitizeData($_POST["password"]);
    $confirm_pwd = sanitizeData($_POST["con-password"]);

    require_once "db-handler.inc.php";

    if (emptySignupInput($fullname, $email, $username, $pwd, $confirm_pwd)) {
        header("location: ../signup.php?error=empty_input");
        exit();
    }
    if (invalidEmail($email)) {
        header("location: ../signup.php?error=invalid_email");
        exit();
    }
    if (invalidUsername($username) !== false) {
        header("location: ../signup.php?error=invalid_username");
        exit();
    }
    if (pwdMatch($pwd, $confirm_pwd) !== false) {
        header("location: ../signup.php?error=passwords_dont_match");
        exit();
    }
    if (userAlreadyExists($db_connection ,$username, $email)) {
        header("location: ../signup.php?error=user_already_exits");
        exit();
    }

    createUser($db_connection, $fullname, $email, $username, $pwd);
} else {
    header("location: ../signup.php");
    exit();
}
