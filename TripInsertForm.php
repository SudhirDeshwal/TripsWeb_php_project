<?php
require_once 'db.php';
include 'navbar.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header('location: index.php');
}

$query4 = "Select hotel_id,name from hotels";

$resultSetVal = getConn()->query($query4);

?>

<div class="rom-btm mb-5" style="height: 70%; margin-top:3em; ">
  <div class="row justify-content-center">
    <div class="col-11 align-center shadow p-3 mb-5 bg-white rounded">

      <h1 class="trip_name">Trip Creation</h1>
      <form action="TripDatabase.php" method="post" enctype="multipart/form-data">
        <div class="form-group row">
          <label for="name" class="col-sm-2 col-form-label">Enter the Trip Name:</label>
          <div class="col-sm-5">
            <input class="form-control" type="text" name="tripnm" id="name">
          </div>
        </div>

        <div class="form-group row">
          <label for="sdesc" class="col-sm-2 col-form-label">Short Description:</label>
          <div class="col-sm-5">
            <input class="form-control" type="text" name="tripsdesc" id="sdesc">
          </div>
        </div>
        <div class="form-group row">
          <label for="ldesc" class="col-sm-2 col-form-label">Long Description :</label>
          <div class="col-sm-5">
            <textarea class="form-control" id="ldesc" name="tripldesc" rows="3"></textarea>
          </div>
        </div>
        <div class="form-group row">
          <label for="city" class="col-sm-2 col-form-label">City:</label>
          <div class="col-sm-5">
            <input class="form-control" type="text" name="tripcity" id="city">
          </div>
        </div>
        <div class="form-group row">
          <label for="country" class="col-sm-2 col-form-label">Country:</label>
          <div class="col-sm-5">
            <input class="form-control" type="text" name="tripcountry" id="country">
          </div>
        </div>
        <div class="form-group row">
          <label for="date" class="col-sm-2 col-form-label">Start Date:</label>
          <div class="col-sm-5">
            <input class="form-control" type="date" name="tripsdate" id="date">
          </div>
        </div>
        <div class="form-group row">
          <label for="edate" class="col-sm-2 col-form-label">End Date:</label>
          <div class="col-sm-5">
            <input class="form-control" type="date" name="tripedate" id="edate">
          </div>
        </div>
        <div class="form-group row">
          <label for="cost" class="col-sm-2 col-form-label">Cost:</label>
          <div class="col-sm-5">
            <input class="form-control" type="text" name="tripcost" id="cost">
          </div>
        </div>

        <div class="form-group row">
          <label for="status" class="col-sm-2 col-form-label"> Hotel:</label>
          <div class="col-sm-5">
            <select class="form-control" name="selectValue" id="status">
              <?php
              while ($row = $resultSetVal->fetch()) {
                $hotid = $row['hotel_id'];
                $hotNm = $row['name'];
                echo "<option value='$hotid'>" . $hotNm . "</option>";
              }
              ?>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-2">Status:</div>
          <div class="col-sm-5">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="status" name="stat" value="Yes">
              <label class="form-check-label" for="status">
                Open / Closed
              </label>
            </div>
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