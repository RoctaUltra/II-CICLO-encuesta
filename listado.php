<?php
include("conexion.php");

// Consulta para obtener todos los registros
$sql = "SELECT * FROM provedores ORDER BY id DESC";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Listado de Proveedores</title>
<style>
body {
    font-family: "Segoe UI", Arial, sans-serif;
    background: linear-gradient(135deg, #0078d7, #00bcd4);
    color: #fff;
    margin: 0;
    padding: 20px;
}
h1 {
    text-align: center;
}
table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    color: black;
    border-radius: 10px;
    overflow: hidden;
}
th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}
th {
    background-color: #ac85deff;
}
tr:nth-child(even) {
    background-color: #f2f2f2;
}
a {
    text-decoration: none;
    padding: 6px 12px;
    border-radius: 8px;
    color: white;
}
.editar {
    background-color: #0078d7;
}
.eliminar {
    background-color: #d32f2f;
}
a:hover {
    opacity: 0.8;
}
</style>
</head>
<body>
<h1>📋 Listado de Proveedores</h1>
<table>
<tr>
    <th>ID</th>
    <th>Nombre Proveedor</th>
    <th>Nombre Contacto</th>
    <th>Apellido Contacto</th>
    <th>Email</th>
    <th>Teléfono</th>
    <th>Dirección</th>
    <th>Ciudad</th>
    <th>Provincia</th>
    <th>Código Postal</th>
    <th>Acciones</th>
</tr>

<?php 
$c= 0;
while($row = $resultado->fetch_assoc()): 
$c++;
?>
<tr>
    <td><?= $c;
?></td>
    <td><?= $row['nombreprov'] ?></td>
    <td><?= $row['nombrecontacto'] ?></td>
    <td><?= $row['apellidocontacto'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['telefono'] ?></td>
    <td><?= $row['direccion'] ?></td>
    <td><?= $row['ciudad'] ?></td>
    <td><?= $row['provincia'] ?></td>
    <td><?= $row['codigopostal'] ?></td>
    <td>
        <a class="editar" href="editar.php?id=<?= $row['id'] ?>">✏️ Editar</a>
        <a class="eliminar" href="eliminar.php?id=<?= $row['id'] ?>">🗑️ Eliminar</a>
    </td>
</tr>
<?php endwhile; ?>

</table>
</body>
</html>

<?php $conexion->close(); ?>
