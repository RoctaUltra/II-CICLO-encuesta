<?php
include("conexion.php");

// Verificar si llegaron los datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Capturar datos de forma segura
    $id              = intval($_POST['id']);
    $nombreprov  = $conexion->real_escape_string($_POST['nombreprovedor']);
    $nombrecontacto  = $conexion->real_escape_string($_POST['nombrecontacto']);
    $apellidocontacto= $conexion->real_escape_string($_POST['apellidocontacto']);
    $email           = $conexion->real_escape_string($_POST['email']);
    $telefono        = $conexion->real_escape_string($_POST['telefono']);
    $direccion       = $conexion->real_escape_string($_POST['direccion']);
    $ciudad          = $conexion->real_escape_string($_POST['ciudad']);
    $provincia       = $conexion->real_escape_string($_POST['provincia']);
    $codigopostal    = $conexion->real_escape_string($_POST['codigopostal']);

    // Consulta SQL para actualizar
    $sql = "UPDATE provedores SET 
                nombreprov = '$nombreprov',
                nombrecontacto = '$nombrecontacto',
                apellidocontacto = '$apellidocontacto',
                email = '$email',
                telefono = '$telefono',
                direccion = '$direccion',
                ciudad = '$ciudad',
                provincia = '$provincia',
                codigopostal = '$codigopostal'
            WHERE id = $id";

    // Ejecutar y mostrar mensaje
    if ($conexion->query($sql) === TRUE) {
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Proveedor Actualizado</title>
            <style>
                body {
                    background: linear-gradient(135deg, #00c6ff, #0072ff);
                    font-family: "Segoe UI", Arial, sans-serif;
                    color: white;
                    text-align: center;
                    padding-top: 100px;
                    margin: 0;
                }
                .msg {
                    background: rgba(0,0,0,0.3);
                    display: inline-block;
                    padding: 40px 60px;
                    border-radius: 15px;
                    box-shadow: 0 0 10px rgba(0,0,0,0.3);
                }
                h2 {
                    margin-bottom: 20px;
                }
                a {
                    display: inline-block;
                    margin-top: 20px;
                    color: white;
                    text-decoration: none;
                    background: #0078d7;
                    padding: 10px 20px;
                    border-radius: 8px;
                    transition: 0.3s;
                }
                a:hover {
                    background: #005fa3;
                }
            </style>
        </head>
        <body>
            <div class="msg">
                <h2>✅ Proveedor actualizado correctamente</h2>
                <a href="listado.php">Volver al listado</a>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "❌ Error al actualizar el proveedor: " . $conexion->error;
    }

} else {
    echo "⚠️ No se recibieron datos del formulario.";
}

// Cerrar conexión
$conexion->close();
?>
