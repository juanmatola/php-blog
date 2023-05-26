<?php
// Singleton
class PostRepository
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

    public function createPost($post)
    {
        $sql = "INSERT INTO posts (titulo, descripcion, usuario_id, contenido) 
                VALUES ('" . $post['title'] . "', '" . $post['description'] . "', '" . $post['user_id'] . "', '" . $post['content'] . "')";

        // Ejecutar la consulta y retornar el resultado
        return $this->connection->query($sql);
    }

    public function getPostById($postId)
    {
        $sql = "SELECT * FROM posts WHERE id = " . $postId;

        // Ejecutar la consulta y retornar el resultado
        $result = $this->connection->query($sql);
        return mysqli_fetch_assoc($result);
    }

}
