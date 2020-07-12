<?php
include_once 'startsession.php';
include_once 'utils.php';
include_once 'logging.php';
include_once 'db.php';

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['email']);
	unset($_SESSION['role']);
}
include 'navbar.php';
?>

<div class="container">
	<div>
		<h1 class="font-weight-bold">Trips for You</h1>
		<?php

		$sql = "SELECT * from trips order by rand() limit 4";
		$query = getConn()->prepare($sql);
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_OBJ);
		$cnt = 1;
		if ($query->rowCount() > 0) {
			foreach ($results as $result) {	?>
				<div class="rom-btm shadow p-3 mb-5 bg-white rounded">
					<div class="row">
						<div class="col-md align-self-start  wow fadeInLeft animated">
							<img src="<?php echo htmlentities($result->Trip_images); ?>" class="trip_thumb" alt="">
						</div>

						<div class="col-md align-self-start  wow fadeInUp animated">
							<h4 class="trip_name"> <?php echo htmlentities($result->name); ?></h4>
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
		} ?>

		<a href="trip_list.php" class="btn btn-success btn-lg btn-block mb-5 font-weight-bold" role="button">View All Trips</a>

	</div>
	<div class="clearfix"></div>
</div>
<?php include 'footer.php'; ?>