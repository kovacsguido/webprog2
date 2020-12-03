<?php
include_once('../includes/config.php');

$restServerUrl = 'http://' . SITE_HOST . '/rest/server.php';
$data = [
    'title'   => 'Teszt hír - ' . date('Y.m.d. H:i:s'),
    'body'    => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec massa risus, consectetur ac magna nec, faucibus sagittis turpis. Sed accumsan dictum est, eu aliquam dui suscipit ac. Donec sagittis velit in ex lacinia gravida. Proin id quam eget justo tincidunt tincidunt sit amet quis ligula. Ut id egestas dui, eu aliquet tellus. Suspendisse aliquam justo neque, id semper turpis aliquam eget. Nam purus nunc, sagittis in mi at, aliquet sodales lectus. Nullam orci lorem, ullamcorper condimentum aliquet non, consectetur sed dui. Maecenas ac massa at quam lacinia convallis. Nullam elementum enim nec lobortis facilisis. Nullam auctor lobortis diam non lacinia. Vivamus et efficitur ligula. Donec velit nulla, ornare et massa nec, feugiat vehicula urna.',
    'user_id' => 1
];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $restServerUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
curl_close($ch);

if ($result == 'success') {
    $message = 'A teszt hír tárolása sikerült!';
}
else {
    $message = 'A teszt hír tárolása nem sikerült!<br>(Hiba: ' . $result . ')';
}

echo $message;
