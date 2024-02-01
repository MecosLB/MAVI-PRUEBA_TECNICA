$(() => {
    const loginBtn = $('#loginBtn');

    // Validar login en el back
    loginBtn.on('click', e => {
        $.ajax({
            method: 'POST',
            url: '/prueba-tecnica/back/controllers/_Credentials.php',
            data: {
                function: 'login',
                username: $('.username').val(),
                password: $('.password').val(),
            },
            dataType: 'json',
            success: (res) => {
                if (res !== 'success') return window.alert('Favor de ingresar datos correctos');

                window.location.assign('crud.php');
            },
            error: (warn) => console.warn(warn),
        });
    });
});