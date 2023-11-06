<?php
// Conexión a la base de datos (ajusta los valores según tu configuración)
$servername = "localhost";
$username = "tu_usuario";
$password = "tu_contraseña";
$database = "tu_base_de_datos";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash de la contraseña
$fechaNacimiento = $_POST['fecha_nacimiento'];
$sexo = $_POST['sexo'];
$intereses = implode(', ', $_POST['interes']); // Convertir a cadena
$aficiones = $_POST['aficiones'];

// Insertar datos en la base de datos
$sql = "INSERT INTO usuarios (nombre, direccion, email, password, fecha_nacimiento, sexo, intereses, aficiones) 
        VALUES ('$nombre', '$direccion', '$email', '$password', '$fechaNacimiento', '$sexo', '$intereses', '$aficiones')";

if ($conn->query($sql) === TRUE) {
    echo "Registro exitoso. ¡Bienvenido, $nombre!";
} else {
    echo "Error en el registro: " . $conn->error;
}

$conn->close();
?>
