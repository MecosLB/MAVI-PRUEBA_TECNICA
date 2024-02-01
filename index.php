<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Prueba técnica backend PHP</title>
    <link rel="stylesheet" href="./assets/styles/styles.css?v=0.2">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>
    <main>
        <!-- Contenido principal -->
        <section class="login container my-5">
            <h1 class="text-center text-primary mb-5">
                Login Prueba técnica backend PHP
            </h1>

            <div class="row px-4 gap-3">
                <input type="text" class="form-control username" placeholder="Usuario">
                <input type="password" class="form-control password" placeholder="Contraseña">

                <button id="loginBtn" class="btn btn-primary">Iniciar sesión</button>
            </div>
        </section>
    </main>

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="./assets/scripts/login.js?v=0.1"></script>
</body>

</html>