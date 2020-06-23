<?php
    include ("includes/classes/Account.php");
    include ("includes/classes/Constants.php");
    $account = new Account();

    include ("includes/handlers/registerHandler.php");
    
    function getInputValue($name) {
        if(isset($_POST[$name])) {
            echo $_POST[$name];
        }
    }
?>

<html>
<head>
	<title>Welcome to Spotify!</title>
</head>
<body>

	<div id="inputContainer">
		<form id="loginForm" action="register.php" method="POST">
			<h2>Login to your account</h2>
			<p>
				<label for="loginUsername">Username</label>
				<input id="loginUsername" name="loginUsername" type="text" placeholder="e.g. bartSimpson" required>
			</p>
			<p>
				<label for="loginPassword">Password</label>
				<input id="loginPassword" name="loginPassword" type="password" required>
			</p>

			<button type="submit" name="loginButton">LOG IN</button>
			
        </form>
        
        <form id="registerForm" action="register.php" method="POST">
			<h2>Create your free account</h2>
			<p>
                <?php echo $account->getErrorMessage(Constants::$usernameError); ?>
				<label for="registerUsername">Username</label>
				<input id="registerUsername" name="registerUsername" type="text" placeholder="e.g. bartSimpson" value="<?php getInputValue('registerUsername'); ?>" required>
            </p>
            <p>
                <?php echo $account->getErrorMessage(Constants::$emailError); ?>
				<label for="registerEmail">Email</label>
				<input id="registerEmail" name="registerEmail" type="email" placeholder="e.g. bartSimpson@gmail.com" value="<?php getInputValue('registerEmail'); ?>" required>
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
			
		</form>
	</div>

</body>
</html>