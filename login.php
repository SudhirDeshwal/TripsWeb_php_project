<?php include 'navbar.php'; ?>
<?php include('server.php') ?>
<div class="header">
	<h2>Login</h2>
</div>

<form class="duckform shadow p-3 mb-5 bg-white rounded" method="post" action="login.php">
	<?php include('errors.php'); ?>
	<div class="input-group">
		<label>Email</label>
		<input type="email" name="email">
	</div>
	<div class="input-group">
		<label>Password</label>
		<input type="password" name="password">
	</div>
	<div class="input-group">

		<button type="submit" class="btn btn-success" name="login_user">Login</button>
	</div>
	<p>
		Not yet a member? <a href="register.php">Sign up</a>
	</p>
</form>
<?php include 'footer.php'; ?>