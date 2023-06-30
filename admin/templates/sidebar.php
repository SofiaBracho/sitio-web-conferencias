  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <span class="brand-text font-weight-light" style="margin-left: 55px">GDLWebCamp</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="justify-content: center">
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['nombre']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Eventos
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="lista-eventos.php" class="nav-link">
                    <i class="far fa-list-alt nav-icon"></i>
                    <p>Ver todos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="crear-evento.php" class="nav-link">
                    <i class="far fa-plus-square nav-icon"></i>
                    <p>Agregar</p>
                  </a>
                </li>
              </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Categorías de eventos
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="lista-categorias.php" class="nav-link">
                    <i class="far fa-list-alt nav-icon"></i>
                    <p>Ver todos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="crear-categoria.php" class="nav-link">
                    <i class="far fa-plus-square nav-icon"></i>
                    <p>Agregar</p>
                  </a>
                </li>
              </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-circle"></i>
              <p>
                Invitados
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="lista-invitados.php" class="nav-link">
                    <i class="far fa-list-alt nav-icon"></i>
                    <p>Ver todos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="crear-invitado.php" class="nav-link">
                    <i class="far fa-plus-square nav-icon"></i>
                    <p>Agregar</p>
                  </a>
                </li>
              </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-id-card"></i>
              <p>
                Registrados
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="lista-registrados.php" class="nav-link">
                    <i class="far fa-list-alt nav-icon"></i>
                    <p>Ver todos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="crear-registro.php" class="nav-link">
                    <i class="far fa-plus-square nav-icon"></i>
                    <p>Agregar</p>
                  </a>
                </li>
              </ul>
          </li>
          <?php if($_SESSION['nivel'] == 1) { ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Administradores
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="lista-admin.php" class="nav-link">
                    <i class="far fa-list-alt nav-icon"></i>
                    <p>Ver todos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="crear-admin.php" class="nav-link">
                    <i class="far fa-plus-square nav-icon"></i>
                    <p>Agregar</p>
                  </a>
                </li>
              </ul>
          </li>
          <?php } ?>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-comments"></i>
              <p>
                Testimoniales
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../layout/top-nav.html" class="nav-link">
                    <i class="far fa-list-alt nav-icon"></i>
                    <p>Ver todos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../layout/top-nav-sidebar.html" class="nav-link">
                    <i class="far fa-plus-square nav-icon"></i>
                    <p>Agregar</p>
                  </a>
                </li>
              </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>