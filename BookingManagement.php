<?php
require_once 'db.php';
require_once 'sendemail.php';
include 'navbar.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header('location: index.php');
}

if (isset($_POST['subBtn'])) {
  if (!isset($_POST["status"])) {
    echo "Status must be selected.";
  } else {
    if ($_POST["status"] === "approve") {
      $query2 = "Update bookings Set status='Approve' where booking_id=" . $_POST["bookingId"];
      $upd = getConn()->exec($query2);
      sendBookingConfirmation($_POST["bookingId"]);
    } else {
      $query2 = "Update bookings Set status='Cancel' where booking_id=" . $_POST["bookingId"];
      $upd = getConn()->exec($query2);
    }
  }
}

$bookings = getPendingBookings();

?>

<div class="rom-btm mb-5" style="height: 70%; margin-top:3em; ">
  <div class="row justify-content-center">
    <div class="col-11 text-center shadow p-3 mb-5 bg-white rounded">
      <h3>Booking Approval</h3>
      <table class='table table-bordered table-hover'>
        <thead class="thead-light">
          <tr>
            <th>Booking Id</th>
            <th>Trip Name</th>
            <th>No of Adults</th>
            <th>No of Children</th>
            <th>Total Cost</th>
            <th>User Id</th>
            <th>Notes</th>
            <th>Booking Code</th>
            <th>Set Status</th>

            <th>Submission</th>
          </tr>
          <thead>
            <?php

            foreach ($bookings as $row) { ?>
              <form method='post' action="">
                <input type="hidden" name="bookingId" value=" <?= $row['booking_id'] ?>  ">
                <?php
                echo "<tr><td>" . $row['booking_id'] . "</td><td>" . $row['name'] . "</td><td>" . $row['number_adults'] . "</td><td>" . $row['number_children'] . "</td><td>" . $row['total_cost'] . "</td><td>" . $row['user_id'] . "</td><td>" . $row['notes'] . "</td><td>" . $row['booking_code'] .
                  "</td>
                <td>
                <input type='radio' id='approve' name='status' value='approve'> Approve
                  <input type='radio' id='cancel' name='status' value='cancel'> Cancel
                  
                  </td><td><input type='submit' name='subBtn' value='Save'></td></tr>"; ?>
              </form>
            <?php
            }

            ?>

      </table>
    </div>
  </div>
</div>
<?php
include 'footer.php';
