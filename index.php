<?php
include_once 'header.php';
?>

<section class="container mt-5">
    <h1 class="text-center display-5">
        <?php 
            if (isset($_SESSION['id'])) {
                echo 'Welcome ' . $_SESSION['username'] . $_SESSION["fullname"];
            } else {
                echo 'Welcome';
            }
        ?>
    </h1>
</section>

<?php
include_once 'footer.php'
?>