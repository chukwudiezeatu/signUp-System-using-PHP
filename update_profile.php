<?php 
include_once "header.php"
?>
<section class="mt-5 container">

<?php
    if(isset($_GET["error"])){
        if ($_GET["error"] === "empty_input") {
            echo '<div style="width: 300px;" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Oops!</strong> Please fill in all text fields. Thanks!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        else if ($_GET["error"] === "invalid_email") {
            echo '<div style="width: 300px;" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Oops!</strong> Please provide a valid email. Thanks.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        else if ($_GET["error"] === "invalid_username") {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Oops!</strong> Username is invalid, must be an alpha-numeric text without space. Thanks.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        else if ($_GET["error"] === "passwords_dont_match") {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Oops!</strong> Passwords do not match.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        else if ($_GET["error"] === "user_already_exits") {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Oops!</strong> Username or Email has already been taken.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        else if ($_GET["error"] === "user_already_exits") {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Oops!</strong> Username or Email has already been taken.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        else if ($_GET["error"] === "stmt_failed") {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Oops!</strong> Technical issues. Please Contact Support 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    }
?>

<h1 class="text-center display-5">Update Profile</h1>

<div class="container">
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <form method="post" action="includes/update_profile.inc.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="fullname" class="form-label">Full Name</label>
                    <input type="text" name="fullname" class="form-control" id="fullname" value="<?php echo $_SESSION['fullname']; ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" id="exampleInputPassword1" value="<?php echo $_SESSION['email']; ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">username</label>
                    <input type="text" name="username" class="form-control" id="username" value="<?php echo $_SESSION['username']; ?>">
                </div>
                <div class="mb-3">
                    <label for="profile_picture" class="form-label">Profile Picture</label>
                    <input type="file" name="profile_picture" class="form-control" id="profile_picture">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Gender</label>
                    <select name="gender" id = "gender" class = "form-select" > 
                        <option value="male"> Male</option>
                        <option value="female" <?php echo isset($_SESSION["gender"]) == "female" ? "selected" : "" ?>> Female</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone number</label>
                    <input type="number" class="form-control" id="phone_number" name="phone_number"  value = "<?php echo $_SESSION["phone_number"]; ?>" placeholder="080x xxx xxxxx" >
                </div>

                <div class="mb-3">
                    <label for="phoneNumber" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="dob" name="dob" value = "<?php echo $_SESSION["dob"]; ?>" >
                </div>

                <button name="submit" type="submit" class="btn btn-primary mb-5 mx-auto">Update</button>
            </form>
        </div>
    </div>
</div>

</section>



<?php 
include_once "footer.php"
?>