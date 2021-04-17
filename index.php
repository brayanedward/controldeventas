<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <!-- App title -->
        <title>Ayelen SPA- Control de Ventas</title>

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="assets/js/modernizr.min.js"></script>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/rutvalidate/jquery.Rut.js"></script>
        <script src="assets/js/bootstrap-notify.js"></script>
    </head>


    <body>

        <!-- Loader -->
        <div id="preloader">
            <div id="status">
                <div class="spinner">
                  <div class="spinner-wrapper">
                    <div class="rotator">
                      <div class="inner-spin"></div>
                      <div class="inner-spin"></div>
                    </div>
                  </div>
                </div>
            </div>
        </div>

        <!-- HOME -->
        <section>
            <div class="container-alt">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="wrapper-page">

                            <div class="m-t-40 account-pages">
                                <div class="text-center account-logo-box">
                                    <h3  style="color:white;">Ayelen SPA</h3>
                                    <h5 style="color:white;">Sistema Control de Ventas</h5>
                                    <!--<h4 class="text-uppercase font-bold m-b-0">Sign In</h4>-->
                                </div>
                                <div class="account-content">
                                    <form class="form-horizontal login" action="#">

                                        <div class="form-group ">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="Rut" name="username">
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-account-circle"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <input type="password" placeholder="Contraseña" class="form-control" name="password" />
                                                <span class="input-group-addon">
                                                    <i class="zmdi zmdi-lock"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group text-center m-t-30">
                                            <div class="col-sm-12">
                                                <!--<a href="page-recoverpw.html" class="text-muted"><i class="fa fa-lock m-r-5"></i> ¿Olvidaste la contraseña?</a>-->
                                            </div>
                                        </div>

                                        <div class="form-group account-btn text-center m-t-10">
                                            <div class="col-xs-12">
                                                <button class="btn btn-primary btn-round btn-lg btn-block btnlogin" type="submit">
                                                            Acceder
                                                            <i class="icon-circle-right2 ml-2">
                                                            </i>
                                                </button>
                                            </div>
                                        </div>

                                    </form>

                                    <div class="clearfix"></div>

                                </div>
                            </div>
                            <!-- end card-box-->
                        </div>
                        <!-- end wrapper -->

                    </div>
                </div>
            </div>
          </section>
           <footer class="footer text-right" >© Copyright <?php echo date('Y'); ?>
                  <a  href="https://mscode.cl/" target="_blank">MSCODE</a> Todos los derechos reservados.
            </footer>
          <!-- END HOME -->
        <script type="text/javascript">

        //vlida el rut
        $('input[name="username"]').Rut({
        on_error: function(){
            $('button[type="submit"]').attr("disabled", true);
            $('button.btnlogin').html('Ops! Rut incorrecto');
        },
        on_success:  function(){
            $('button[type="submit"]').attr("disabled", false);
            $('button.btnlogin').html('Solo falta tu contraseña');
        },
        format_on: 'keyup'
    });

        //valida el login
        $("form.login").submit(function( event ){
                //alert($('form.login').serialize()),
                $.ajax
                ({
                    data:$('form.login').serialize(),
                    url:"./view.php?c=login&a=login",
                    type:"POST",
                    cache: false,
                    beforeSend:function(){
                        $('button.btnlogin').html('Cargando <i class="icon-spinner2 ml-2 spinner"></i>');
                    },
                    success:function(respuesta){
                       //alert(respuesta);
                            switch (respuesta) {
                                case '1':
                                        $(location).attr('href','./view.php');
                                    break;
                                case '0':
                                        $('button.btnlogin').html('Error al iniciar session');
                                    break;
                            }
                    }
                });

                return false;
            });
    </script>


<script>
   $(".navbar-toggler").on('click',function() {
    $("html").toggleClass("nav-open");
});
//=============================================================================
$('.form-control').on("focus", function() {
    $(this).parent('.input-group').addClass("input-group-focus");
}).on("blur", function() {
    $(this).parent(".input-group").removeClass("input-group-focus");
});
</script>
        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>

        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <!--<script src="assets/js/jquery.min.js"></script>

-->
        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>
</html>
