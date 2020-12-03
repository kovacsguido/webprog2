<?php
if ($_SESSION['user']['permission'] < 2) exit();

include_once('includes/config.php');
$message = [];
$_SESSION['messages'] = [];
$currentPageId = (empty($_GET['pid']) || (int)$_GET['pid'] < 1) ? 1 : (int)$_GET['pid'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title  = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING, ['options' => ['default' => '']]);
    $body  = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_STRING, ['options' => ['default' => '']]);

    if (!empty($title) && !empty($body)) {
        $restServerUrl = 'http://' . SITE_HOST . '/rest/server.php';
        $data = [
            'title'   => $title,
            'body'    => nl2br($body),
            'user_id' => $_SESSION['user']['id']
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $restServerUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_STDERR, fopen('/tmp/curl.txt', 'w+'));
        $result = curl_exec($ch);
        curl_close($ch);

        if ($result == 'success') {
            $message = [
                'type' => 'success',
                'text' => 'A hír tárolása sikerült!<br>Új hír beküldéséhez kattintson a felső menüsor megfelelő gombjára!'
            ];
        }
        else {
            $message = [
                'type' => 'danger',
                'text' => 'A hír tárolása nem sikerült!<br>(Hiba: ' . $result . ')'
            ];
        }
    }
    else {
        $message = [
            'type' => 'warning',
            'text' => 'Minden mező kitöltése kötelező!'
        ];
    }
    echo '<div class="alert alert-' . $message['type'] . '" role="alert">' . $message['text'] . '</div>';
}
else { ?>
    <h1>Hír beküldése</h1>
    <?php if (!empty($message)) { ?>
        <div class="alert alert-<?php echo $message['type']; ?>" role="alert"><?php echo $message['text']; ?></div>
    <?php } ?>
    <form id="news-post-form" action="?pid=<?php echo $currentPageId; ?>" method="post">
        <div class="form-group">
            <label for="title">A hír címe:</label>
            <input class="form-control" type="text" name="title" id="title" required>
        </div>
        <div class="form-group">
            <label for="body">A hír szövege:</label>
            <textarea class="form-control" name="body" id="body" required rows="10"></textarea>
        </div>
        <hr>
        <div class="form-group">
            <input type="submit" class="btn btn-primary float-right" value="Beküldés">
            <div class="clearfix"></div>
        </div>
    </form>
<?php }
