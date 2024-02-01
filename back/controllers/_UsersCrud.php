<?php
require_once('../classes/UsersCrud.php');

if (!isset($_POST['function']) || $_POST['function'] == '')
    return 'Funcion no definida';

// Crear instancia de clase
$usersObj = new UsersCrud('localhost', 'root', '', 'prueba-tecnica');

switch ($_POST['function']) {
    case 'createUser':
        $name = $_POST['name'];
        $lastName = $_POST['lastName'];
        $address = $_POST['address'];
        $email = $_POST['email'];

        $response = $usersObj->createUser($name, $lastName, $address, $email);
        break;

    case 'getAllUsers':
        $response = $usersObj->getAllUsers();
        break;

    case 'editUser':
        $id = $_POST['id'];
        $name = $_POST['name'];
        $lastName = $_POST['lastName'];
        $address = $_POST['address'];
        $email = $_POST['email'];

        $response = $usersObj->editUser($id, $name, $lastName, $address, $email);
        break;

    case 'deleteUser':
        $id = $_POST['id'];

        $response = $usersObj->deleteUser($id);
        break;
}

echo json_encode($response);