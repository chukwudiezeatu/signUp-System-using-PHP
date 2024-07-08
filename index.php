<?php
include_once 'header.php';
?>

<section class="container mt-5">
    <h1 class="text-center display-5">
        <?php 
            if (isset($_SESSION['id'])) {
                echo 'Welcome ';
            } else {
                echo 'Welcome';
            }
        ?>
    </h1>
    <h2 class="text-center display-4">
    <?php 
            if (isset($_SESSION['id'])) {
                echo 'hi ' . $_SESSION['username'];
            } else {
                echo '';
            }
        ?>
    </h2>
</section>

<?php
include_once 'footer.php'
?>