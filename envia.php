<?php

$servername = "localhost";
$database = "databasename";
$username = "username";
$password = "password";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
mysqli_close($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $sexo = htmlspecialchars($_POST['sexo']);
    $cp= htmlspecialchars($_POST['cp']);
    $mensaje = htmlspecialchars($_POST['mensaje']);
    if (isset($_POST['acepto-terminos'] == '1') {
        echo "Has aceptado los términos y condiciones.";
    } else {
        echo "Debes aceptar los términos y condiciones para continuar.";
    }

    // Validar los datos (opcional)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "El email no es válido.";
        exit;
    }

    $insertar = "INSERT INTO datosform (nombre, email, sexo, cp, mensaje) VALUES(
        '$nombre', 
        '$email', 
        '$sexo',
        '$cp',
        '$mensaje',
        )";
    
    $query = mysqli_query($con, $insertar);
    
    
    if ($query) {
        header('location: index.html'); 
        exit();
        
    
    
        }
        else {
    
// Procesar los datos (por ejemplo, enviarlos por email)
$to = "tu_correo@ejemplo.com";
$subject = "Nuevo mensaje de $nombre";
$body = "Nombre: $nombre\nEmail: $email\nMensaje:\n$mensaje";
$headers = "From: $email";

if (mail($to, $subject, $body, $headers)) {
    echo "Mensaje enviado con éxito.";
} else {
    echo "Hubo un error al enviar el mensaje.";
}
} else {
echo "Método de solicitud no válido.";
}

        }

    
?>