<?php
session_start();

if (!isset($_SESSION['id']) || !isset($_SESSION['username']))
    header('Location: index.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba técnica backend PHP</title>
    <link rel="stylesheet" href="./assets/styles/styles.css?v=0.1">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>
    <main>

        <!-- Contenido principal -->
        <section class="container my-5">
            <h1 class="text-center text-uppercase text-primary mb-2">
                Prueba técnica backend PHP
            </h1>

            <h2 class="text-center text-success mb-2">
                ¡Bienvenido
                <?php echo $_SESSION['username'] ?>!
            </h2>

            <button id="logoutBtn" class="d-flex mx-auto btn btn-danger mb-5">
                Cerrar sesión
            </button>

            <div class="row justify-content-lg-end justify-content-center gap-3">
                <!-- Agregar cliente -->
                <button class="btn btn-primary col-lg-3 col-6 create" data-bs-toggle="modal" data-bs-target="#userModal">
                    + Nuevo cliente
                </button>

                <!-- Tabla clientes -->
                <table id="usersTable" class="table text-center col-12">
                    <thead class="table-dark">
                        <tr class="text-uppercase font-bold">
                            <td>
                                Id
                            </td>
                            <td>
                                Nombre
                            </td>
                            <td>
                                Apellido
                            </td>
                            <td>
                                Domicilio
                            </td>
                            <td>
                                Correo
                            </td>
                            <td>
                                Opciones
                            </td>
                        </tr>
                    </thead>

                    <tbody>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <!-- Modal agregar/editar cliente -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><span class="action"></span> usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body row px-4 gap-3">
                    <input type="text" class="form-control name" placeholder="Nombre">
                    <input type="text" class="form-control lastName" placeholder="Apellido">
                    <input type="text" class="form-control address" placeholder="Domicilio">
                    <input type="email" class="form-control email" placeholder="Correo electrónico">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary confirm">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal eliminar cliente -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar cliente</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body row px-4 gap-3">
                    <p>
                        ¿Deseas eliminar al cliente: <span class="user-name"></span>?
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger delete">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="./assets/scripts/crud.js?v=0.21"></script>
</body>

</html>