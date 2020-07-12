<?php
include_once 'startsession.php';
require_once 'db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  http_response_code(401);
  exit();
}

if (isset($_POST["btnins"])) {

  $name = $_FILES['file']['name'];
  $temp_name = $_FILES['file']['tmp_name'];
  move_uploaded_file($_FILES['file']['tmp_name'], 'images/' . $name);

  $tripID = (int) $_POST["selectValue"];

  $query1 = "Insert into Images(path,trip_id) values('./images/" . $name . "'," . $tripID . ")";

  $upd = getConn()->exec($query1);
  if ($upd < 1) {
    echo "Image Saving Failed.";
  } else {

    include("ImageInsertion.php");
  }
}
