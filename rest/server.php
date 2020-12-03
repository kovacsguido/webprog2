<?php
include_once('../includes/db.class.php');
$connection = Database::getConnection();

$response = '';

try {
    switch($_SERVER['REQUEST_METHOD'])
    {
        case 'POST':
            $sql = "INSERT INTO news (title, body, creator, created) VALUES (:title, :body, :creator, :created)";
            $values = [
                ':title'   => $_POST['title'],
                ':body'    => $_POST['body'],
                ':creator' => (int)$_POST['user_id'],
                ':created' => date('Y-m-d H:i:s')
            ];
            $stmt = $connection->prepare($sql);
            $count = $stmt->execute($values);
            $response = 'success';
            break;

        case 'GET':
        case 'PUT':
        case 'DELETE':
        default:
            break;
    }
}
catch (Exception $e) {
    $response = $e->getMessage();
}

echo $response;
