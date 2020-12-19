<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-light-navy" id="menu">
  <!-- Sidebar -->
  <div class="sidebar">
		<a href="<?php echo base_url();?>/Inicio" class=" mt-3 pb-3 mb-3 d-flex">
			  <img src="<?php echo base_url();?>/public/img/logo/logo.png" alt="AdminLTE Logo"  class="brand-image" id="brand-image">
    </a>
    <hr>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="<?php echo base_url();?>/Inicio" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Home
              <span class="right badge badge-danger">Bienvenido</span>
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              Mantenimiento
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo base_url();?>/Usuario" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Usuario</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo base_url();?>Tipo_usuario" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tipo Usuario</p>
              </a>
            </li>
          </ul>
           <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo base_url();?>Tipo_usuario" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Comprobante</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-boxes"></i>
            <p>
              Almacen
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo base_url();?>Categoria" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Categoría</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo base_url();?>Marca" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Marca</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo base_url();?>Producto" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Producto</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-shopping-bag"></i>
            <p>
              Compras
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo base_url();?>Usuario" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Proveedor</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo base_url();?>Usuario" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Compra</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-header">Extras</li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-plus-square"></i>
            <p>
              Extras
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="pages/examples/login.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Login</p>
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
