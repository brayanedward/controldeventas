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
                        <?php foreach ($this->model->countCliente() as $rows) : ?>
                            <div class="col-lg-3 col-md-6">
                                <div class="card-box widget-box-two widget-two-info">
                                    <i class="mdi mdi-chart-areaspline widget-two-icon"></i>
                                    <div class="wigdet-two-content text-white">
                                        <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Clientes Registrados">Clientes Registrados</p>
                                        <h2 class="text-white"><span data-plugin="counterup"><?php echo $rows['num'] ?></span> <small><i class="mdi mdi-arrow-up text-success"></i></small></h2>
                                        <p class="m-0"><b>Última Actualización</b></p>
                                    </div>
                                </div>
                            </div><!-- end col -->
                        <?php endforeach; ?>

                        <?php foreach ($this->model->countVisitas() as $rows): ?>
                            <div class="col-lg-3 col-md-6">
                                <div class="card-box widget-box-two widget-two-primary">
                                    <i class="mdi mdi-layers widget-two-icon"></i>
                                    <div class="wigdet-two-content text-white">
                                        <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="User This Month">VISITAS REGISTRADAS</p>
                                        <h2 class="text-white"><span data-plugin="counterup"><?php echo $rows['num'] ?> </span> <small><i class="mdi mdi-arrow-up text-success"></i></small></h2>
                                        <p class="m-0"><b>Última Actualización</b></p>
                                    </div>
                                </div>
                            </div><!-- end col -->
                        <?php endforeach; ?>

                        <?php $countMayores = 0; $countMenores= 0; ?>
                        <?php foreach ($this->model->countMayores() as $rows): ?>
                            <?php if($rows['edad_actual']>=65){
                                    $countMayores++; 
                            } 
                             if($rows['edad_actual']<65){
                                    $countMenores++; 
                            }
                            ?>
                        <?php endforeach; ?>
                            <div class="col-lg-3 col-md-6">
                                <div class="card-box widget-box-two widget-two-success">
                                    <i class="mdi mdi-arrow-up-bold-circle widget-two-icon"></i>
                                    <div class="wigdet-two-content text-white">
                                        <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">CLIENTES MAYORES A 65 AÑOS</p>
                                        <h2 class="text-white"><span data-plugin="counterup"><?php echo $countMayores; ?></span> <small><i class="mdi mdi-arrow-up text-success"></i></small></h2>
                                        <p class="m-0"><b>Última Actualización</b></p>
                                    </div>
                                </div>
                            </div><!-- end col -->
                        

                            <div class="col-lg-3 col-md-6">
                                <div class="card-box widget-box-two widget-two-danger">
                                    <i class="mdi mdi-arrow-down-drop-circle widget-two-icon"></i>
                                    <div class="wigdet-two-content text-white">
                                        <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="User Today">CLIENTES MENORES A 65 AÑOS</p>
                                        <h2 class="text-white"><span data-plugin="counterup"><?php echo $countMenores; ?> </span> <small><i class="mdi mdi-arrow-down text-danger"></i></small></h2>
                                        <p class="m-0"><b>Última Actualización</b></p>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-lg-3">
                                <div class="panel panel-color panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Usuarios por Comuna</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table table-hover m-0">
                                                <thead>
                                                    <tr>
                                                        <th>Comuna</th>
                                                        <th>Clientes</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                 <?php foreach ($this->model->clientexComunas() as $rows): ?>
                                                    <tr>
                                                        <td><?php  echo $rows['descripcion'] ?></td>
                                                        <td align="center"><?php  echo $rows['cantidad'] ?></td>
                                                    </tr>
                                                 <?php  endforeach; ?>
                                                </tbody>
                                            </table>

                                        </div> <!-- table-responsive -->
                                    </div>
                                </div> <!-- end panel -->

                            </div>

    </div>
                        <!-- end row -->
</div>
</div>
</div>