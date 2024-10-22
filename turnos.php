<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Turno - RenovArte</title>
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Satisfy&display=swap" rel="stylesheet">
</head>
<body>

<header>
    <img src="galeria\logo.png" alt="Logo de RenovArte" class="logo">
    <h1 >Solicitar Turno en RenovArte</h1>
</header>

<section>
    <h2>Formulario de Turno</h2>
    <form action="" method="POST"> <!-- El formulario sigue procesando en la misma página -->
        <label for="nombre">Nombre y Apellido:</label>
        <input type="text" id="nombre" name="nombre" required>
    
        <label for="celular">Celular:</label>
        <input type="text" id="celular" name="celular" required>
    
        <label for="servicio">Servicio:</label>
        <select id="servicio" name="servicio" required>
            <option value="corte">Corte</option>
            <option value="tintura">Tintura</option>
            <option value="reflejos">Reflejos</option>
            <option value="manos">Manos</option>
            <option value="masajes">Masajes</option>
            <option value="nutricion">Nutrición</option>
            <option value="alisados">Alisados</option>
            <option value="permanente">Permanente de Pestañas</option>
        </select>
    
        <!-- Campo de fecha -->
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required>
    
        <!-- Campo de hora -->
        <label for="hora">Hora:</label>
        <input type="time" id="hora" name="hora" required>
    
        <button type="submit">Solicitar Turno</button>
    </form>

    <?php
    // Configuración de la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "turnos";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Verificar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST['nombre'];
        $celular = $_POST['celular'];
        $servicio = $_POST['servicio'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];

        // Validar datos
        if (empty($nombre) || empty($celular) || empty($servicio) || empty($fecha) || empty($hora)) {
            echo "Todos los campos son obligatorios.";
        } else {
            $sql = "INSERT INTO turnos (nombre, celular, servicio, fecha, hora) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $nombre, $celular, $servicio, $fecha, $hora);

            if ($stmt->execute()) {
                echo "Turno solicitado con éxito. Te hemos enviado un mensaje a $celular.";
            } else {
                echo "Error al solicitar el turno: " . $stmt->error;
            }

            $stmt->close();
        }
    }

    $conn->close();
    ?>

</section>

<footer>
    <p>Contáctanos: WhatsApp: <a href="https://wa.me/1126639132">1126639132</a>, Email: <a href="mailto:biondimatias@gmail.com">biondimatias@gmail.com</a></p>
</footer>

</body>
</html>
