<?php
    include_once 'funciones/sesiones.php';
    include_once 'funciones/funciones.php';
    include_once 'templates/header.php';
    include_once 'templates/navegacion.php';
    include_once 'templates/sidebar.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Dashboard</h1><small>información sobre el evento</small>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <!-- LINE CHART -->
    <div class="card card-info">
        <div class="card-header">
        <h3 class="card-title">Line Chart</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
        </div>
        <div class="card-body">
        <div class="chart">
            <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <div class="card-body">
        
        <h2 class="page-header">Resumen de Registros</h2>
        <div class="row">
            <?php
                $sql = "SELECT COUNT(id_registrado) AS registrado FROM registrados ";
                $resultado = $conn->query($sql);
                $registrados = $resultado->fetch_assoc();
            ?>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-info">
                <div class="inner">
                    <h3><?php echo $registrados['registrado']; ?></h3>

                    <p>Total Registrados</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>
                <a href="lista-registrados.php" class="small-box-footer">
                    Más Información <i class="fas fa-arrow-circle-right"></i>
                </a>
                </div>
            </div>
            <!-- ./col -->

            <?php
                $sql = "SELECT COUNT(id_registrado) AS registrado FROM registrados WHERE pagado = 1 ";
                $resultado = $conn->query($sql);
                $registrados = $resultado->fetch_assoc();
            ?>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?php echo $registrados['registrado']; ?></h3>

                    <p>Total Pagados</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="lista-registrados.php" class="small-box-footer">
                    Más Información <i class="fas fa-arrow-circle-right"></i>
                </a>
                </div>
            </div>
            <!-- ./col -->
            
            <?php
                $sql = "SELECT COUNT(id_registrado) AS registrado FROM registrados WHERE pagado = 0 ";
                $resultado = $conn->query($sql);
                $registrados = $resultado->fetch_assoc();
            ?>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-red">
                <div class="inner">
                    <h3><?php echo $registrados['registrado']; ?></h3>

                    <p>Total Sin Pagar</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user-times"></i>
                </div>
                <a href="lista-registrados.php" class="small-box-footer">
                    Más Información <i class="fas fa-arrow-circle-right"></i>
                </a>
                </div>
            </div>
            <!-- ./col -->

            <?php
                $sql = "SELECT SUM(total_pagado) AS ganancias FROM registrados WHERE pagado = 1 ";
                $resultado = $conn->query($sql);
                $registrados = $resultado->fetch_assoc();
            ?>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-green">
                <div class="inner">
                    <h3>$<?php echo (float) $registrados['ganancias']; ?></h3>

                    <p>Ganancias Totales</p>
                </div>
                <div class="icon">
                    <i class="fa fa-money-bill-alt"></i>
                </div>
                <a href="lista-registrados.php" class="small-box-footer">
                    Más Información <i class="fas fa-arrow-circle-right"></i>
                </a>
                </div>
            </div>
            <!-- ./col -->

        </div>

        <h2 class="page-header">Regalos</h2>
        <div class="row">
            <?php
                $sql = "SELECT COUNT(regalo) AS pulseras FROM registrados WHERE pagado = 1 AND regalo = 1";
                $resultado = $conn->query($sql);
                $registrados = $resultado->fetch_assoc();
            ?>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-pink">
                <div class="inner">
                    <h3><?php echo $registrados['pulseras']; ?></h3>

                    <p>Pulseras</p>
                </div>
                <div class="icon">
                    <i class="fa fa-dot-circle"></i>
                </div>
                <a href="lista-registrados.php" class="small-box-footer">
                    Más Información <i class="fas fa-arrow-circle-right"></i>
                </a>
                </div>
            </div>
            <!-- ./col -->

            <?php
                $sql = "SELECT COUNT(regalo) AS etiquetas FROM registrados WHERE pagado = 1 AND regalo = 2";
                $resultado = $conn->query($sql);
                $registrados = $resultado->fetch_assoc();
            ?>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-purple">
                <div class="inner">
                    <h3><?php echo $registrados['etiquetas']; ?></h3>

                    <p>Etiquetas</p>
                </div>
                <div class="icon">
                    <i class="fa fa-clone"></i>
                </div>
                <a href="lista-registrados.php" class="small-box-footer">
                    Más Información <i class="fas fa-arrow-circle-right"></i>
                </a>
                </div>
            </div>
            <!-- ./col -->

            <?php
                $sql = "SELECT COUNT(regalo) AS plumas FROM registrados WHERE pagado = 1 AND regalo = 3 ";
                $resultado = $conn->query($sql);
                $registrados = $resultado->fetch_assoc();
            ?>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-orange">
                <div class="inner">
                    <h3><?php echo $registrados['plumas']; ?></h3>

                    <p>Plumas</p>
                </div>
                <div class="icon">
                    <i class="fa fa-pen-nib"></i>
                </div>
                <a href="lista-registrados.php" class="small-box-footer">
                    Más Información <i class="fas fa-arrow-circle-right"></i>
                </a>
                </div>
            </div>
            <!-- ./col -->

        </div>
        

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php
    include_once 'templates/footer.php';
?>