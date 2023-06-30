<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <span class="hidden-xs">Hola: <?php echo $_SESSION['nombre']; ?></span>
        </a>
        <ul class="dropdown-menu">
          <li class="user-footer">
            <div class="pull-left">
              <a href="editar-admin.php?id=<?php echo $_SESSION['id']; ?>" class="btn btn-success btn-flat">Configurar</a>
            </div>
            <div class="pull-right">
              <a href="login.php?cerrar_sesion=true" class="btn btn-success btn-flat">Cerrar Sesión</a>
            </div>
          </li>
        </ul>
      </li>

      <li>
        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
      </li>
    </ul>
  </nav>

  <!-- /.navbar -->