<?php include('data.php'); ?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="materialize/css/materialize.min.css">
	<link rel="stylesheet" href="login.css">
    <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
    <script src="js/jquery.min.js"></script>
  
</head>
<body>
	<br><br><br>
<form class="col s12" method="post" action="login.php">
<div class="row">
	<div class="col s12 m4 offset-m4">
		<div class="card">

			<div class="card-action teal lighten-1 white-text">
				<h3 align="center">Login Form</h3>
				<!-- display validation errors here -->
                <?php include('errors.php');?>
			</div>
			<div class="card-content">
				<div class="form-field">
					<label for="username">Username</label>
					<input type="text" id="username" name="username" >
				</div><br>
				<div class="form-field">
					<label for="password">Password</label>
					<input type="password" id="password" name="password" >
				</div><br>
				<div class="form-field">

      <label>
        <input type="checkbox" id="remem" />
        <span for="remem">Remember me</span>
      </label>
   
                </div><br>
				<div class="form-field">
					<button class="btn-large waves-effect waves-dark" name="login" id="login" style="width:100%;">Login</button>
					<span id="status"></span>
				</div><br>
				<p>Forgot password? <a href="forgot.php">Reset</a> |  Not registered? <a href="register.php">Register</a></p>
				
			</div>
		</div>
	</div>
</div>


</form>

				
</div>
</body>
</html>