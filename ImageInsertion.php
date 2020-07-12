<?php

require_once 'db.php';
include 'navbar.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header('location: index.php');
}

$query4 = "Select * from trips";

$resultSetVal = getConn()->query($query4);

?>
<div class="rom-btm mb-5" style="height: 70%; margin-top:3em; ">
  <div class="row justify-content-center">
    <div class="col-11 align-center shadow p-3 mb-5 bg-white rounded">

      <h3 class="trip_name">Add Images to Trip</h1>
        <form action="ImageDatabase.php" method="post" enctype="multipart/form-data">

          <div class="form-group row">
            <label for="status" class="col-sm-2 col-form-label"> Trip:</label>
            <div class="col-sm-5">
              <select class="form-control" name="selectValue" id="status">
                <?php
                while ($row = $resultSetVal->fetch()) {
                  $tripId = $row['trip_id'];
                  $tripName = $row['name'];
                  echo "<option value='$tripId'>" . $tripName . "</option>";
                }
                ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="file">Trip Images:</label>
            <div class="col-sm-5">
              <input class="form-control-file" type="file" name="file" id="file">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-5">
              <input type="submit" class="btn btn-success" value="SAVE" name="btnins" class="btn">
            </div>
          </div>


        </form>
    </div>
  </div>
</div>
<?php
include 'footer.php';
?>