<?php
include_once 'startsession.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  http_response_code(401);
  exit();
}

require_once 'db.php';

if (isset($_POST['btnins'])) {

  if (isset($_POST["btnins"])) {
    $tripName = $_POST["tripnm"];
    $shortDesc = $_POST["tripsdesc"];
    $lonDesc = $_POST["tripldesc"];
    $tripCity = $_POST["tripcity"];
    $tripCountry = $_POST["tripcountry"];
    $tripsDate = $_POST["tripsdate"];
    $name = $_FILES['file']['name'];
    $temp_name = $_FILES['file']['tmp_name'];
    move_uploaded_file($_FILES['file']['tmp_name'], 'images/' . $name);
    $tripeDate = $_POST["tripedate"];
    $tripCost = (int) $_POST["tripcost"];
    $hotelId = (int) $_POST["selectValue"];

    if (isset($_POST["stat"]) && $_POST["stat"] == "Yes") {
      $sta = "open";
    } else {
      $sta = "close";
    }

    if (is_numeric($tripCost) && !empty($tripName) && !empty($shortDesc) && !empty($lonDesc) && !empty($tripCity) && !empty($tripCountry)) {
      if ($tripsDate < $tripeDate) {

        $query1 = "Insert into trips(name,short_description,long_description,country,start_date,end_date,hotel_id,cost,status,trip_images,city) values('" . $tripName . "','" . $shortDesc . "','" . $lonDesc . "','" . $tripCountry . "','" . $tripsDate . "','" . $tripeDate . "'," . $hotelId . "," . $tripCost . ",'" . $sta . "','images/" . $name . "','" . $tripCity . "')";
        $upd = getConn()->exec($query1);
        if ($upd < 1) {
          echo "Enter Proper values.";
        } else {
          include("TripInsertForm.php");
        }
      } else {

        echo "End Date is smaller than the start date";
      }
    } else {
      echo "Enter Proper values.";
    }
  }
}
