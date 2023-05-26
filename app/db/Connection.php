<?php
// clase de conn a db, es un singleton, constructor privado, para obtener instancia usar: Connection::getInstance()
class Connection
{
    private static $instance;
    private $server = "localhost";
    private $bd = "blog";
    private $user = 'root';
    private $pass = '';
    private $connection;

    private function __construct()
    {
        $this->connection = mysqli_connect($this->server, $this->user, $this->pass, $this->bd)
            or die("No se ha podido conectar al servidor de Base de datos");
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function query($sql)
    {
        return mysqli_query($this->connection, $sql);
    }

    public function getConnection() : mysqli
    {
        return $this->connection;
    }
}
