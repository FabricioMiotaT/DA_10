<!DOCTYPE html>
<html>
<head>
    <title>Reserva de Pasajes Aéreos</title>
</head>
<body>
    <h1>Reserva de Pasajes Aéreos</h1>
    
    <form action="procesar_reserva.php" method="post">
        <label>Fecha de Nacimiento: <input type="date" name="fecha_nacimiento"></label>
        <label>Tipo de Pasajero: 
            <select name="tipo_pasajero">
                <option value="adulto">Adulto</option>
                <option value="menor">Menor de Edad</option>
                <option value="infante">Infante</option>
            </select>
        </label>
        <label>Vuelo: 
            <select name="vuelo">
                <option value="vuelo1">Arequipa - Lima</option>
                <option value="vuelo2">Lima - Buenos Aires</option>
                <option value="vuelo3">Lima - Quito</option>
            </select>
        </label>
        <button type="submit">Reservar Pasaje</button>
    </form>
</body>
</html>
