<aside class="main-sidebar">
        <section class="sidebar">
          <div class="user-panel">
            <div class="pull-left image">
              <img src="img/usuarioAdministrador.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>{{Auth::user()->name}}</p>
              <a href="#"><i class="fa fa-circle text-success"></i> En línea</a>
            </div>
          </div>
      
          <!-- Búsqueda -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">   
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                  </span>
            </div>
          </form>
          <!-- Fin búsqueda -->
            
          <!-- Ménu -->
          <ul class="sidebar-menu" data-widget="tree">
              <li class="header text-center">HOTEL</li>
              
              <li class="treeview">
                <a href="#"><i class="fa fa-check"></i> <span>Acceso</span>
                  <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                  <li @click="menu=6"><a href="#"><i class="fa fa-users"></i> Usuarios</a></li>
                </ul>
              </li>
      
              <li class="treeview">
                <a href="#"><i class="fa fa-cogs"></i> <span>Configuración</span>
                  <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                  <li @click="menu=1"><a href="#"><i class="fa fa-tags"></i> Promoción</a></li>
                  <li @click="menu=2"><a href="#"><i class="fa fa-money"></i> Tipo de pago</a></li>
                  <li @click="menu=3"><a href="#"><i class="fa fa-suitcase"></i> Servicio</a></li>
                  <li @click="menu=4"><a href="#"><i class="fa fa-wrench"></i> Tipo de habitacion</a></li>
                  <li @click="menu=5"><a href="#"><i class="fa fa-bed"></i> Habitación</a></li>
                </ul>
              </li>

              <li class="treeview">
                <a href="#"><i class="fa fa-book"></i> <span>Recepción</span>
                  <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                  <li @click="menu=7"><a href="#"><i class="fa fa-bookmark"></i> Reservas</a></li>
                </ul>
              </li>
            </ul>
          <!-- Fin ménu -->
        </section>
      </aside>
      