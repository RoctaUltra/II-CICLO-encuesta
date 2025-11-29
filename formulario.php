<?php
$nota1 = 15;
$nota2 = 10;
$nota3 = 18;

$promedio = ($nota1 + $nota2 + $nota3) / 3;

echo "El promedio es: " . $promedio . "<br>";

if ($promedio >= 13) {
    echo "El alumno APROBÓ ✅";
} else {
    echo "El alumno DESAPROBÓ ❌";
}
?>
<?php
$nota1 = $_POST['nota1'];
$nota2 = $_POST['nota2'];
$nota3 = $_POST['nota3'];

$promedio = ($nota1 + $nota2 + $nota3) / 3;

echo "El promedio es: " . $promedio . "<br>";

if ($promedio >= 13) {
    echo "El alumno APROBÓ";
} else {
    echo "El alumno DESAPROBÓ";
}
?>
