<?php
if ($_SESSION['user']['permission'] < 3) exit();

$sql = "SELECT u.id, u.username, u.firstname, u.lastname, up.name AS permission FROM users AS u "
    ."LEFT JOIN user_permissions AS up ON (u.permission = up.id) ORDER BY u.id";
$connection = Database::getConnection();
$stmt = $connection->query($sql);
?>
<h1>Regisztrált felhasználók listája</h1>
<p class="lead">Figyelem, ez a site egy egyetemi beadandó feladat keretében készült, nem valódi cégről szól!</p>
<br>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Felhasználónév</th>
            <th>Teljes név</th>
            <th>Jogosultsági szint</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
    <tr>
        <td><?php echo $user['username']; ?></td>
        <td><?php echo $user['firstname'] . ' ' . $user['lastname']; ?></td>
        <td><?php echo $user['permission']; ?></td>
    </tr>
    <?php } ?>
    </tbody>
</table>
