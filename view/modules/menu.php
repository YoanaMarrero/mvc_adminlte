<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="view/img/users/<?=$_SESSION["lg_user_img"]?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $_SESSION["lg_user_fullname"]?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>      

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"><a href="main">MENÚ PRINCIPAL</a></li>
        <li>
          <a href="users"><i class="fa fa-user"></i> Usuarios</a>
        </li>
        <li>
          <a href="roles"><i class="fa fa-cogs"></i> Roles</a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
</aside>
