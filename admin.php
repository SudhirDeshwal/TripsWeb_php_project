<?php

include 'navbar.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('location: index.php');
}

?>
<div class="rom-btm mb-5" style="height: 70%; margin-top:3em; ">
    <div class="row justify-content-center">
        <div class="col-6 text-center shadow p-3 mb-5 bg-white rounded">
            <h3 class="trip_name">Admin Area</h3>

            <a href="BookingManagement.php" class="btn btn-primary btn-md " role="button">Manage Bookings</a>
            <a href="TripInsertForm.php" class="btn btn-primary btn-md " role="button">Create New Trip</a>
            <a href="ImageInsertion.php" class="btn btn-primary btn-md " role="button">Insert Images for Trip</a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>