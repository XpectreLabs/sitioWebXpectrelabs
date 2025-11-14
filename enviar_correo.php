<?php
// Configuración para el envío de correo - ADAPTADO PARA HOSTINGER
include('PHPMailer/class.phpmailer.php');
include('PHPMailer/class.smtp.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Recoger y sanitizar los datos del formulario
    $nombre = htmlspecialchars(trim($_POST['fullName']));
    $email = filter_var(trim($_POST['workEmail']), FILTER_SANITIZE_EMAIL);
    $empresa = htmlspecialchars(trim($_POST['company']));
    $cargo = htmlspecialchars(trim($_POST['role']));
    $interes = htmlspecialchars(trim($_POST['interest']));
    $mensaje = htmlspecialchars(trim($_POST['message']));
    
    // Validaciones básicas
    $errores = [];
    
    if (empty($nombre)) {
        $errores[] = "El nombre completo es requerido";
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El email es inválido";
    }
    
    if (empty($empresa)) {
        $errores[] = "La empresa es requerida";
    }
    
    if (empty($interes)) {
        $errores[] = "El área de interés es requerida";
    }
    
    // Si hay errores, mostrarlos
    if (!empty($errores)) {
        http_response_code(400);
        echo json_encode([
            'ok' => false,
            'error' => implode(', ', $errores)
        ]);
        exit;
    }
    
    // Determinar el asunto según de qué formulario viene
    $pagina_origen = isset($_POST['page_origin']) ? $_POST['page_origin'] : 'Formulario de Contacto';
    
    // Construir el cuerpo del mensaje
    $cuerpo_texto = "NUEVO CONTACTO DESDE EL FORMULARIO\n";
    $cuerpo_texto .= "=================================\n";
    $cuerpo_texto .= "PÁGINA DE ORIGEN: " . $pagina_origen . "\n";
    $cuerpo_texto .= "=================================\n";
    $cuerpo_texto .= "INFORMACIÓN DE CONTACTO\n";
    $cuerpo_texto .= "=================================\n";
    $cuerpo_texto .= "Nombre: " . $nombre . "\n";
    $cuerpo_texto .= "Email: " . $email . "\n";
    $cuerpo_texto .= "Empresa: " . $empresa . "\n";
    $cuerpo_texto .= "Cargo: " . (empty($cargo) ? "No especificado" : $cargo) . "\n";
    $cuerpo_texto .= "Área de interés: " . $interes . "\n\n";
    
    if (!empty($mensaje)) {
        $cuerpo_texto .= "=================================\n";
        $cuerpo_texto .= "MENSAJE ADICIONAL\n";
        $cuerpo_texto .= "=================================\n";
        $cuerpo_texto .= $mensaje . "\n\n";
    }
    
    $cuerpo_texto .= "=================================\n";
    $cuerpo_texto .= "INFORMACIÓN TÉCNICA\n";
    $cuerpo_texto .= "=================================\n";
    $cuerpo_texto .= "Fecha: " . date('Y-m-d H:i:s') . "\n";
    $cuerpo_texto .= "IP: " . $_SERVER['REMOTE_ADDR'] . "\n";
    
    // Versión HTML para el correo
    $cuerpo_html = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <style>
            body { font-family: Arial, sans-serif; background: #f9f9f9; padding: 20px; }
            .container { max-width: 600px; margin: auto; background: white; padding: 30px; border-radius: 10px; border-left: 4px solid #004876; }
            .header { background: #004876; color: white; padding: 20px; border-radius: 5px; text-align: center; }
            .section { margin: 20px 0; padding: 15px; background: #f8f9fa; border-radius: 5px; }
            .label { font-weight: bold; color: #004876; }
            .message-box { background: #fff3cd; padding: 15px; border-radius: 5px; border-left: 4px solid #ffc107; }
            .footer { margin-top: 20px; padding-top: 20px; border-top: 1px solid #ddd; color: #666; font-size: 12px; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h1>NUEVO CONTACTO DESDE EL FORMULARIO</h1>
                <p>Página de origen: <strong>$pagina_origen</strong></p>
            </div>
            
            <div class='section'>
                <h2>📋 INFORMACIÓN DE CONTACTO</h2>
                <p><span class='label'>Nombre:</span> $nombre</p>
                <p><span class='label'>Email:</span> <a href='mailto:$email'>$email</a></p>
                <p><span class='label'>Empresa:</span> $empresa</p>
                <p><span class='label'>Cargo:</span> " . (empty($cargo) ? "No especificado" : $cargo) . "</p>
                <p><span class='label'>Área de interés:</span> $interes</p>
            </div>";
    
    if (!empty($mensaje)) {
        $cuerpo_html .= "
            <div class='message-box'>
                <h3>💬 MENSAJE ADICIONAL</h3>
                <p>" . nl2br($mensaje) . "</p>
            </div>";
    }
    
    $cuerpo_html .= "
            <div class='footer'>
                <p><strong>Información técnica:</strong></p>
                <p>Fecha: " . date('Y-m-d H:i:s') . " | IP: " . $_SERVER['REMOTE_ADDR'] . "</p>
            </div>
        </div>
    </body>
    </html>";
    
    // === ENVÍO CON PHPMailer (Configuración Hostinger) ===
    $mail = new PHPMailer(true);
    
    try {
        // Configuración SMTP para Hostinger
        $mail->IsSMTP();
        $mail->SMTPDebug = 0; // Cambia a 2 para debugging
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Host = "smtp.hostinger.com";
        $mail->Port = 587;
        $mail->Username = "info@xpectrelabs.com";
        $mail->Password = "~J6M[/e4e";
        $mail->CharSet = 'UTF-8';
        
        // Remitente y destinatario
        $mail->SetFrom('info@xpectrelabs.com', 'Xpectre Labs');
        $mail->AddReplyTo($email, $nombre);
        $mail->AddAddress('marketing@xpectrelabs.com');
        
        // Asunto y contenido
        $asunto = "Nuevo contacto desde: " . $pagina_origen . " - " . $empresa;
        $mail->Subject = $asunto;
        
        // Cuerpo del mensaje
        $mail->IsHTML(true);
        $mail->Body = $cuerpo_html;
        $mail->AltBody = $cuerpo_texto;
        
        // Enviar correo
        $enviado = $mail->Send();
        
        if ($enviado) {
            echo json_encode([
                'ok' => true,
                'message' => 'Email sent successfully! We will contact you soon.'
            ]);
            error_log("ÉXITO: Formulario de $nombre ($email) desde $pagina_origen");
        } else {
            throw new Exception('PHPMailer no pudo enviar el correo');
        }
        
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode([
            'ok' => false,
            'error' => 'Server error: ' . $e->getMessage()
        ]);
        error_log("ERROR PHPMailer: " . $mail->ErrorInfo);
    }
    
} else {
    http_response_code(405);
    echo json_encode([
        'ok' => false,
        'error' => 'Method not allowed'
    ]);
}
?>