<?php
require_once('../classes/Credentials.php');

if (!isset($_POST['function']) || $_POST['function'] == '')
    return 'Funcion no definida';

// Crear instancia de clase
$credObj = new Credentials('localhost', 'root', '', 'prueba-tecnica');

switch ($_POST['function']) {
    case 'login':
        $username = $_POST['username'];
        $password = $_POST['password'];

        $response = $credObj->login($username, $password);
        break;

    case 'logout':
        $response = $credObj->logout();
        break;
}

echo json_encode($response);