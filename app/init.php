<?php
// Archivo para inicializar connection y repositorios, incluir en todos los archivos q se necesite acceso a db
include_once __DIR__."/db/Connection.php";
include_once __DIR__."/db/UserRepository.php";
include_once __DIR__."/db/PostRepository.php";

$connection = Connection::getInstance();
$userRepository = UserRepository::getInstance($connection);
$postRepository = PostRepository::getInstance($connection);


// Crea usuario por defecto, si ya existe no lo crea, porq da error UNIQUE en la db
if($userRepository->createUser("admin", "admin@admin.com", "admin123")){
    echo "CREATE DEFAULT USER OK";
}
