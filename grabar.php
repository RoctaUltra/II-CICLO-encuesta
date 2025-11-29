<?php
include("conexion.php");

$nombreprovedor   = $_POST['nombreprovedor'];
$nombrecontacto   = $_POST['nombrecontacto'];
$apellidocontacto = $_POST['apellidocontacto'];
$email            = $_POST['email'];
$telefono         = $_POST['telefono'];
$direccion        = $_POST['direccion'];
$ciudad           = $_POST['ciudad'];
$provincia        = $_POST['provincia'];
$codigopostal     = $_POST['codigopostal'];

$sql = "INSERT INTO provedores 
(id, nombreprov, nombrecontacto, apellidocontacto, email, telefono, direccion, ciudad, provincia, codigopostal)
VALUES (NULL, '$nombreprovedor', '$nombrecontacto', '$apellidocontacto', '$email', '$telefono', '$direccion', '$ciudad', '$provincia', '$codigopostal')";

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Resultado del registro</title>
  <style>
    body {
      font-family: "Segoe UI", Arial, sans-serif;
      background: linear-gradient(135deg, #0078d7, #00bcd4);
      color: #333;
      margin: 0;
      padding: 0;
      display: flex;
      height: 100vh;
      justify-content: center;
      align-items: center;
    }

    .container {
      background: #fff;
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.2);
      text-align: center;
      max-width: 400px;
    }

    .success {
      background-color: #e6ffed;
      color: #2e7d32;
      border: 2px solid #2e7d32;
      padding: 10px;
      border-radius: 8px;
      font-weight: bold;
    }

    .error {
      background-color: #ffebee;
      color: #c62828;
      border: 2px solid #c62828;
      padding: 10px;
      border-radius: 8px;
      font-weight: bold;
    }

    a {
      display: inline-block;
      margin-top: 20px;
      text-decoration: none;
      background: #0078d7;
      color: #fff;
      padding: 10px 20px;
      border-radius: 6px;
      transition: background 0.3s;
    }

    a:hover {
      background: #005fa3;
    }
  </style>
</head>
<body>
  <div class="container">
    <?php
    if ($conexion->query($sql) === TRUE) {
        echo "<div class='success'>✅ Registro guardado correctamente</div>";
    } else {
        echo "<div class='error'>❌ Error al guardar: " . $conexion->error . "</div>";
    }

    $conexion->close();
    ?>
    <a href="listado.php">Volver al listado</a>
  </div>
</body>
</html>
