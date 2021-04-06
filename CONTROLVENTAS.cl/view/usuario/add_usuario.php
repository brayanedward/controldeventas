<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Gestion de Usuarios </h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li>
                                <a href="#">Mantenedores</a>
                            </li>
                            <li class="active">
                                Gestion de Usuarios
                            </li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-12">
                    <div class="card-box">
                        <div class="body">
                            <form class="form" id="form" method="POST">
                                <label for="txtRutUsuario">Rut Usuario</label>
                                <div class="form-group">
                                    <input type="text" id="txtRutUsuario" name="txtRutUsuario" class="form-control" placeholder="Ingrese el Rut de Usuario" autocomplete="off" maxlength="12">
                                </div>
                                <label for="txtNombreUsuario">Nombre Usuario</label>
                                <div class="form-group">
                                    <input type="text" id="txtNombreUsuario" name="txtNombreUsuario" class="form-control" placeholder="Ingrese el Nombre de Usuario" autocomplete="off" maxlength="200">
                                </div>
                                <label for="txtApellidoP">Apellidos Paterno</label>
                                <div class="form-group">
                                    <input type="text" id="txtApellidoP" name="txtApellidoP" class="form-control" placeholder="Ingrese el Apellido de Usuario" autocomplete="off" maxlength="200">
                                </div>
                                <label for="txtApellidoM">Apellidos Materno</label>
                                <div class="form-group">
                                    <input type="text" id="txtApellidoM" name="txtApellidoM" class="form-control" placeholder="Ingrese el Apellido de Usuario" autocomplete="off" maxlength="200">
                                </div>
                                <label for="txtPassword">Contraseña</label>
                                <div class="form-group">
                                    <input onblur="validapwIguales()" maxlength="50" type="password" id="txtPassword" name="txtPassword" class="form-control" placeholder="Contraseña" autocomplete="off">
                                </div>
                                <label for="txtPassword2">Repetir Contraseña</label>
                                <div class="form-group">
                                    <input onblur="validapwIguales()" maxlength="50" type="password" id="txtPassword2" name="txtPassword2" class="form-control" placeholder="Contraseña" autocomplete="off">
                                </div>

                                <button type="button" onclick="grabar()" class="btn btn-info btn-round"><i class="zmdi zmdi-floppy"></i> Guardar</button>
                                <a href="<?php echo $this->urlhome; ?>"> <button type="button" class="btn btn-danger btn-round"><i class="zmdi zmdi-long-arrow-return"></i> Volver</button></a>
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->
</div>

<script type="text/javascript">

    $('.form-control').maxlength({
        alwaysShow: true,
        threshold: 10,
        warningClass: "label label-success",
        limitReachedClass: "label label-danger",
        placement: 'bottom',
        separator: ' / '
    });

    //vlida el rut
    $('input[name="txtRutUsuario"]').Rut({
        on_error: function() {
            $('button[type="submit"]').attr("disabled", true);
            $('button.btnlogin').html('Ops! Rut incorrecto');
        },
        format_on: 'keyup'
    });

    var errores = 0;

    function validapwIguales() {
        var pw1 = $('#txtPassword').val();
        var pw2 = $('#txtPassword2').val();

        if (pw1 && pw2 != '') {
            if (pw1 != pw2) {
                errores = 1;
                $.notify({
                    // options
                    message: 'Las Contraseñas no Coinciden'
                }, {
                    // settings
                    type: 'danger'
                });
            }
        } else {
            errores = 0;
        }
    }

    $('input[name="txtRutUsuario"]').Rut({
        on_error: function() {
            $('button[type="submit"]').attr("disabled", true);
            alertify.error('Run Incorrecto');
        },
        on_success: function() {
            $('button[type="submit"]').attr("disabled", false);
            alertify.success('Run Correcto');
        },
        format_on: 'keyup'
    });

    function grabar() {

        if (validacionesUsu() == '') {
            $.ajax({
                data: {
                    "txtRutUsuario": $('#txtRutUsuario').val(),
                    "txtNombreUsuario": $('#txtNombreUsuario').val(),
                    "txtApellidoP": $('#txtApellidoP').val(),
                    "txtApellidoM": $('#txtApellidoM').val(),
                    "txtPassword": $('#txtPassword').val()
                },
                url: "<?php echo $this->urlsave; ?>",
                type: "POST",
                cache: false,
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                beforeSend: function() {
                    $('.message').html('<div class="sk-wave"> <div class="sk-rect sk-rect1"></div> <div class="sk-rect sk-rect2"></div> <div class="sk-rect sk-rect3"></div> <div class="sk-rect sk-rect4"></div> <div class="sk-rect sk-rect5"></div> </div>');
                },
                success: function(respuesta) {
                    if (respuesta == 1) {
                        alertify.success('Guardado Exitosamente!');
                        limpiar();
                        setTimeout(() => {
                            window.location.href = '<?php echo $this->urlhome; ?>';
                        }, 1000);
                    } else {
                        alertify.error('Error al ingresar la información');
                    }
                }
            });
            return false;
        } else {
            alert(validacionesUsu());
        }

    }

    function validacionesUsu() {
        var errores = '';

        if ($('#txtRutUsuario').val() == '') {
            errores += '- Debe completar el Rut de Usuario \n';
        }
        if ($('#txtNombreUsuario').val() == '') {
            errores += '- Debe completar el Nombre de Usuario \n';
        }
        if ($('#txtApellidoUsuario').val() == '') {
            errores += '- Debe completar el Apellido de Usuario \n';
        }
        if ($('#txtFecNacimiento').val() == '') {
            errores += '- Debe completar la Fecha de Nacimiento \n';
        }
        if ($('#txtCorreoElectronico').val() == '') {
            errores += '- Debe completar el Correo de Usuario \n';
        }
        if ($('#txtPassword').val() == '') {
            errores += '- Debe completar la Contraseña de Usuario \n';
        }

        var pw1 = $('#txtPassword').val();
        var pw2 = $('#txtPassword2').val();

        if (pw1 && pw2 != '') {
            if (pw1 != pw2) {
                errores += '- Las Contraseñas no Coinciden \n';
            }
        }

        return errores;
    }

    function limpiar() {
        $('#txtRutUsuario').val('');
        $('#txtNombreUsuario').val('');
        $('#txtApellidoUsuario').val('');
        $('#txtFecNacimiento').val('');
        $('#txtCorreoElectronico').val('');
        $('#txtTelUsuario').val('');
        $('#txtPassword').val('');
        $('#txtPassword2').val('');
    }
</script>