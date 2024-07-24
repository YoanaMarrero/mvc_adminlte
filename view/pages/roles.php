<section class="content-header">
    <h1>Roles <small>Mantenimiento</small></h1>
    <ol class="breadcrumb">
        <li><a href="roles"><i class="fa fa-cogs"></i> Roles</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Roles registrados</h3>
        </div>
        <div class="box-body">            
            <div class="card-body"> 
            <table id="roles_table" class="table table-bordered table-striped table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Rol</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody> 
                <?php 
                    foreach ($roles as $key => $rol) { ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= trim($rol['rol']) ?></td>
                            <td>
                                <div class='btn-group'>
                                    <button class="btn btn-warning btn-sm btnEditarRol"
                                        data-toggle="modal" data-rol_id="<?php echo $rol["rol_id"]  ?>"
                                        data-target="#modal-rol_edit">
                                        <i class="fa fa-pencil text-white"></i>
                                    </button>

                                    <button class="btn btn-danger btn-sm btnEliminarRol"
                                        data-rol_id="<?= $rol['rol_id']  ?>">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>                    
                    <?php 
                    } ?>
                </tbody>
            </table>
            </div>
        </div>
        <!-- /.box-body-->
        <div class="box-footer">
            <button class="btn btn-primary btn-new-user" 
                data-toggle="modal" data-target="#modal-rol">
                <i class="fa fa-cogs"></i>&nbsp;&nbsp;Crear rol
            </button>
        </div>
        <!-- /.box-footer-->
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->


<!-- #modal-rol -->
<div class="modal modal-default fade" id="modal-rol">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Crear rol</h4>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <form name="form_rol" action="#" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre" />
                            </div>
                        </div>
                    </div>
                    <!-- /. row -->
                </form>
            </div>
            <!-- /. modal-body -->

            <div class="modal-footer">                
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                    Cancelar</button>
                <button type="submit" class="btn btn-primary" onclick="document.forms.form_rol.submit();">
                    <i class="fa fa-save"></i>&nbsp;&nbsp;Grabar
                </button>                          
            </div>
            <!-- /. modal-footer -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /#modal-rol -->

<!-- #modal-rol_edit -->
<div class="modal modal-default fade" id="modal-rol_edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Editar usuario</h4>
            </div>
            <div class="modal-body">
                <form name="form_rol_edit" method="post">
                    <input type="hidden" id="rol_edit" name="rol_edit" value=""/>
                    <div class="row">                      
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nombre_edit">Nombre</label>
                                <input id="nombre_edit" name="nombre_edit" type="text" class="form-control" placeholder="Nombre" />
                            </div>
                        </div>
                    </div>
                    <!-- /. row -->
                </form>
            </div>
            <!-- /. modal-body -->
            
            <div class="modal-footer">                
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                    Cancelar</button>
                <button type="submit" class="btn btn-primary" onclick="document.forms.form_rol_edit.submit();">
                    <i class="fa fa-save"></i>&nbsp;&nbsp;Grabar
                </button>                          
            </div>
            <!-- /. modal-footer -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /#modal-rol_edit -->

<script src="view/sources/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="view/sources/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="view/sources/bower_components/sweetalert2.all.js"></script>
<script src="view/js/roles.js"></script>

<?php 
    $usuarios = new roles_controller();
    $usuarios->save_rol();
    $usuarios->edit_rol();
?>
