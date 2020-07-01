<?php
function sanitizeForm($inputText) {
    $inputText = strip_tags($inputText);
    $inputText = str_replace(" ", "", $inputText);
    return $inputText;
}

function sanitizeFormPassword($inputText) {
    $inputText = strip_tags($inputText);
    return $inputText;
}

if(isset($_POST['registerButton'])) {
    $username = sanitizeForm($_POST['registerUsername']);
    $email = sanitizeForm($_POST['registerEmail']);
    $registerPassword = sanitizeFormPassword($_POST['registerPassword']);
    $confirmPassword = sanitizeFormPassword($_POST['confirmPassword']);

    $wasSuccessful = $account->registerAccount($username, $email, $registerPassword, $confirmPassword);

    if($wasSuccessful) {
        $_SESSION['userLoggedIn'] = $email;
        header("Location: index.php");
    }
}
?>
