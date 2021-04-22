<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Registrar Ventas </h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li>
                                <a href="#">Mantenedores</a>
                            </li>
                            <li class="active">
                                Registro de ventas
                            </li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="portlet">
                        <div class="portlet-heading bg-info">
                            <h3 class="portlet-title">
                                DATOS VENTA
                            </h3>
                            <div class="portlet-widgets">
                                <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                <span class="divider"></span>
                                <a data-toggle="collapse" data-parent="#accordion1" href="#ventas"><i
                                        class="ion-minus-round"></i></a>
                                <span class="divider"></span>
                                <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <?php foreach ($this->model->lista() as $rows); ?>
                        <form>
                        <div id="ventas" class="panel-collapse collapse in">
                            <div class="portlet-body">
                                <div class="form-group col-lg-4">
                                    <label for="txtValorventa">Valor Venta</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-money"></i></span>
                                        <input type="number" id="txtValorventa" name="txtValorventa"
                                            class="form-control" placeholder="" maxlength="9" value="<?php echo $rows['valor_venta']?>">
                                    </div>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="txtFechaventa">Fecha Venta</label>
                                    <input type="datetime-local" id="txtFechaventa" name="txtFechaventa" class="form-control"
                                        value="<?php echo $rows['fechaUsuario_venta1']?>">
                                </div>
                                <label for="txtCorreoElectronico">Tipo de Pago</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="zmdi zmdi-card"></i></span>
                                    <select id="selTipopago" name="selTipopago" class="form-control" required="">
                                        <option>SELECCIONE ... </option>
                                        <?php foreach ($this->model->listaPagos() as $rowPago) : ?>
                                        <?php if($rows['tipopago_venta'] == $rowPago['id_tipopago']){ $selected = 'selected';}else{$selected = '';}?>
                                        <option <?php echo $selected; ?> value="<?php echo $rowPago['id_tipopago'] ?>">
                                            <?php echo $rowPago['descripcion_tipopago'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <br>
                                <div class="form-group col-lg-4">
                                    <label for="txtNombrePremium">Nombres Cliente Premium</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-account-box-o"></i></span>
                                        <input type="text" id="txtNombrePremium" name="txtNombrePremium"
                                            class="form-control" placeholder="Ingrese los Nombres de Cliente Premium"
                                            maxlength="500" value="<?php echo $rows['nombreCliente_venta'];?>">
                                    </div>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="txtRutPremium">Rut Cliente Premium</label>
                                    <input type="text" id="txtRutPremium" name="txtRutPremium"
                                        class="form-control" placeholder="Ingrese el Correo Electrónico Premium"
                                        maxlength="12" value="<?php echo $rows['rutCliente_venta'];?>-<?php echo $rows['dvCliente_venta'];?>">
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="txtCorreoPremium">Correo Cliente Premium</label>
                                    <input type="text" id="txtCorreoPremium" name="txtCorreoPremium"
                                        class="form-control" placeholder="Ingrese el Correo Electrónico Premium"
                                        maxlength="50" value="<?php echo $rows['correoCliente_venta'];?>">
                                </div>

                                <div class="form-group col-lg-4">
                                    <label for="txtNombreInvitado">Nombres Cliente Invitado</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-account-box-o"></i></span>
                                        <input type="text" id="txtNombreInvitado" name="txtNombreInvitado"
                                            class="form-control" placeholder="Ingrese Nombres de Invitado"
                                            maxlength="500" value="<?php echo $rows['nombreInvitado_venta'];?>">
                                    </div>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="txtRutInvitado">Rut Cliente Invitado</label>
                                    <input type="text" id="txtRutInvitado" name="txtRutInvitado"
                                        class="form-control" placeholder="Ingrese Rut Invitado"
                                        maxlength="12" value="<?php echo $rows['rutInvitado_venta'];?>-<?php echo $rows['dvInvitado_venta'];?>">
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="txtCorreoInvitado">Correo Cliente Invitado</label>
                                    <input type="text" id="txtCorreoInvitado" name="txtCorreoInvitado"
                                        class="form-control" placeholder="Ingrese el Correo Electrónico Invitado"
                                        maxlength="50" value="<?php echo $rows['correoInvitado_venta'];?>">
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="txtCodigoCupon">Código Cupón</label>
                                    <input type="text" id="txtCodigoCupon" name="txtCodigoCupon"
                                        class="form-control" placeholder="Ingrese el Correo Electrónico Invitado"
                                        maxlength="500" value="<?php echo $rows['cupon_venta'];?>">
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="txtCodigoVaucher">Código Váucher (Transferencia)</label>
                                    <input type="text" id="txtCodigoVaucher" name="txtCodigoVaucher"
                                        class="form-control" placeholder="Ingrese el Correo Electrónico Invitado"
                                        maxlength="500" value="<?php echo $rows['vaucher_venta'];?>">
                                </div>

                               <div class="form-group col-lg-4">
                                    <label for="txtCorreoElectronico">Adjuntar Archivo</label>
                                    <input type="file" name="archivo[]" value="" class="form-control file-input">
                                </div>
                                <br>

                                <div class="form-group">
                                    <label for="txtDetalleventa">Detalle Venta</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-border-color"></i></span>
                                        <textarea class="form-control" name="txtDetalleventa" id="txtDetalleventa" rows="3" style="width:100%;"  maxlength="500"><?php echo $rows['descripcion_venta']?></textarea>
                                    </div>
                                </div>
                                <input type="hidden" value="<?php echo $rows['id_venta'];?>" name="idventa" id="idventa">
                                </form>               
                                <br>
                                <button type="button" onclick="grabar(<?php echo $rows['id_venta']?>)" class="btn btn-info btn-round"><i class="zmdi zmdi-floppy"></i> Editar</button>
                                <a href="<?php echo $this->urlhome; ?>"> <button type="button" class="btn btn-danger btn-round"><i class="zmdi zmdi-long-arrow-return"></i> Volver</button></a>
                            </div>
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
$('input[name="txtRutPremium"]').Rut({
    on_error: function() {
        $('button[type="button"]').attr("disabled", true);
        alertify.error('Run Incorrecto');
    },
    on_success: function() {
        $('button[type="button"]').attr("disabled", false);
        alertify.success('Run Correcto');
    },
    format_on: 'keyup'
});

var errores = 0;

$('input[name="txtRutInvitado"]').Rut({
    on_error: function() {
        $('button[type="button"]').attr("disabled", true);
        alertify.error('Run Incorrecto');
    },
    on_success: function() {
        $('button[type="button"]').attr("disabled", false);
        alertify.success('Run Correcto');
    },
    format_on: 'keyup'
});


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
        var formData = new FormData($('form')[0]);
        $.ajax({
            data: formData,
            url: "<?php echo $this->urlupdate; ?>",
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('.message').html(
                    '<div class="sk-wave"> <div class="sk-rect sk-rect1"></div> <div class="sk-rect sk-rect2"></div> <div class="sk-rect sk-rect3"></div> <div class="sk-rect sk-rect4"></div> <div class="sk-rect sk-rect5"></div> </div>'
                );
            },
            success: function(respuesta) {
                console.log(respuesta);
                if (respuesta == 1) {
                    alertify.success('Editado Exitosamente!');
                    limpiar();
                } else {
                    alertify.error('Error al ingresar la información');
                }
            }
        });
        return false;
    } else {
        alertify.error(validacionesUsu());
    }
}

function validacionesUsu() {
    var errores = '';

    if ($('#txtValorventa').val() == '') {
        errores += '- Debe completar el Valor de la venta <br>';
    }
    if ($('#txtFechaventa').val() == '') {
        errores += '- Debe completar la Fecha de la venta <br>';
    }
    if ($('#txtNombrecventa').val() == '') {
        errores += '- Debe completar Nombre Cliente venta <br>';
    }
    if ($('#selTipopago').val() == 0) {
        errores += '- Debe completar el Tipo de pago <br>';
    }
    if ($('#txtNombrePremium').val() == '') {
        errores += '- Debe completar Nombre Cliente Premium <br>';
    }
    if ($('#txtRutPremium').val() == '') {
        errores += '- Debe completar Rut Cliente Premium <br>';
    }
    if ($('#txtNombreInvitado').val() != '') {
        if ($('#txtRutInvitado').val() == '') {
            errores += '- Debe completar Rut Cliente Invitado <br>';
        }
    }
    if ($('#txtRutInvitado').val() != '' && $('#txtRutInvitado').val() != '0-') {
        if ($('#txtNombreInvitado').val() == '') {
            errores += '- Debe completar Nombre Cliente Invitado <br>';
        }
    }

    return errores;
}

function limpiar() {
  $('#txtValorventa').val('');
  $('#txtFechaventa').val('');
  $('#txtNombrecventa').val('');
  $('#txtDireccioventa').val('');
  $('#selTipopago').val('');
  $('#txtDetalleventa').val('');
  $('#txtTelefonocliente').val('');
  $('#txtCorreocliente').val('');

  $('#txtNombrePremium').val();
  $('#txtRutPremium').val();
  $('#txtCorreoPremium').val();

  $('#txtNombreInvitado').val();
  $('#txtRutInvitado').val();
  $('#txtCorreoInvitado').val();

  $('#txtCodigoCupon').val();
  $('#txtCodigoVaucher').val();
}
</script>
