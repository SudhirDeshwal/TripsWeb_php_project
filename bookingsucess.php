<?php include 'navbar.php'; ?>
<div class="rom-btm mb-5" style="height: 70%; margin-top:3em; ">
    <div class="row justify-content-center">
        <div class="col-6 text-center shadow p-3 mb-5 bg-white rounded">
            <?php
            if (isset($_GET['code'])) {
                echo 'Booking sucessfull, one of our agents will confirm the booking ASAP, your booking code is <h3>' . $_GET['code'] . '</h3> please check your email.';
            } else {
                header('location: trip_list.php');
            }

            ?>

        </div>
    </div>
</div>

<?php include 'footer.php'; ?>