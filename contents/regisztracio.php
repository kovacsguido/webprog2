<?php
$errorMsg = null;
$_SESSION['messages'] = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('includes/user.class.php');

    $username  = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING, ['options' => ['default' => '']]);
    $password  = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING, ['options' => ['default' => '']]);
    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING, ['options' => ['default' => '']]);
    $lastname  = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING, ['options' => ['default' => '']]);

    if (!empty($username) && !empty($password) && !empty($firstname) && !empty($lastname)) {
        $response = User::signUp($username, $password, $firstname, $lastname);
        if ($response['type'] == 'success') {
            $_SESSION['messages'][] = $response;
            header('Location: index.php');
            exit();
        }
        else {
            $errorMsg = $response;
        }
    }
    else {
        $errorMsg = [
            'type' => 'warning',
            'text' => 'Minden mező kitöltése kötelező!'
        ];
    }
}
else {
    ?>
    <h1>Regisztráció</h1>
    <?php if (!empty($errorMsg)) { ?>
        <div class="alert alert-<?php echo $errorMsg['type']; ?>" role="alert"><?php echo $errorMsg['text']; ?></div>
    <?php } ?>
    <form id="sign-up-form" onsubmit="return validateSignUpForm()" action="" method="post">
        <div class="form-group">
            <label for="username">Felhasználónév:</label>
            <input class="form-control" type="text" name="username" id="username" required>
        </div>
        <div class="form-group">
            <label for="lastname">Vezetéknév:</label>
            <input class="form-control" type="text" name="lastname" id="lastname" required>
        </div>
        <div class="form-group">
            <label for="firstname">Keresztnév:</label>
            <input class="form-control" type="text" name="firstname" id="firstname" required>
        </div>
        <hr>
        <div class="form-group">
            <label for="password">Jelszó:</label>
            <input class="form-control" type="password" name="password" id="password" required>
        </div>
        <div class="form-group">
            <label for="password2">Jelszó megerősítése:</label>
            <input class="form-control" type="password" name="password2" id="password2" required>
        </div>
        <hr>
        <div class="form-group">
            <input type="submit" class="btn btn-primary float-right" value="Mehet">
            <div class="clearfix"></div>
        </div>
    </form>
    <?php
}
