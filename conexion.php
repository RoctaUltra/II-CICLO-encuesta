<?php
$servidor = "localhost"; // Servidor local
$usuario = "root";       // Usuario por defecto de XAMPP
$clave = "";             // Contraseña vacía por defecto
$basedatos = "provedores"; // Cambia por el nombre de tu base de datos

$conexion = new mysqli($servidor, $usuario, $clave, $basedatos);

if ($conexion->connect_error) {
    die("❌ Error de conexión: " . $conexion->connect_error);
} else {
    // echo "✅ Nuevo registro creado exitosamente";
}
?>