<?php
    include ("includes/config.php");
    include ("includes/classes/Account.php");
    include ("includes/classes/Constants.php");
    $account = new Account($conn);

	include ("includes/handlers/registerHandler.php");
	include ("includes/handlers/loginHandler.php");

    function getInputValue($name) {
        if(isset($_POST[$name])) {
            echo $_POST[$name];
        }
    }
?>

<html>
<head>
	<title>Welcome to Spotify!</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
</head>
<body>
	<?php
		if(isset($_POST['registerButton'])) {
			echo '
			<script>
				$(document).ready(function() {
					$("#loginForm").hide();
					$("#registerForm").show();
				});
			</script>
		';
		} else {
			'
			<script>
				$(document).ready(function() {
					$("#loginForm").show();
					$("#registerForm").hide();
				});
			</script>
		';
		}
	?>

	<div id="background">
		<div id="loginContainer">
			<div id="inputContainer">
				<form id="loginForm" action="register.php" method="POST">
					<h2>Login to your account</h2>
					<p>
						<?php echo $account->getErrorMessage(Constants::$loginFailed); ?>
						<label for="loginEmail">Email</label>
						<input id="loginEmail" name="loginEmail" type="email" placeholder="email@gmail.com" required>
					</p>
					<p>
						<label for="loginPassword">Password</label>
						<input id="loginPassword" name="loginPassword" type="password" required>
					</p>

					<button type="submit" name="loginButton">LOG IN</button>
					<div class="hasAccountText">
						<span id="hideLogin">Don't have an account? Signup here.</span>
					</div>
					
				</form>
				
				<form id="registerForm" action="register.php" method="POST">
					<h2>Create your free account</h2>
					<p>
						<?php echo $account->getErrorMessage(Constants::$usernameError); ?>
						<?php echo $account->getErrorMessage(Constants::$usernameTaken); ?>
						<label for="registerUsername">Username</label>
						<input id="registerUsername" name="registerUsername" type="text" placeholder="John Doe" value="<?php getInputValue('registerUsername'); ?>" required>
					</p>
					<p>
						<?php echo $account->getErrorMessage(Constants::$emailError); ?>
						<?php echo $account->getErrorMessage(Constants::$emailTaken); ?>
						<label for="registerEmail">Email</label>
						<input id="registerEmail" name="registerEmail" type="email" placeholder="email@gmail.com" value="<?php getInputValue('registerEmail'); ?>" required>
					</p>
					<p>
						<?php echo $account->getErrorMessage(Constants::$passwordContainsError); ?>
						<?php echo $account->getErrorMessage(Constants::$passwordNotMatch); ?>
						<label for="registerPassword">Password</label>
						<input id="registerPassword" name="registerPassword" type="password" required>
					</p>
					<p>
						<label for="confirmPassword">Confirm Password</label>
						<input id="confirmPassword" name="confirmPassword" type="password" required>
					</p>

					<button type="submit" name="registerButton">REGISTER</button>
					<div class="hasAccountText">
						<span id="hideRegister">Already have an acccount? Login here.</span>
					</div>
					
				</form>
			</div>
			<div id="loginText">
				<h1>Welcome to Spotify.</h1>
			</div>
		</div>
	</div>

</body>
</html>