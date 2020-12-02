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
     */
    public static function signUp($username, $password, $firstname, $lastname)
    {
        try {
            $hash = hash('sha256', $password);
            $sql = "INSERT INTO users (username, firstname, lastname, `password`, permission) "
                ."VALUES ('" . $username . "', '" . $firstname . "', '" . $lastname . "', '" . $hash . "', 2)";
            $connection = Database::getConnection();
            $stmt = $connection->prepare($sql);
            $stmt->execute();

            $_SESSION['user'] = [
                'username'        => $username,
                'name'            => $lastname . ' ' . $firstname,
                'permission'      => 2,
                'permission_name' => 'Regisztrált felhasználó'
            ];

            header('Location: index.php');
            exit();
        }
        catch (Exception $e) {
            echo '<div class="alert alert-danger" role="alert">A regisztráció ismeretlen ok miatt nem sikerült!</div>';
        }
    }

    /**
     * Felhasználó bejelentkezés.
     *
     * @param string $username
     * @param string $password
     */
    public static function signIn($username, $password)
    {
        try {
            $hash = hash('sha256', $password);
            $sql = "SELECT u.username, u.firstname, u.lastname, u.password, u.permission, up.name AS permission_name FROM users AS u ".
                "INNER JOIN user_permissions AS up ON (u.permission = up.id) WHERE username='" . $username . "' AND `password`='" . $hash. "'";
            $connection = Database::getConnection();
            $stmt       = $connection->query($sql);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!empty($user)) {
                $_SESSION['user'] = [
                    'username'        => $user['username'],
                    'name'            => $user['lastname'] . ' ' . $user['firstname'],
                    'permission'      => $user['permission'],
                    'permission_name' => $user['permission_name']
                ];

                header('Location: index.php');
                exit();
            }
            else {
                echo '<div class="alert alert-warning" role="alert">Helytelen felhasználónév vagy jelszó!</div>';
            }
        }
        catch (Exception $e) {
            echo '<div class="alert alert-danger" role="alert">A bejelentkezés ismeretlen ok miatt nem sikerült!</div>';
        }
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
