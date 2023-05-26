<?php
// singleton igual que la connection
class UserRepository
{
    private static $instance;
    private $connection;

    private function __construct($connection)
    {
        $this->connection = $connection;
    }

    public static function getInstance($connection)
    {
        if (self::$instance === null) {
            self::$instance = new self($connection);
        }
        return self::$instance;
    }

    public function createUser($username, $email, $password)
    {
        //hashea la pass
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nombre, email, password) VALUES ('" . $username . "', '" . $email . "', '" . $hashedPassword . "')";

        // Ejecuta la consulta
        $result = $this->connection->query($sql);

        // Verifica si la inserción fue exitosa
        if ($result) {
            // Obtener el ID del nuevo usuario insertado
            $userId = mysqli_insert_id($this->connection->getConnection());
            return $userId;
        } else {
            // Ocurrió un error al insertar el usuario
            return false;
        }
    }

    public function validateUserCredentials($username, $password)
    {
        // Obtiene el usuario con ese username
        $sql = "SELECT * FROM usuarios WHERE nombre = '" . $username . "'";
        $result = $this->connection->query($sql);
        $user = mysqli_fetch_assoc($result);

        // Verificar si se encontró un usuario con el nombre especificado
        if ($user) {
            // Comparar la contraseña proporcionada con la contraseña almacenada en la base de datos
            if (password_verify($password, $user['PASSWORD'])) {
                // Las credenciales son válidas
                return true;
            }
        }

        // Las credenciales no son válidas
        return false;
    }

    public function getUserById($id)
    {
        $sql = "SELECT * FROM usuarios WHERE id = " . intval($id);
        $result = mysqli_query($this->connection, $sql);
        return mysqli_fetch_assoc($result);
    }

    public function deleteUser($id)
    {
        $sql = "DELETE FROM usuarios WHERE id = " . intval($id);
        mysqli_query($this->connection, $sql);
    }
}
