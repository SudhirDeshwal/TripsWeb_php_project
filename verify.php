<?php

include_once 'utils.php';
include_once 'logging.php';
include_once 'db.php';

include 'navbar.php';

fileLog("Visitor: " . json_encode($_SERVER));


?>

<div class="rom-btm mb-5" style="height: 70%; margin-top:3em; ">
    <div class="row justify-content-center">
        <div class="col-6 text-center shadow p-3 mb-5 bg-white rounded">
            <?php
            if (isset($_GET['key'])) {
                if (verifyEmail($_GET['key'])) {
                    echo "<script> setTimeout(function() { window.location.href = 'login.php'; }, 5000); </script>";
                    echo "   Account has been verified. You will be redirected to login in 5 seconds or click button.";
                    echo ' <a href="login.php" class="btn btn-success btn-md font-weight-bold" role="button">Login</a>';
                } else {
                    echo 'Verification failed, please be sure to follow the link in your email.';
                }
            } else {
                echo 'Verification key not found, please be sure to follow the link in your email.';
            }
            ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>