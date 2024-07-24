<section class="content-header">
    <h1>Usuarios <small>Mantenimiento</small></h1>
    <ol class="breadcrumb">
        <li><a href="users"><i class="fa fa-user"></i> Usuarios</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Usuarios registrados</h3>
        </div>
        <div class="box-body">
            
            <div class="card-body"> 
            <table id="users_table" class="table table-bordered table-striped table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Foto</th>
                        <th>Rol</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach ($usuarios as $key => $usuario) { 
                        $user_img = '';
                        if ($usuario['foto'] != '') {
                            if (file_exists('view/img/users/' .$usuario['foto']))
                                $user_img = 'view/img/users/' .$usuario['foto'];
                        }
                        if ($user_img == '') {
                            if (file_exists('view/img/users/none.jpg')) 
                               $user_img = 'view/img/users/none.jpg';
                        }   
                        ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= trim($usuario['nombre'] .' ' .$usuario['apellido1'] .' ' .$usuario['apellido2']) ?></td>
                            <td><?= $usuario['username'] ?></td>
                            <td><?= $usuario['email'] ?></td>
                            <td>
                                <?php if ($user_img != '') { ?>
                                    <img src="<?= $user_img ?>" class="img-circle user-img-table" />
                                <?php } ?>
                            </td>
                            <td><?= $usuario['rol_nb'] ?></td>
                            <td>
                                <div class='btn-group'>
                                    <button class="btn btn-warning btn-sm btnEditarUsuario"
                                        data-toggle="modal" data-userid="<?php echo $usuario["userid"]  ?>"
                                        data-target="#modal-user_edit">
                                        <i class="fa fa-pencil text-white"></i>
                                    </button>

                                    <button class="btn btn-danger btn-sm btnEliminarUsuario"
                                        data-userid="<?= $usuario['userid']  ?>"
                                        data-userimg="<?= $usuario['foto']?>">
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
        <!-- /.box-body -->
    
        <div class="box-footer">
            <button class="btn btn-primary btn-new-user" 
                data-toggle="modal" data-target="#modal-user">
                <i class="fa fa-user"></i>&nbsp;&nbsp;Crear usuario
            </button>
        </div>
        <!-- /.box-footer-->
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->


<!-- #modal-user -->
<div class="modal modal-default fade" id="modal-user">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Crear usuario</h4>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <form name="form_user" action="#" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rol">Rol</label>
                                <select id="rol" name="rol" class="form-control" required>
                                    <?php
                                    $ctr_rol = new roles_controller();
                                    $rol_select = $ctr_rol->get_roles();                                    
                                    foreach($rol_select as $rol) { ?>
                                        <option value="<?php echo $rol["rol_id"] ?>"><?php echo $rol["rol"] ?></option>
                                        <?php
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre" />
                            </div>
                        </div>
                    </div>
                    <!-- /. row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="apellido1">Primer apellido</label>
                                <input id="apellido1" name="apellido1" type="text" class="form-control" placeholder="Primer apellido" />
                            </div>
                        </div>                    
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="apellido2"><i class="fa fa-asterisk"></i> Segundo apellido</label>
                            <input id="apellido2" name="apellido2" type="text" class="form-control" placeholder="Segundo apellido" />
                            </div>
                        </div>
                    </div>
                    <!-- /. row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="email" class="form-control" placeholder="Email" autocomplete="off" />
                            </div>
                        </div>
                    </div>
                    <!-- /. row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="usuario">Usuario</label>
                                <input id="usuario" name="usuario" type="text" class="form-control" placeholder="Usuario"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="clave">Contraseña</label>
                                <input id="clave" name="clave" type="password" class="form-control" placeholder="Contraseña"/>
                            </div>
                        </div>
                    </div>
                    <!-- /. row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <span><b>Foto</b></span><br/>
                                <img class="previsualizarAvatar img-fluid py-2" width="200" height="200" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"><br/>
                                <div class="btn btn-default btn-file">
                                    <label for="avatar"><i class="fa fa-upload"></i> Subir archivo</label>
                                    <input id="avatar" name="avatar" type="file"/>
                                </div>
                                <p class="help-block small">Dimensiones: 480px * 382px | Peso Max. 2MB | Formato: JPG o PNG</p>
                            </div>
                        </div>
                    </div>
                    <!-- /. row -->
                    <div class="row">
                        <div class="col-md-12">
                            <span><i class="fa fa-asterisk"></i> Opcional</span>
                        </div>
                    </div>
                    <!-- /. row -->
                </form>
            </div>
            <!-- /. modal-body -->

            <div class="modal-footer">                
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                    Cancelar</button>
                <button type="submit" class="btn btn-primary" onclick="document.forms.form_user.submit();">
                    <i class="fa fa-save"></i>&nbsp;&nbsp;Grabar
                </button>                          
            </div>
            <!-- /. modal-footer -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /#modal-user -->

<!-- #modal-user_edit -->
<div class="modal modal-default fade" id="modal-user_edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Editar usuario</h4>
            </div>
            <div class="modal-body">
                <form name="form_user_edit" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="user_edit" name="user_edit" value=""/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rol_edit">Rol</label>
                                <select id="rol_edit" name="rol_edit" class="form-control" required>
                                    <?php
                                    $ctr_rol = new roles_controller();
                                    $rol_select = $ctr_rol->get_roles();                                    
                                    foreach($rol_select as $rol) { ?>
                                        <option value="<?php echo $rol["rol_id"] ?>"><?php echo $rol["rol"] ?></option>
                                        <?php
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre_edit">Nombre</label>
                                <input id="nombre_edit" name="nombre_edit" type="text" class="form-control" placeholder="Nombre" />
                            </div>
                        </div>
                    </div>
                    <!-- /. row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="apellido1_edit">Primer apellido</label>
                                <input id="apellido1_edit" name="apellido1_edit" type="text" class="form-control" placeholder="Primer apellido" />
                            </div>
                        </div>                    
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="apellido2_edit"><i class="fa fa-asterisk"></i> Segundo apellido</label>
                            <input id="apellido2_edit" name="apellido2_edit" type="text" class="form-control" placeholder="Segundo apellido" />
                            </div>
                        </div>
                    </div>
                    <!-- /. row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email_edit">Email</label>
                                <input id="email_edit" name="email_edit" type="email" class="form-control" placeholder="Email" autocomplete="off" />
                            </div>
                        </div>
                    </div>
                    <!-- /. row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="usuario_edit">Usuario</label>
                                <input id="usuario_edit" name="usuario_edit" type="text" class="form-control" placeholder="Usuario"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="clave_edit">Contraseña</label>
                                <input id="clave_edit" name="clave_edit" type="password" class="form-control" placeholder="Contraseña"/>
                                <input type="hidden" id="clave_edit_ant" name="clave_edit_ant" value=""/>
                            </div>
                        </div>
                    </div>
                    <!-- /. row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <span><b>Foto</b></span><br/>
                                <img class="previsualizarAvatar_edit img-fluid py-2" width="200" height="200" />
                                <input type="hidden" id="avatar_edit_ant" name="avatar_edit_ant" value=""/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"><br/>
                                <div class="btn btn-default btn-file">
                                    <label for="avatar_edit"><i class="fa fa-upload"></i> Subir archivo</label>
                                    <input id="avatar_edit" name="avatar_edit" type="file"/>
                                </div>
                                <p class="help-block small">Dimensiones: 480px * 382px | Peso Max. 2MB | Formato: JPG o PNG</p>
                            </div>
                        </div>
                    </div>
                    <!-- /. row -->
                    <div class="row">
                        <div class="col-md-12">
                            <span><i class="fa fa-asterisk"></i> Opcional</span>
                        </div>
                    </div>
                    <!-- /. row -->
                </form>
            </div>
            <!-- /. modal-body -->
            
            <div class="modal-footer">                
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                    Cancelar</button>
                <button type="submit" class="btn btn-primary" onclick="document.forms.form_user_edit.submit();">
                    <i class="fa fa-save"></i>&nbsp;&nbsp;Grabar
                </button>                          
            </div>
            <!-- /. modal-footer -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /#modal-user_edit -->

<script src="view/sources/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="view/sources/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="view/sources/bower_components/sweetalert2.all.js"></script>
<script src="view/js/users.js"></script>

<?php 
    $ctr_users = new users_controller();
    $ctr_users->save_user();
    $ctr_users->edit_user();
?>
