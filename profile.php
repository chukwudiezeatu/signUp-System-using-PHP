<?php
include_once 'header.php'
    ?>

<section class="mt-5 container">

    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] === "empty_input") {
            echo '<div style="width: 300px;" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Oops!</strong> Please fill in all text fields. Thanks!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        } else if ($_GET["error"] === "invalid_email") {
            echo '<div style="width: 300px;" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Oops!</strong> Please provide a valid email. Thanks.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }

    }
    ?>

    <h1 class="text-center display-5">PROFILE</h1>

    <div class="rounded-circle mx-auto bg-light" style="height : 200px; width :200px;">
        <img src="" alt="" class="img-fluid">

    </div>
    

    <div class="mt-3 text-center mb-3">
        <i class="bi bi-person-circle fs-4"></i><h5>fullname: </h5>
        <span class="fs-4 fw-bold"> <?php echo $_SESSION["fullname"]
         ?></span>
         <hr>
    </div>
    <div class="mt-3 text-center mb-3">
        <i class="bi bi-envelope fs-4"></i><h5>Email: </h5>
        <span class="fs-4 fw-bold"> <?php echo $_SESSION["email"]
         ?></span>
         <hr>
    </div>

    <div class="mt-3 text-center mb-3">
        <i class="bi bi-person-workspace fs-4"></i><h5>Username: </h5>
        <span class="fs-4 fw-bold"> <?php echo $_SESSION["username"]
         ?></span>
         <hr>
    </div>

    <div class="mt-3 text-center mb-3">
        <i class="bi fs-4 bi-<?php if ($_SESSION["gender"] == "female"){
            echo "person-standing-dress";
        }
        else {
              echo "person-standing";
        }
         ?>" ></i><h5>Gender: </h5>
        <span class="fs-5 fw-bold"><?php echo !empty($_SESSION["gender"]) ? $_SESSION["gender"] : '<span class="lead">UPDATE PROFILE</span>' ?></span>
         <hr>

          <div class="mt-3 text-center mb-3">
        <i class="bi bi-telephone fs-4"></i><h5>Phone: </h5>
        <span class="fs-5 fw-bold"><?php echo !empty($_SESSION["phone_number"]) ? $_SESSION["phone_number"] : '<span class="lead">UPDATE PROFILE</span>' ?></span>
         <hr>

         <div class="mt-3 text-center mb-3">
        <i class="bi bi-telephone fs-4"></i><h5>Date Of Birth: </h5>
        <span class="fs-5 fw-bold"><?php echo !empty($_SESSION["dob"]) ? $_SESSION["dob"] : '<span class="lead">UPDATE PROFILE</span>' ?></span>
         <hr>

         <div class="d-grid d-md-block">
                        <a href="update_profile.php" class="btn btn-primary">Edit</a>
                    </div>
    </div>
    </div>

</section>

<?php
include_once 'footer.php'
    ?>