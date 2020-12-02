<?php
session_start();

include_once('includes/db.class.php');
include_once('includes/content.class.php');
include_once('includes/menu.inc.php');

if (empty($_SESSION['user'])) {
    $_SESSION['user'] = [
        'username'        => 'Látogató',
        'name'            => 'Látogató',
        'permission'      => 1,
        'permission_name' => "Látogató"
    ];
}
$currentPageId = (empty($_GET['pid']) || (int)$_GET['pid'] < 1) ? 1 : (int)$_GET['pid'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="hu">
<head>
    <title>It-Dev Kft.</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="assets/css/bootstrap-reboot.min.css"/>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/css/style.css"/>
    <script type="text/javascript" src="assets/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">It-Dev Kft. - Megoldások minden esetre</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <?php echo Menu::getMenu($currentPageId, $_SESSION['user']['permission']); ?>
    </div>
</nav>

<main role="main" class="container">
    <div class="jumbotron">
        <h1>Navbar example</h1>
        <p class="lead">This example is a quick exercise to illustrate how fixed to top navbar works. As you scroll, it will remain fixed to the top of your browser’s viewport.</p>
        <a class="btn btn-lg btn-primary" href="/docs/4.5/components/navbar/" role="button">View navbar docs &raquo;</a>
    </div>
    <div id="upbar">
        <div id="userinfo">
             <span><?php echo "Üdvözlünk: " . $_SESSION['user']['username'] . "<br>Jogosultság: " . $_SESSION['user']['permission_name']; ?></span>
        </div>
        <div class="main-navigation" id="menu">
            <ul class="top-level-menu">
            </ul>
        </div>
    </div>
    <?php echo Content::getPageContent($currentPageId); ?>
</main>
</body>
</html>
