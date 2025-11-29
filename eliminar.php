<?php
include("conexion.php");

// Verificar si se recibió el ID
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Asegurar que sea un número entero

    // Consulta SQL para eliminar
    $sql = "DELETE FROM provedores WHERE id = $id";

    if ($conexion->query($sql) === TRUE) {
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Registro Eliminado</title>
            <style>
                body {
                    background: linear-gradient(135deg, #ff416dff, #912d1cff);
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
                <h2>🗑️ Registro eliminado correctamente</h2>
                <a href="listado.php">Volver al listado</a>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "❌ Error al eliminar el registro: " . $conexion->error;
    }

} else {
    echo "⚠️ No se recibió el ID del registro.";
}

$conexion->close();
?>
