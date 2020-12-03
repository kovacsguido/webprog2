<?php

/**
 * Class User.
 */
class User
{
    /**
     * User constructor.
     * A biztonság kedvéért készült private láthatósággal, hogy biztosan ne lehessen példányosítani az osztályt.
     */
    private function __construct() {}

    /**
     * Felhasználó regisztráció.
     *
     * @param string $username
     * @param string $password
     * @param string $firstname
     * @param string $lastname
     *
     * @return array A megjelenítendő hibaüzenet adatait tartalmazó tömb
     */
    public static function signUp($username, $password, $firstname, $lastname)
    {
        try {
            $hash = hash('sha256', $password);
            $sql = "INSERT INTO users (username, firstname, lastname, `password`, permission) "
                ."VALUES ('" . $username . "', '" . $firstname . "', '" . $lastname . "', '" . $hash . "', 2)";
            $connection = Database::getConnection();
            $stmt = $connection->prepare($sql);

            if ($stmt->execute()) {
                $response = [
                    'type' => 'success',
                    'text' => 'A regisztráció sikerült, mostmár beléphet.'
                ];
            }
            else {
                $response = [
                    'type' => 'danger',
                    'text' => 'A regisztráció ismeretlen ok miatt nem sikerült!'
                ];
            }
        }
        catch (Exception $e) {
            $response = [
                'type' => 'danger',
                'text' => 'A regisztráció ismeretlen ok miatt nem sikerült, vegye fel a kapcsolatot az üzemeltetőkkel!'
            ];
        }

        return $response;
    }

    /**
     * Felhasználó bejelentkezés.
     *
     * @param string $username
     * @param string $password
     *
     * @return array A megjelenítendő hibaüzenet adatait tartalmazó tömb
     */
    public static function signIn($username, $password)
    {
        try {
            $hash = hash('sha256', $password);
            $sql = "SELECT u.id, u.username, u.firstname, u.lastname, u.password, u.permission, up.name AS permission_name FROM users AS u ".
                "INNER JOIN user_permissions AS up ON (u.permission = up.id) WHERE username='" . $username . "' AND `password`='" . $hash. "'";
            $connection = Database::getConnection();
            $stmt       = $connection->query($sql);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!empty($user)) {
                $_SESSION['user'] = [
                    'id'              => $user['id'],
                    'username'        => $user['username'],
                    'name'            => $user['lastname'] . ' ' . $user['firstname'],
                    'permission'      => $user['permission'],
                    'permission_name' => $user['permission_name']
                ];

                $response = [
                    'type' => 'success',
                    'text' => ''
                ];
            }
            else {
                $response = [
                    'type' => 'warning',
                    'text' => 'Helytelen felhasználónév vagy jelszó!'
                ];
            }
        }
        catch (Exception $e) {
            $response = [
                'type' => 'danger',
                'text' => 'A bejelentkezés ismeretlen ok miatt nem sikerült!'
            ];
        }

        return $response;
    }

    /**
     * Felhasználó kijelentkezés.
     */
    public static function signOut()
    {
        $_SESSION['user'] = [];

        header('Location: index.php');
        exit();
    }
 }
