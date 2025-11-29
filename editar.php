<?php
include("conexion.php");

// Verificar que se recibió el ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consultar datos del proveedor
    $sql = "SELECT * FROM provedores WHERE id = $id";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
    } else {
        echo "<h2>⚠️ Proveedor no encontrado.</h2>";
        exit;
    }
} else {
    echo "<h2>⚠️ No se recibió el ID del proveedor.</h2>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Editar Proveedor</title>
<style>
  body {
    font-family: "Segoe UI", Arial, sans-serif;
    background: linear-gradient(135deg, #0078d7, #00bcd4);
    margin: 0;
    padding: 0;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }
  .form-container {
    background: rgba(255,255,255,0.1);
    padding: 30px 40px;
    border-radius: 15px;
    box-shadow: 0 0 15px rgba(0,0,0,0.3);
    width: 400px;
  }
  h2 { text-align: center; margin-bottom: 25px; }
  label { display: block; margin-top: 10px; font-weight: bold; }
  input, select {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    border: none;
    border-radius: 8px;
    outline: none;
  }
  button {
    margin-top: 20px;
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 8px;
    background: #004a99;
    color: white;
    font-size: 16px;
    cursor: pointer;
  }
  button:hover { background: #003366; }
  a {
    display: block;
    text-align: center;
    margin-top: 15px;
    color: white;
    text-decoration: none;
  }
  a:hover { text-decoration: underline; }
</style>
</head>
<body>

<div class="form-container">
  <h2>Editar Proveedor</h2>
  <form action="actualizar.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

    <label>Nombre del proveedor:</label>
    <input type="text" name="nombreprovedor" value="<?php echo $row['nombreprov']; ?>" required>

    <label>Nombre de contacto:</label>
    <input type="text" name="nombrecontacto" value="<?php echo $row['nombrecontacto']; ?>" required>

    <label>Apellido de contacto:</label>
    <input type="text" name="apellidocontacto" value="<?php echo $row['apellidocontacto']; ?>" required>

    <label>Email:</label>
    <input type="email" name="email" value="<?php echo $row['email']; ?>" required>

    <label>Teléfono:</label>
    <input type="text" name="telefono" value="<?php echo $row['telefono']; ?>" required>

    <label>Dirección:</label>
    <input type="text" name="direccion" value="<?php echo $row['direccion']; ?>" required>

    <!-- 🔽 CIUDAD Y PROVINCIA -->
    <label for="ciudad">Ciudad:</label>
    <select name="ciudad" id="ciudad" required>
      <option value="">-- Selecciona una ciudad --</option>
    </select>

    <label for="provincia">Provincia:</label>
    <select name="provincia" id="provincia" required>
      <option value="">-- Selecciona una provincia --</option>
    </select>

    <label>Código Postal:</label>
    <input type="number" name="codigopostal" value="<?php echo $row['codigopostal']; ?>" required>

    <button type="submit">💾 Guardar Cambios</button>
    <a href="listado.php">⬅️ Volver al listado</a>
  </form>
</div>

<script>
  // Lista de ciudades y provincias
  const provincias = {
    "Lima": ["Lima", "Callao", "Cañete", "Huaral", "Barranca", "Huarochirí", "Oyón", "Yauyos"],
    "Arequipa": ["Arequipa", "Caylloma", "Islay", "Camana", "Castilla", "Condesuyos"],
    "Trujillo": ["Trujillo", "Ascope", "Otuzco", "Santiago de Chuco", "Chepén", "Pacasmayo"],
    "Chiclayo": ["Chiclayo", "Lambayeque", "Ferreñafe"],
    "Piura": ["Piura", "Sullana", "Paita", "Talara", "Morropon", "Huancabamba", "Sechura"],
    "Cusco": ["Cusco", "Urubamba", "Quispicanchi", "Canchis", "Anta", "La Convención"],
    "Iquitos": ["Maynas", "Alto Amazonas", "Requena", "Loreto", "Datem del Marañón", "Putumayo"],
    "Huancayo": ["Huancayo", "Tarma", "Jauja", "Concepción", "Satipo", "Chanchamayo"],
    "Tacna": ["Tacna", "Candarave", "Jorge Basadre", "Tarata"],
    "Puno": ["Puno", "San Román", "Azángaro", "Melgar", "Sandia", "Huancané"],
    "Chimbote": ["Santa", "Casma", "Huarmey", "Pallasca"],
    "Cajamarca": ["Cajamarca", "Jaén", "Cutervo", "Celendín", "Chota", "San Marcos"],
    "Huaraz": ["Huaraz", "Carhuaz", "Recuay", "Bolognesi", "Huari", "Yungay"],
    "Ayacucho": ["Huamanga", "Huanta", "Cangallo", "Lucanas", "La Mar"],
    "Tumbes": ["Tumbes", "Zarumilla", "Contralmirante Villar"],
    "Ica": ["Ica", "Chincha", "Pisco", "Nazca", "Palpa"],
    "Moquegua": ["Mariscal Nieto", "Ilo", "General Sánchez Cerro"],
    "Pucallpa": ["Coronel Portillo", "Padre Abad", "Atalaya", "Purus"],
    "Tarapoto": ["San Martín", "Bellavista", "Lamas", "Tocache", "Moyobamba"],
    "Moyobamba": ["Moyobamba", "Rioja", "Lamas", "San Martín", "Tocache"],
    "Abancay": ["Abancay", "Andahuaylas", "Antabamba", "Aymaraes", "Cotabambas"],
    "Huancavelica": ["Huancavelica", "Angaraes", "Tayacaja", "Churcampa", "Acobamba"],
    "Pasco": ["Pasco", "Daniel Alcides Carrión", "Oxapampa"],
    "Puerto Maldonado": ["Tambopata", "Manu", "Tahuamanu"]
  };

  const ciudadSelect = document.getElementById("ciudad");
  const provinciaSelect = document.getElementById("provincia");

  // Llenar las ciudades
  for (let ciudad in provincias) {
    const option = document.createElement("option");
    option.value = ciudad;
    option.textContent = ciudad;
    if (ciudad === "<?php echo $row['ciudad']; ?>") {
      option.selected = true;
    }
    ciudadSelect.appendChild(option);
  }

  // Cargar provincias según la ciudad seleccionada
  function cargarProvincias(ciudadSeleccionada) {
    provinciaSelect.innerHTML = '<option value="">-- Selecciona una provincia --</option>';
    if (provincias[ciudadSeleccionada]) {
      provincias[ciudadSeleccionada].forEach(prov => {
        const option = document.createElement("option");
        option.value = prov;
        option.textContent = prov;
        if (prov === "<?php echo $row['provincia']; ?>") {
          option.selected = true;
        }
        provinciaSelect.appendChild(option);
      });
    }
  }

  // Inicializar provincias según la ciudad guardada
  cargarProvincias("<?php echo $row['ciudad']; ?>");

  // Actualizar provincias al cambiar ciudad
  ciudadSelect.addEventListener("change", e => {
    cargarProvincias(e.target.value);
  });
</script>

</body>
</html>
