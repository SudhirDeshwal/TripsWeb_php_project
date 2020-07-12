<?php
include_once 'utils.php';
include_once 'logging.php';
require_once 'db.php';
?>

<?php include 'navbar.php'; ?>
<div class="container">
	<?php

	$trip_id = intval($_GET['trip_id']);
	$sql = "SELECT * from trips where trip_id=:trip_id";
	$query = getConn()->prepare($sql);
	$query->bindParam(':trip_id', $trip_id, PDO::PARAM_STR);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	$cnt = 1;
	//print_r($results);
	if ($query->rowCount() > 0) {
		foreach ($results as $result) {
			$hotel = getHotel($result->hotel_id);
	?>
			<div class="rom-btm shadow p-3 mb-5 mt-5 bg-white rounded">
				<div class="row">
					<div class="col-md-4 selectroom_left wow fadeInLeft animated">
						<img src="<?php echo htmlentities($result->Trip_images); ?>" class="trip_thumb" alt="">
						<div>
							<div id='live_weather'>Live Weather</div>
							<?= getWeather($result->city); ?>
							<div id='poweredby'>Powered by OpenWeatherMap&#8482;</div>
						</div>
					</div>
					<div class="col-md-8 selectroom_right wow fadeInRight animated" data-wow-delay=".5s">
						<h3 class="trip_name"><?php echo htmlentities($result->name); ?></h3>
						<p class="dow">#TripId-<?php echo htmlentities($result->trip_id); ?></p>
						<p><b>Description :</b> <?php echo htmlentities($result->short_description); ?></p>
						<p><b>Location :</b> <?php echo htmlentities($result->city);
												echo ", ";
												echo htmlentities($result->country); ?></p>
						<p><b>Status</b> <?php echo htmlentities($result->status); ?></p>

						<Label>
							<p>From :</p>
						</Label>
						<?php echo htmlentities($result->start_date); ?>
						<Label>
							<p>To :</p>
						</Label>
						<?php echo htmlentities($result->end_date); ?>

						<h3>Only USD <?php echo htmlentities($result->cost); ?>, Only <?php echo (rand(1, 10)); ?> spots left! </h3>

						<p>Trip Details</p>
						<p style="padding-top: 1%"><?php echo $result->long_description; ?> </p>
						<div class="clearfix"></div>

						<!-- <button type="submit" name="submit2" class="btn-primary btn">Continue with Booking</button> -->
						<a href="booking.php?trip_id=<?php echo htmlentities($result->trip_id); ?>" class="btn btn-warning btn-lg font-weight-bold" role="button">BOOK NOW!</a>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<!-- Hotel Details -->
			<div class="rom-btm shadow p-3 mb-5 bg-white rounded">
				<div class="row">
					<div class="col-md-8 selectroom_right wow fadeInRight animated" data-wow-delay=".5s">
						<h2>Hotel Details</h2>
						<div class="row">
							<div class="col selectroom_left wow fadeInLeft animated">
								<h4 class="trip_name">
									<?= $hotel->name; ?> <?= $hotel->rating; ?><i class="icofont-star"></i>
								</h4>

								<div id="hotel_location">
									<i class="icofont-location-pin"></i> <?= $hotel->address; ?>
								</div>
								<br>
								<div>Amenities:</div>
								<div id="amenities">
									<i class="icofont-wifi-alt"></i>
									<i class="icofont-swimmer"></i>
									<i class="icofont-gym"></i>
									<i class="icofont-beach"></i>
									<i class="icofont-skydiving-goggles"></i>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
	<?php }
	} ?>
</div>
<?php include 'footer.php'; ?>