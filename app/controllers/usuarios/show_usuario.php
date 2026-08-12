<?php

$id_usuario_get = $_GET['id'];

$sql_usuarios = "SELECT us.id_usuarios as id_usuarios, us.nombres as nombres, us.email as email, rol.rol as rol
                 FROM tb_usuarios as us INNER JOIN tb_roles as rol ON us.id_rol = rol.id_rol where  id_usuarios = :id_usuario";
$query_usuarios = $pdo->prepare($sql_usuarios);
$query_usuarios->bindParam(':id_usuario', $id_usuario_get);
$query_usuarios->execute();

$usuario_dato = $query_usuarios->fetch(PDO::FETCH_ASSOC);

$nombres = $usuario_dato['nombres'] ?? '';
$email = $usuario_dato['email'] ?? '';
$rol = $usuario_dato['rol'] ?? '';