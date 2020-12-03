<?php
$_SESSION['messages'] = [];

include('includes/user.class.php');
User::signOut();

header('Location: index.php');
exit();
