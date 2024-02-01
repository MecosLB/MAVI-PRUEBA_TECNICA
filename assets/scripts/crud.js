const userModalBS = new bootstrap.Modal("#userModal", {}),
    deleteModalBS = new bootstrap.Modal("#deleteModal", {});

// GENERAL METHODS
const emptyInputs = () => {
    $('.name').val('');
    $('.lastName').val('')
    $('.address').val('')
    $('.email').val('');
}

// CRUD METHODS
const createUser = (name = $('.name').val(), lastName = $('.lastName').val(), address = $('.address').val(), email = $('.email').val()) => {
    if (!name) return window.alert('Favor de ingresar un nombre');
    if (!lastName) return window.alert('Favor de ingresar un apellido');
    if (!address) return window.alert('Favor de ingresar un domicilio');
    if (!email) return window.alert('Favor de ingresar un correo');

    const mailRegex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if (!mailRegex.test(email)) return window.alert('Favor de ingresar un correo VÁLIDO');

    $.ajax({
        method: 'POST',
        url: '/prueba-tecnica/back/controllers/_UsersCrud.php',
        data: {
            function: 'createUser',
            name: name,
            lastName: lastName,
            address: address,
            email: email,
        },
        dataType: 'json',
        success: (res) => {
            getAllUsers();
            userModalBS.hide();
            emptyInputs();
        },
        error: (warn) => console.warn(warn),
    });
};

const getAllUsers = (table = $('#usersTable tbody')) => {
    table.empty();

    $.ajax({
        method: 'POST',
        url: '/prueba-tecnica/back/controllers/_UsersCrud.php',
        data: {
            function: 'getAllUsers',
        },
        dataType: 'json',
        success: (res) => {
            if (!res.length) {
                table.append(`<tr>
                    <td colspan='6'>No hay clientes para mostrar</td>
                </tr>`);

                return;
            }

            res.forEach(({ id, nombre, apellido, domicilio, correo }) => {
                table.append(`<tr>
                    <td>${id}</td>
                    <td>${nombre}</td>
                    <td>${apellido}</td>
                    <td>${domicilio}</td>
                    <td>${correo}</td>
                    <td>
                        <button class='btn btn-primary edit' id='${id}' name='${nombre}' lastName='${apellido}' address='${domicilio}' email='${correo}' data-bs-toggle='modal' data-bs-target='#userModal'>Edit</button>
                        <button class='btn btn-danger' id='${id}' name='${nombre}' lastName='${apellido}' data-bs-toggle='modal' data-bs-target='#deleteModal'>X</button>
                    </td>
                </tr>`);
            });
        },
        error: (err) => console.warn(err),
    });
};

const editUser = (id = $('#userModal .confirm').attr('id'), name = $('.name').val(), lastName = $('.lastName').val(), address = $('.address').val(), email = $('.email').val()) => {
    if (!id) return false;
    if (!name) return window.alert('Favor de ingresar un nombre');
    if (!lastName) return window.alert('Favor de ingresar un apellido');
    if (!address) return window.alert('Favor de ingresar un domicilio');
    if (!email) return window.alert('Favor de ingresar un correo');

    const mailRegex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if (!mailRegex.test(email)) return window.alert('Favor de ingresar un correo VÁLIDO');

    $.ajax({
        method: 'POST',
        url: '/prueba-tecnica/back/controllers/_UsersCrud.php',
        data: {
            function: 'editUser',
            id: id,
            name: name,
            lastName: lastName,
            address: address,
            email: email,
        },
        dataType: 'json',
        success: (res) => {
            getAllUsers();
            userModalBS.hide();
            emptyInputs();
        },
        error: (warn) => console.warn(warn),
    });
};

const deleteUser = (id = '') => {
    if (!id) return false;

    $.ajax({
        method: 'POST',
        url: '/prueba-tecnica/back/controllers/_UsersCrud.php',
        data: {
            function: 'deleteUser',
            id: id,
        },
        dataType: 'json',
        success: (res) => {
            getAllUsers();
            deleteModalBS.hide();
        },
        error: (warn) => console.warn(warn),
    });
};

const logout = () => {
    $.ajax({
        method: 'POST',
        url: '/prueba-tecnica/back/controllers/_Credentials.php',
        data: {
            function: 'logout',
        },
        dataType: 'json',
        success: (res) => {
            if (res !== 'success') window.alert("Algo salió mal :(");

            window.location.assign('index.php');
        },
        error: (warn) => console.warn(warn),
    });
}

//-----------------------------------------------------------------------

// DOM ready...
$(() => {
    const userModal = $('#userModal'),
        deleteModal = $('#deleteModal'),
        logoutBtn = $('#logoutBtn');

    // On showing Add/edit user modal
    userModal.on('show.bs.modal', e => {
        const { relatedTarget: btnClicked } = e,
            confirmBtn = $('#userModal .confirm');

        confirmBtn.off('click.userEvent');

        // Depending the action
        if ($(btnClicked).hasClass('create')) {
            $('.action').text('Agregar');

            confirmBtn.on('click.userEvent', e => {
                createUser();
            });
        }
        else {
            $('.action').text('Editar');

            $('.name').val($(btnClicked).attr('name'))
            $('.lastName').val($(btnClicked).attr('lastName'))
            $('.address').val($(btnClicked).attr('address'))
            $('.email').val($(btnClicked).attr('email'))

            confirmBtn.on('click.userEvent', e => {
                editUser($(btnClicked).attr('id'));
            });
        }

    });

    // On closing Add/edit user modal
    userModal.on('hidden.bs.modal', e => {
        emptyInputs();
    });

    // On showing Delete modal
    deleteModal.on('show.bs.modal', e => {
        const { relatedTarget: btnClicked } = e,
            deleteBtn = $('#deleteModal .delete');

        deleteBtn.off('click.userEvent');

        $('.user-name').text(`${$(btnClicked).attr('name')} ${$(btnClicked).attr('lastName')}`);

        deleteBtn.on('click.userEvent', e => {
            deleteUser($(btnClicked).attr('id'));
        });
    });

    logoutBtn.on('click', e => {
        logout();
    });

    getAllUsers();

});