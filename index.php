<?php
session_start();

include_once('includes/db.class.php');
include_once('includes/content.class.php');
include_once('includes/menu.class.php');

if (empty($_SESSION['user'])) {
    $_SESSION['user'] = [
        'id'              => 0,
        'username'        => 'Látogató',
        'name'            => 'Látogató',
        'permission'      => 1,
        'permission_name' => "Látogató"
    ];
}
$currentPageId = (empty($_GET['pid']) || (int)$_GET['pid'] < 1) ? 1 : (int)$_GET['pid'];

$messagesHtml = '';
if (!empty($_SESSION['messages'])) {
    $messages = [];
    foreach ($_SESSION['messages'] as $message) {
        $messages[] = '<div class="alert alert-'. $message['type'] . '" role="alert">' . $message['text'] . '</div>';
    }
    $messagesHtml = implode("\n", $messages);
    $_SESSION['messages'] = [];
}

$content = Content::getPageContent($currentPageId);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="hu">
<head>
    <title>It-Dev Kft.</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="assets/css/bootstrap-reboot.min.css"/>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/css/style.css?t=<?php echo time(); ?>"/>
    <script type="text/javascript" src="assets/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/main.js?t=<?php echo time(); ?>"></script>
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
        <div class="row">
            <div class="col-6">Üdvözlünk, <strong><?php echo $_SESSION['user']['username']; ?></strong>!</div>
            <div class="col-6 text-right" id="current-datetime">asdasd</div>
        </div>
    </div>
    <?php echo $messagesHtml; ?>
    <?php echo $content; ?>
    <?php
    if ($currentPageId == 1) {
        echo '<hr>';
        if ($_SESSION['user']['permission'] > 1) {
            include_once('contents/hirek.php');
        }
        else {
            echo '<div class="alert alert-warning" role="alert">Sajnáljuk, a hírekhez csak a regisztrált felhasználók férhetnek hozzá!</div>';
        }
    } ?>
</main>
</body>
</html>
