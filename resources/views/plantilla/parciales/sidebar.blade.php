<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="#">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#sidebarDropdown1" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Almacén</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-store"></i>
            </a>
            <div class="collapse" id="sidebarDropdown1">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{!!URL::to('/almacen/articulo')!!}">Articulos</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{!!URL::to('/almacen/categoria')!!}">Categorias</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#sidebarDropdown2" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">Ventas</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-cart"></i>
            </a>
            <div class="collapse" id="sidebarDropdown2">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{!!URL::to('/ventas/cliente')!!}">Clientes</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{!!URL::to('/ventas/venta')!!}">Venta</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#sidebarDropdown3" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">Compras</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-google-wallet"></i>
            </a>
            <div class="collapse" id="sidebarDropdown3">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{!!URL::to('/compras/proveedor')!!}">Proveedores</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{!!URL::to('/compras/ingreso')!!}">Ingresos</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#sidebarDropdown4" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">Seguridad</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-security"></i>
            </a>
            <div class="collapse" id="sidebarDropdown4">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{!!URL::to('/seguridad/usuario')!!}">Usuarios</a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>