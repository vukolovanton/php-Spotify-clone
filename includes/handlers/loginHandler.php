<?php
if(isset($_POST['loginButton'])) {
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    $result = $account->loginAccount($email, $password);

    if ($result) {
        $_SESSION['userLoggedIn'] = $email;
        header("Location: index.php");
    } else {
        echo "123asdasdasd";
    }
}
?>