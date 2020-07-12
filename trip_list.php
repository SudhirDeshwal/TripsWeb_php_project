<?php
include_once 'utils.php';
include_once 'logging.php';
include_once 'db.php';
include 'navbar.php';
?>

<div class="container">
	<div>
		<h3>Trips for You</h3>
		<?php
		if (isset($_GET['search'])) {
			$trips = searchTrips($_GET['search']);
		} else {
			$trips = getAllTrips();
		}
		if (count($trips) > 0) {
			foreach ($trips as $result) {	?>
				<div class="rom-btm shadow p-3 mb-5 bg-white rounded">
					<div class="row">
						<div class="col-md align-self-start  wow fadeInLeft animated">
							<img src="<?php echo htmlentities($result->Trip_images); ?>" class="trip_thumb" alt="">
						</div>
						<div class="col-md align-self-start  wow fadeInUp animated">
							<h4> <?php echo htmlentities($result->name); ?></h4>
							<p><b>Location:</b> <?php echo htmlentities($result->country); ?></p>
							<p><b>Features: </b> <?php echo htmlentities($result->short_description); ?></p>
						</div>
						<div class="col-md align-self-center  wow fadeInUp animated">
							<h2 class="font-weight-bold">USD <?php echo htmlentities($result->cost); ?></h2>
							<a href="trip_details.php?trip_id=<?php echo htmlentities($result->trip_id); ?>" class="btn btn-warning btn-md font-weight-bold" role="button">Booking and more Details</a>
						</div>
					</div>
				</div>
			<?php }
		} else {
			?>
			<div class="rom-btm shadow p-3 mb-5 bg-white rounded">
				<div class="row">
					<div class="col-md align-self-start  wow fadeInLeft animated">
						No results found.
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
	<div class="clearfix"></div>
</div>
<?php include 'footer.php'; ?>