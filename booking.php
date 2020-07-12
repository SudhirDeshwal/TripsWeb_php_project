<?php
include_once 'startsession.php';
include_once 'utils.php';
include_once 'logging.php';
include_once 'db.php';
include_once 'bookCar.php';
include_once 'sendemail.php';

if (isset($_POST['book_trip']) && isset($_SESSION['userid'])) {

  $bookingCode = bookingCodeGen();
  $result = createNewBooking($_POST['tripid'], $_SESSION['userid'], $_POST['adults'], $_POST['children'], $_POST['notes'], $_POST['costtotal'],  $bookingCode);

  if ($result) {
    $userName = getUsername($_SESSION['userid']);
    if (sendBookingEmail($_SESSION['email'], $userName, $bookingCode)) {
      header('location: bookingsucess.php?code=' . $bookingCode);
    }
  }
} else {
}


if (isset($_GET['trip_id'])) {
  $trip = getTrip($_GET['trip_id']);
} else {
  if (isset($_POST['tripid'])) {
    $trip = getTrip($_POST['tripid']);
  } else {
    header('location: trip_list.php');
  }
}

?>

<?php include 'navbar.php'; ?>

<div class="container">
  <div class="row shadow p-3 mb-3 mt-3 bg-white rounded">
    <div class="col">
      <div>
        <h3 class="trip_name">Booking <?= $trip['name'] ?>
        </h3>
      </div>
      <?php
      echo generateCar(getImagesForCar($trip['trip_id']));
      ?>
    </div>
    <div class="col">
      <div class="mt-1">
        <i class="icofont-info-circle"></i>
        <br>
        <?= $trip['long_description']; ?>
      </div>
      <div class="mt-1">
        <i class="icofont-location-pin"></i> <?= $trip['city']; ?> , <?= $trip['country']; ?>
      </div>
      <div class="mt-1">
        <?php
        $sDate = new DateTime($trip['start_date']);
        $sDateFormat = $sDate->format("D F j, Y");
        $eDate = new DateTime($trip['end_date']);
        $eDateFormat = $eDate->format("D F j, Y");
        ?>
        <i class="icofont-ui-calendar"></i> <b>Starts:</b> <?= $sDateFormat  ?> <b> Ends: </b> <?= $eDateFormat ?>
      </div>
    </div>
  </div>

  <div class="row shadow p-3 mb-2  bg-white rounded">
    <div class="col">
      Booking Details
      <?php
      if (isset($_SESSION['email'])) {
        include_once 'bookingform.php';
      } else {
        include_once 'loginrequired.php';
      }
      ?>
    </div>

  </div>

</div>


<?php include 'footer.php'; ?>