<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "aerolinea";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

function obtenerPrecioBaseDeReserva($conn, $reservaID) {
    $sql = "SELECT precio_base FROM reservas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $reservaID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["precio_base"];
    } else {
        return 0;
    }
    $stmt->close();
}

$nombrePasajero = $_POST['nombre_pasajero'];
$fechaNacimiento = $_POST['fecha_nacimiento'];
$tipoPasajero = $_POST['tipo_pasajero'];
$vueloID = $_POST['vuelo'];

$precioBase = obtenerPrecioBaseDeReserva($conn, $vueloID);

$edad = calcularEdad($fechaNacimiento);

if ($tipoPasajero == "adulto") {
    $precioFinal = $precioBase;
} elseif ($tipoPasajero == "menor") {
    if ($edad >= 2 && $edad <= 17) {
        $precioFinal = $precioBase * 0.75; 
    } else {
        echo "El pasajero no cumple con la categoría de Menor de Edad.";
        exit; 
    }
} else {
    if ($edad <= 2) {
        $precioFinal = 0;
    } else {
        echo "El pasajero no cumple con la categoría de Infante.";
        exit; 
    }
}

$sql = "INSERT INTO reservas (nombre_pasajero, fecha_nacimiento, tipo_pasajero, vuelo_id, precio_final) 
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $nombrePasajero, $fechaNacimiento, $tipoPasajero, $vueloID, $precioFinal);

if ($stmt->execute()) {
    echo "Reserva exitosa. El precio del pasaje es: $" . $precioFinal;
} else {
    echo "Error en la reserva: " . $stmt->error;
}

$conn->close();

function calcularEdad($fechaNacimiento) {
    $fechaNacimiento = new DateTime($fechaNacimiento);
    $hoy = new DateTime();
    $edad = $hoy->diff($fechaNacimiento);
    return $edad->y; 
}
?>


