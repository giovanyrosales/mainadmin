
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ asset('/images/logo.png') }}" alt="Admin Logo" class="brand-image "
           style="opacity: .9">
      <span class="brand-text font-weight-light">Panel de Control</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
         <a>{{ $usuario->nombre.' '.$usuario->apellido }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
            <a href="{{ url('/admin/inicio') }}" target="frameprincipal" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Inicio
                
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
              Cotizaciones
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a style="margin-left: 15px;" href="{{ url('/admin/newproyecto') }}" target="frameprincipal" class="nav-link">
                  <i class="far fa-file nav-icon"></i>
                  <p>--------</p>
                </a>
              </li>
              <li class="nav-item">
                <a style="margin-left: 15px;" href="{{ url('/admin/proyectos') }}" target="frameprincipal" class="nav-link">
                  <i class="far fa-list-alt nav-icon"></i>
                  <p>Registros</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
              Ordenes de Compra
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a style="margin-left: 15px;" href="{{ url('/admin/newproyecto') }}" target="frameprincipal" class="nav-link">
                  <i class="far fa-file nav-icon"></i>
                  <p>Nueva</p>
                </a>
              </li>
              <li class="nav-item">
                <a style="margin-left: 15px;" href="{{ url('/admin/proyectos') }}" target="frameprincipal" class="nav-link">
                  <i class="far fa-list-alt nav-icon"></i>
                  <p>Registros</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
              Proyectos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!--@hasrole('uaci')-->
              <li class="nav-item">
                <a style="margin-left: 15px;" href="{{ url('/admin/crear_proyecto') }}" target="frameprincipal" class="nav-link">
                  <i class="far fa-file nav-icon"></i>
                  <p>Nuevo Proyecto</p>
                </a>
              </li>
             <!-- @endhasrole-->
              <li class="nav-item">
                <a style="margin-left: 15px;" href="{{ url('/admin/load_proyectos') }}" target="frameprincipal" class="nav-link">
                  <i class="far fa-list-alt nav-icon"></i>
                  <p>Proyectos Registrados</p>
                </a>
              </li>
              <li class="nav-item">
                <a style="margin-left: 15px;" href="{{ url('/admin/load_proyectos_aper') }}" target="frameprincipal" class="nav-link">
                  <i class="far fa-list-alt nav-icon"></i>
                  <p>Reformas de Apertura</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-inbox"></i>
              <p>
              Cuentas Bols&oacute;n
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a style="margin-left: 15px;" href="{{ url('/admin/bolsones') }}" target="frameprincipal" class="nav-link">
                  <i class="far fa-file nav-icon"></i>
                  <p>Cuentas</p>
                </a>
              </li>
              <li class="nav-item">
                <a style="margin-left: 15px;" href="{{ url('/admin/bolsones') }}" target="frameprincipal" class="nav-link">
                  <i class="far fa-list-alt nav-icon"></i>
                  <p>Movimientos</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
              Planillas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a style="margin-left: 15px;" href="{{ url('/admin/newproyecto') }}" target="frameprincipal" class="nav-link">
                  <i class="far fa-file nav-icon"></i>
                  <p>Nueva</p>
                </a>
              </li>
              <li class="nav-item">
                <a style="margin-left: 15px;" href="{{ url('/admin/proyectos') }}" target="frameprincipal" class="nav-link">
                  <i class="far fa-list-alt nav-icon"></i>
                  <p>Registradas</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
              Presupuesto
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a style="margin-left: 15px;" href="{{ url('/admin/codificados') }}" target="frameprincipal" class="nav-link">
                  <i class="far fa-list-alt nav-icon"></i>
                  <p>Codificaciones</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
              Configuraciones
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a style="margin-left: 15px;" href="{{ url('/admin/load_cuentas') }}" target="frameprincipal" class="nav-link">
                  <i class="fa fa-list nav-icon"></i>
                  <p>C&oacute;digo Espec&iacute;f.</p>
                </a>
              </li>
              <li class="nav-item">
                <a style="margin-left: 15px;" href="{{ url('/admin/load_materiales') }}" target="frameprincipal" class="nav-link">
                  <i class="fa fa-list nav-icon"></i>
                  <p>Cat&aacute;logo Materiales</p>
                </a>  
              </li>
              <li class="nav-item">
                <a style="margin-left: 15px;" href="{{ url('/admin/load_linea') }}" target="frameprincipal" class="nav-link">
                  <i class="fa fa-list nav-icon"></i>
                  <p>L&iacute;nea de Trabajo</p>
                </a>  
              </li>
              <li class="nav-item">
                <a style="margin-left: 15px;" href="{{ url('/admin/load_fuentef') }}" target="frameprincipal" class="nav-link">
                  <i class="fa fa-list nav-icon"></i>
                  <p>Fuente de Financ.</p>
                </a>  
              </li>
              <li class="nav-item">
                <a style="margin-left: 15px;" href="{{ url('/admin/load_fuenter') }}" target="frameprincipal" class="nav-link">
                  <i class="fa fa-list nav-icon"></i>
                  <p>Fuente de Recursos</p>
                </a>  
              </li>
              <li class="nav-item">
                <a style="margin-left: 15px;" href="{{ url('/admin/load_areagestion') }}" target="frameprincipal" class="nav-link">
                  <i class="fa fa-list nav-icon"></i>
                  <p>&Aacute;rea de Gesti&oacute;n</p>
                </a>  
              </li>
              <li class="nav-item">
                <a style="margin-left: 15px;" href="{{ url('/admin/load_proveedores') }}" target="frameprincipal" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Proveedores</p>
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

