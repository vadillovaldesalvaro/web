<?php
// Verifica si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibe los valores del formulario
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST["message"]));

    // Verifica que los campos no estén vacíos
    if (!empty($name) && !empty($email) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Configura los datos del correo
        $to = "vadillovaldesalvaro@gmail.com"; // Tu dirección de correo de destino
        $subject = "Nuevo mensaje de contacto de: " . $name;
        $body = "Nombre: $name\nCorreo: $email\n\nMensaje:\n$message";
        $headers = "From: $email\r\nReply-To: $email\r\nX-Mailer: PHP/" . phpversion();

        // Envía el correo
        if (mail($to, $subject, $body, $headers)) {
            echo "<p>¡Gracias! Tu mensaje ha sido enviado.</p>";
        } else {
            echo "<p>Hubo un error al enviar tu mensaje. Por favor, intenta nuevamente.</p>";
        }
    } else {
        echo "<p>Por favor, completa todos los campos correctamente.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Contacto</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2 class="my-5">Formulario de Contacto</h2>
    <form method="POST" action="contact.php">
        <div class="form-group">
            <label for="name">Nombre Completo</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Ingresa tu nombre" required>
        </div>
        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa tu correo" required>
        </div>
        <div class="form-group">
            <label for="message">Mensaje</label>
            <textarea class="form-control" id="message" name="message" rows="4" placeholder="Ingresa tu mensaje" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
    </form>
</div>
</body>
</html>