<div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
                        <div class="row">
                        <div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <h4 class="page-title">Inicio   </h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Inicio</a>
                                        </li>
                                        <li class="active">
                                            Dashboard
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->

                        <div class="col-lg-4 col-md-6">
                            <div class="card-box widget-box-two widget-two-success">
                                <i class="mdi mdi-chart-areaspline widget-two-icon"></i>
                                <div class="wigdet-two-content text-white">
                                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Clientes Registrados">Ventas de Hoy</p>
                                    <h2 class="text-white"><span data-plugin="counterup"><?php  echo $this->modelVenta->countHoy(); ?></span> <small><i class="mdi mdi-arrow-up text-success"></i></small></h2>
                                    <p class="m-0"><b>Última Actualización</b></p>
                                </div>
                            </div>
                        </div>
                  <!-- end col -->

                  <div class="col-lg-4 col-md-6">
                      <div class="card-box widget-box-two widget-two-warning">
                          <i class="mdi mdi-chart-areaspline widget-two-icon"></i>
                          <div class="wigdet-two-content text-white">
                              <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Clientes Registrados">Ventas Últimos 7 Días</p>
                              <h2 class="text-white"><span data-plugin="counterup"><?php  echo $this->modelVenta->count(); ?></span> <small><i class="mdi mdi-arrow-up text-success"></i></small></h2>
                              <p class="m-0"><b>Última Actualización</b></p>
                          </div>
                      </div>
                  </div>
            <!-- end col -->

            <div class="col-lg-4 col-md-6">
                <div class="card-box widget-box-two widget-two-danger">
                    <i class="mdi mdi-chart-areaspline widget-two-icon"></i>
                    <div class="wigdet-two-content text-white">
                        <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Clientes Registrados">Ventas del Mes</p>
                        <h2 class="text-white"><span data-plugin="counterup"><?php  echo $this->modelVenta->count(); ?></span> <small><i class="mdi mdi-arrow-up text-success"></i></small></h2>
                        <p class="m-0"><b>Última Actualización</b></p>
                    </div>
                </div>
            </div>
      <!-- end col -->



                          <!--  <div class="col-lg-3">
                                <div class="panel panel-color panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Ventas por Usuario</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table table-hover m-0">
                                                <thead>
                                                    <tr>
                                                        <th>Vendedor</th>
                                                        <th>Nº Ventas</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>

                                        </div> <!-- table-responsive -->
                                    <!--</div>-->
                                <!--</div> <!-- end panel -->

                            <!--</div>-->

    </div>
                        <!-- end row -->
</div>
</div>
</div>
