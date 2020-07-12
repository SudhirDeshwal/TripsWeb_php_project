<?php include('server.php') ?>

<?php include 'navbar.php'; ?>
<div class="header">
	<h2>Sign Up</h2>
</div>

<form class="duckform shadow p-3 mb-5 bg-white rounded" method="post" action="register.php">
	<?php include('errors.php'); ?>
	<div class="input-group">
		<label>First Name</label>
		<input type="text" name="firstName" value="<?php echo $firstName; ?>">
	</div>
	<div class="input-group">
		<label>Last Name</label>
		<input type="text" name="lastName" value="<?php echo $lastName; ?>">
	</div>
	<div class="input-group">
		<label>Email</label>
		<input type="email" name="email" value="<?php echo $email; ?>">
	</div>
	<div class="input-group">
		<label>Password</label>
		<input type="password" name="password_1">
	</div>
	<div class="input-group">
		<label>Confirm password</label>
		<input type="password" name="password_2">
	</div>
	<div class="input-group">
		<label>Phone</label>
		<input type="text" name="phone" value="<?php echo $phone; ?>">
	</div>
	<div class="input-group">
		<label>Date of Birth</label>
		<input type="date" name="dob" value="<?php echo $dob; ?>">
	</div>
	<div class="input-group">

		<button type="submit" class="btn btn-success" name="reg_user">Register</button>
	</div>
	<p>
		Already a member? <a href="login.php">Sign in</a>
	</p>
</form>
<?php include 'footer.php'; ?>