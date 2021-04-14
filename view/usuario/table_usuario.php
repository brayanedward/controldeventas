<script type="text/javascript">

</script>
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
                        <a href="./view.php?c=usuario&a=add" class="btn btn-danger btn-bordered waves-effect waves-light m-b-20" data-animation="fadein" data-plugin="custommodal" data-overlayspeed="200" data-overlaycolor="#36404a"><i class="md md-add"></i>Agregar
                            Usuario</a>
                        <div class="row">
                            <?php $o = 0;
                            foreach ($this->model->lista() as $rows) : ?>
                                <div class="col-lg-3" id="divContainer_<?php echo $rows['rut_usuario']; ?>">
                                    <div class="text-center card-box">
                                        <div class="dropdown float-right" style="float: right;">
                                            <!-- <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                                <h3 class="m-0 text-muted"><i class="mdi mdi-dots-horizontal"></i></h3>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="#" class="dropdown-item">Edit</a></li>
                                                <li><a href="#" class="dropdown-item">Delete</a></li>
                                                <li><a href="#" class="dropdown-item">Block</a></li>
                                            </ul> -->
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="member-card">
                                            <div class="member-thumb m-b-10 mx-auto d-block">
                                                <img src="https://biggerpockets.s3.amazonaws.com/assets/avatar/no_avatar.svg" class="img-thumbnail" alt="profile-image" style="border-radius: 50%!important;width: 150px;" align="center">
                                            </div>

                                            <div>
                                                <h4 class="m-b-5"><?php echo $rows['nombre_usuario']; ?> <?php echo $rows['apellido_usuario']; ?></h4>
                                                <p class="text-muted"> <?php echo $rows['rut_usuario'] . '-' . $rows['dv_usuario']; ?> </p>
                                            </div>

                                            <p class="text-muted font-13">
                                            <?php if ($rows['estado_usuario']  == 1) { $estado = 'Habilitado'; } else { $estado = 'Deshabilitado'; }?>
                                                Estado: <?php echo $estado; ?>
                                            </p>

                                            <button type="button" class="btn btn-info btn-rounded waves-effect m-t-10 waves-light" data-toggle="modal" data-target="#ModalPasswd_<?php echo $rows['rut_usuario']; ?>">Cambiar Contraseña</button>

                                            <ul class="social-links list-inline m-t-30">
                                                <li class="list-inline-item">
                                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="<?php echo $this->urledit . base64_encode($rows['rut_usuario']); ?>" data-original-title="Editar"><i class="fas fa-pen"></i></a>
                                                </li>
                                                <?php if ($rows['estado_usuario']  == 1) { ?>
                                                    <li class="list-inline-item">
                                                        <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="<?php echo $this->urlstatus . base64_encode($rows['rut_usuario']); ?>" data-original-title="Desactivar"><i class="fas fa-times"></i></a>
                                                    </li>
                                                <?php } ?>
                                                <?php if ($rows['estado_usuario']  == 2) { ?>
                                                    <li class="list-inline-item">
                                                        <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="<?php echo $this->urlstatus . base64_encode($rows['rut_usuario']); ?>" data-original-title="Activar"><i class="fas fa-check"></i></a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;" id="ModalPasswd_<?php echo $rows['rut_usuario']; ?>">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="mySmallModalLabel">Cambiar Contraseña</h4>
                                            </div>
                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label for="pass1_<?php echo $rows['rut_usuario']; ?>">Contraseña<span class="text-danger">*</span></label>
                                                    <input id="pass1_<?php echo $rows['rut_usuario']; ?>" type="password" placeholder="Password" required="" class="form-control" name="txt_password">
                                                </div>
                                                <div class="form-group">
                                                    <label for="pass2_<?php echo $rows['rut_usuario']; ?>">Confirmar Contraseña <span class="text-danger">*</span></label>
                                                    <input data-parsley-equalto="#pass1" type="password" required="" placeholder="Password" class="form-control" id="pass2_<?php echo $rows['rut_usuario']; ?>">
                                                </div>
                                                <div class="form-group text-right m-b-0">

                                                    <button class="btn btn-primary waves-effect waves-light" onclick="cambiaPassUsu('<?php echo $rows['rut_usuario']; ?>')">
                                                        Guardar
                                                    </button>

                                                    <a onclick="$('#ModalPasswd_<?php echo $rows['rut_usuario']; ?>').modal('toggle');">
                                                        <button type="button" class="btn btn-secondary waves-effect m-l-5">
                                                            Cerrar
                                                        </button>
                                                    </a>
                                                </div>

                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div>
                            <?php $o++;
                            endforeach; ?>
                        </div>
                    </div>
                </div>
                <!-- end col-12 -->
            </div> <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->
</div>
<script type="text/javascript">
    function cambiaPassUsu(id) {
        var pass1 = $('#pass1_' + id).val();
        var pass2 = $('#pass2_' + id).val();
        if (pass1 == pass2) {
            $.ajax({
                data: {
                    "idusu": id,
                    "pass1": pass1
                },
                url: "<?php echo $this->urlchpass; ?>",
                type: "POST",
                cache: false,
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                beforeSend: function() {
                    $('.message').html('<div class="sk-wave"> <div class="sk-rect sk-rect1"></div> <div class="sk-rect sk-rect2"></div> <div class="sk-rect sk-rect3"></div> <div class="sk-rect sk-rect4"></div> <div class="sk-rect sk-rect5"></div> </div>');
                },
                success: function(respuesta) {
                    alertify.success('Contraseña Actualizada!');
                    $('#ModalPasswd_' + id).modal('hide');
                    $('#pass1_' + id).val('');
                    $('#pass2_' + id).val('');
                    //window.location.href = '<?php echo $this->urlhome; ?>';
                }
            });
            return false;
        } else {
            // swal("Las contraseñas no coinciden!", "", "success");
            alertify.error('Las contraseñas no coinciden!');
        }
    }
</script>
